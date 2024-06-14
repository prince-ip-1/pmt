<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryModel;
use App\Models\SalaryReview;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\EmpLeaveModel;
use App\Models\Checkin;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Helper\helper;
use PDF;
use Session;
use mail;
use Artisan;
class SalaryController extends Controller
{
    public function testSalry()
    {
        $m = '06';
        $y = '2023';
        $date = Carbon::create($y, $m)->lastOfMonth()->format('Y-m-d');
        
        $employees = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'term','bond_duration','bond_start','bond_end','deduction_amt','leave_balance','professional_tax','currentCTC','join_date')->where('user_type','user')->where('currentCTC','!=',NULL)->whereDate('join_date','<=',$date)->where('status',1)->get();
        p($employees);
        $previousMonthYr = Carbon::createFromFormat('Y-m-d', $date)->subMonth();
        $pmonth = $previousMonthYr->format('m');
        $pyear = $previousMonthYr->format('Y');
        
        foreach($employees as $val)
        {
            $flag = false;
            if(date('m',strtotime($val->join_date)) == $m && date('Y',strtotime($val->join_date)) == $y && date('d',strtotime($val->join_date)) != '01') {
                $flag = true;
            }
            
            $salary = $val->currentCTC;

            $basic = $val->currentCTC * 35 /100;

            $conv = $val->currentCTC * 10 /100;

            $hra = $val->currentCTC * 20 /100;

            $sp_allowance = $val->currentCTC * 25 /100;

            $tada = $val->currentCTC * 10 /100;

            $prof_tax = isset($val->professional_tax) ? $val->professional_tax : 200;

            $sec_deduction = 0;
            if($val->term == 2) {
                $sec_deduction = isset($val->deduction_amt) ? $val->deduction_amt : 0;
            }

            $month_days = Carbon::now()->month($m)->daysInMonth;

            $presentDays = Checkin::where([
                    ['employee_id','=',$val->id],
                    ['type','=',1]
                  ])->whereMonth('date',date('m',strtotime($date)))
                  ->whereYear('date',date('Y',strtotime($date)))->distinct()->count('date');
            
            $taken_leave = EmpLeaveModel::where('emp_id',$val->id)->where('status',1)
                           ->where(function ($query) use ($m) {
                                $query->whereMonth('start_date',$m)->orWhereMonth('end_date',$m);
                           })
                           ->where(function ($query) use ($y) {
                                $query->whereYear('start_date',$y)->orWhereYear('end_date',$y);
                           })->get();
            
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $floatVal = floatval($c->leavetype);
                    if($floatVal && intval($floatVal) != $floatVal) {
                        $cMonLeave = $cMonLeave +  $c->leavetype;
                    }
                    else if($c->end_date != NULL && $c->start_date != $c->end_date) {

                        $period = CarbonPeriod::create($c->start_date, $c->end_date)->toArray();
                        $arr = [];

                        foreach ($period as $pr) {
                            array_push($arr, $pr->format('Y-m-d'));
                        }
                        
                        foreach($arr as $a) {
                            $w = Carbon::parse($a);
                            if(date('m',strtotime($a)) == $m && !$w->isWeekend()) {
                                $cMonLeave = $cMonLeave + 1;
                            }
                        }
                    } else {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $cMonLeave = $cMonLeave + $leave;
                    }
                }
            }

            $pre_leave = EmpLeaveModel::where('emp_id',$val->id)->where('status',1)
                           ->where(function ($query) use ($pmonth) {
                                $query->whereMonth('start_date',$pmonth)->orWhereMonth('end_date',$pmonth);
                           })
                           ->where(function ($query) use ($pyear) {
                                $query->whereYear('start_date',$pyear)->orWhereYear('end_date',$pyear);
                           })->get();
            
            $pMonLeave = 0;
            if(!empty($pre_leave)) {
                foreach($pre_leave as $c) {
                    $floatVal = floatval($c->leavetype);
                    if($floatVal && intval($floatVal) != $floatVal) {
                        $pMonLeave = $pMonLeave + $c->leavetype;
                    }
                    else if($c->end_date != NULL && $c->start_date != $c->end_date) {

                        $period = CarbonPeriod::create($c->start_date, $c->end_date)->toArray();
                        $arr = [];

                        foreach ($period as $pr) {
                            array_push($arr, $pr->format('Y-m-d'));
                        }
                        
                        foreach($arr as $a) {
                            $w = Carbon::parse($a);
                            if(date('m',strtotime($a)) == $pmonth && !$w->isWeekend()) {
                                $pMonLeave = $pMonLeave + 1;
                            }
                        }
                    } else {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $pMonLeave = $pMonLeave + $leave;
                    }
                }
            }

            $leave_bal = 0;
            $a = 0;
            if($cMonLeave > 0) {
                if($val->leave_balance > 0) {
                    $leave_bal = (float) $val->leave_balance;
                    $a = abs($val->leave_balance - $cMonLeave);
                } else {
                    $a = $cMonLeave;
                }
            }else{
                $leave_bal = (float) $val->leave_balance;
            }

            $deduction = $prof_tax + $sec_deduction;
            $payable_days = $month_days;
            
            $calSalary = round($salary / $month_days);
            
            $totalLeaveDeduct = 0;
            
            $calculateLB = $leave_bal - $cMonLeave;

            $currentLB = $calculateLB < 0 ? 0 : $calculateLB;
            
            if($flag) {
                $date1 = Checkin::where([
                    ['employee_id','=',$val->id],
                    ['type','=',1]
                  ])->whereMonth('date',date('m',strtotime($date)))
                  ->whereYear('date',date('Y',strtotime($date)))->orderBy('date','ASC')->first();
                  
                $to = Carbon::parse($date1->date);
                $from = Carbon::parse($date);

                $days = $to->diffInDays($from) + 1;

                $payable_days = $days;
            }
            
            if($currentLB == 0 && $a > 0) {
                
                $totalLeaveDeduct = round($calSalary * $a);
                
                $deduction = $deduction + $totalLeaveDeduct;
                
                $payable_days = $payable_days - $a;
                
            }
            
            $total_amount = $salary - $deduction;
            
            if($flag) {
                $payableSalary = $calSalary * $payable_days;
                
                $total_amount = $payableSalary;// - $deduction;
            }
            
            $salarySlipDate = Carbon::create($y, $m)->lastOfMonth()->format('Y-m-d');

        }

        $res = ['status'=>true,'message'=>'Salary Slip Generated Successfully'];
        return $res;
    }
    
    public function get_base_host()
    {
        $root = "https://" . $_SERVER['HTTP_HOST'];
        $root .= str_replace(
            basename($_SERVER['SCRIPT_NAME']),
            "",
            $_SERVER['SCRIPT_NAME']
        );
        $base_url = $root;
        $host = preg_replace('/:\d+$/', '', $base_url);
        return trim($host);
    }
    public function salaryslip()
    {
        $data['title']='Add Salary';
        $data['sub_title']='';
        $data['sidebar']="Salary";
        $prof_tax = DB::table('company_details')->first();
        
        $data['p_tax'] = $prof_tax->p_tax;
        
        return view('admin.salary.add_salary_slip',compact('data'));
    }
    public function salary_list()
    {
        $data['title']='Salary List';
        $data['sub_title']='';
        $data['sidebar']='Salary';
        $data['sub_title_url ']="";
        $data['salary'] = [];
        $data['month'] = "";
        $get = SalaryModel::select('date')->orderBy('id','DESC')->first();
        if(!empty($get)){
            $m = date('m',strtotime($get->date));
            $y = date('Y',strtotime($get->date));

            $data['month'] = $y.'-'.$m;
            $data['salary'] = SalaryModel::select('salary.emp_id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image')->whereMonth('date',$m)->whereYear('date',$y)->join('employee','salary.emp_id','=','employee.id')->get();   
        }
        $data['count'] = count($data['salary']);
        $data['sum'] = SalaryModel::whereMonth('date',date('m'))->whereYear('date',date('Y'))->sum('total_amount');
               
        return view('admin.salary.list',compact('data'));

    }
    public function salarySlipList()
    {
        $data['title']='Salary Slip List ';
        $data['sub_title']='Salary Slip';
        $data['sidebar']='Salary';
        $data['sub_title_url']='admin/salary_list';

        $month = Carbon::now()->subMonth();
        $m = date('m',strtotime($month));
        $y = date('Y',strtotime($month));

        $data['list'] = SalaryReview::select('salary_review.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"))->leftJoin('employee','salary_review.emp_id','=','employee.id')->orderBy('total_salary','DESC')->get();
        
        $total = DB::select('SELECT sum(CAST(total_amount AS DECIMAL(10,2))) as total FROM salary_review');

        $data['total'] = $total[0]->total;
        
        return view('admin.salary.generate-list',compact('data'));
    }
    public function generate(Request $request)
    {
        
        $data = explode('-',$request->month);
        
        $m = $data[1];
        $y = $data[0];
        $date = Carbon::create($y, $m)->lastOfMonth()->format('Y-m-d');
        
        $employees = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'term','bond_duration','bond_start','bond_end','deduction_amt','security_deduction','leave_balance','professional_tax','currentCTC','join_date','tds','last_date')->where('user_type','user')->where('currentCTC','!=',NULL)->whereDate('join_date','<=',$date)->where('status',1)->get();
        
        $checkReviewTB = SalaryReview::whereMonth('date',$m)->whereYear('date',$y)->count();
        if($checkReviewTB > 0) {
            $res = ['status'=>false,'message'=>'Salary for given month is already generated'];
            return $res;
        }

        $checkSalaryTB = SalaryModel::whereMonth('date',$m)->whereYear('date',$y)->count();
        if($checkSalaryTB > 0) {
            $res = ['status'=>false,'message'=>'Salary for given month is already generated'];
            return $res;
        }
        
        $previousMonthYr = Carbon::create($y, $m);
        $pmonth = $previousMonthYr->subMonth()->format('m');
        $pyear = $previousMonthYr->subMonth()->format('Y');
        
        foreach($employees as $val)
        {
            $flag = false;
            if(date('m',strtotime($val->join_date)) == $m && date('Y',strtotime($val->join_date)) == $y && date('d',strtotime($val->join_date)) != '01') {
                $flag = true;
            }
            
            $salary = $val->currentCTC;

            $basic = $val->currentCTC * 35 /100;

            $conv = $val->currentCTC * 10 /100;

            $hra = $val->currentCTC * 20 /100;

            $sp_allowance = $val->currentCTC * 25 /100;

            $tada = $val->currentCTC * 10 /100;

            $prof_tax = isset($val->professional_tax) ? $val->professional_tax : 200;

            $sec_deduction = 0;
            if($val->term == 2) {
                $sec_deduction = isset($val->deduction_amt) ? $val->deduction_amt : 0;
            }

            $month_days = Carbon::now()->month($m)->daysInMonth;

            $presentDays = Checkin::where([
                    ['employee_id','=',$val->id],
                    ['type','=',1]
                  ])->whereMonth('date',date('m',strtotime($date)))
                  ->whereYear('date',date('Y',strtotime($date)))->distinct()->count('date');
            
            $taken_leave = EmpLeaveModel::where('emp_id',$val->id)->where('status',1)
                           ->where(function ($query) use ($m) {
                                $query->whereMonth('start_date',$m)->orWhereMonth('end_date',$m);
                           })
                           ->where(function ($query) use ($y) {
                                $query->whereYear('start_date',$y)->orWhereYear('end_date',$y);
                           })->get();
            
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $floatVal = floatval($c->leavetype);
                    if($floatVal && intval($floatVal) != $floatVal) {
                        $cMonLeave = $cMonLeave +  $c->leavetype;
                    }
                    else if($c->end_date != NULL && $c->start_date != $c->end_date) {

                        $period = CarbonPeriod::create($c->start_date, $c->end_date)->toArray();
                        $arr = [];

                        foreach ($period as $pr) {
                            array_push($arr, $pr->format('Y-m-d'));
                        }
                        
                        foreach($arr as $a) {
                            $w = Carbon::parse($a);
                            if(date('m',strtotime($a)) == $m && !$w->isWeekend()) {
                                $cMonLeave = $cMonLeave + 1;
                            }
                        }
                    } else {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $cMonLeave = $cMonLeave + $leave;
                    }
                }
            }

            $pre_leave = EmpLeaveModel::where('emp_id',$val->id)->where('status',1)
                           ->where(function ($query) use ($pmonth) {
                                $query->whereMonth('start_date',$pmonth)->orWhereMonth('end_date',$pmonth);
                           })
                           ->where(function ($query) use ($pyear) {
                                $query->whereYear('start_date',$pyear)->orWhereYear('end_date',$pyear);
                           })->get();
            
            $pMonLeave = 0;
            if(!empty($pre_leave)) {
                foreach($pre_leave as $c) {
                    $floatVal = floatval($c->leavetype);
                    if($floatVal && intval($floatVal) != $floatVal) {
                        $pMonLeave = $pMonLeave + $c->leavetype;
                    }
                    else if($c->end_date != NULL && $c->start_date != $c->end_date) {

                        $period = CarbonPeriod::create($c->start_date, $c->end_date)->toArray();
                        $arr = [];

                        foreach ($period as $pr) {
                            array_push($arr, $pr->format('Y-m-d'));
                        }
                        
                        foreach($arr as $a) {
                            $w = Carbon::parse($a);
                            if(date('m',strtotime($a)) == $pmonth && !$w->isWeekend()) {
                                $pMonLeave = $pMonLeave + 1;
                            }
                        }
                    } else {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $pMonLeave = $pMonLeave + $leave;
                    }
                }
            }

            $leave_bal = 0;
            $a = 0;
            if($cMonLeave > 0) {
                if($val->leave_balance > 0) {
                    $leave_bal = (float) $val->leave_balance;
                    $a = abs($val->leave_balance - $cMonLeave);
                } else {
                    $a = $cMonLeave;
                }
            }else{
                $leave_bal = (float) $val->leave_balance;
            }

            $deduction = $prof_tax + $sec_deduction;
            $payable_days = $month_days;
            
            $calSalary = round($salary / $month_days);
            
            $totalLeaveDeduct = 0;
            
            $calculateLB = $leave_bal - $cMonLeave;

            $currentLB = $calculateLB < 0 ? 0 : $calculateLB;
            
            if($flag) {
                $date1 = Checkin::where([
                    ['employee_id','=',$val->id],
                    ['type','=',1]
                  ])->whereMonth('date',date('m',strtotime($date)))
                  ->whereYear('date',date('Y',strtotime($date)))->orderBy('date','ASC')->first();
                  
                $to = Carbon::parse($date1->date);
                $from = Carbon::parse($date);

                $days = $to->diffInDays($from) + 1;

                $payable_days = $days;
            }
            
            if($currentLB == 0 && $a > 0) {
                
                $totalLeaveDeduct = round($calSalary * $a);

                $deduction = $deduction + $totalLeaveDeduct;

                $payable_days = $payable_days - $a;
                
            }
            
            $total_amount = $salary - $deduction;
            
            if($val->id == 37) {
                $payable_days = 23;
                $payableSalary = $calSalary * 23;
                $total_amount = $payableSalary - $deduction;
            }

            
            if($flag) {
                $payableSalary = $calSalary * $payable_days;
                $total_amount = $payableSalary - $deduction;
            }
            
            if($val->tds > 0) {
                $deduction = $deduction + (int)$val->tds;
                $total_amount = $total_amount - (int)$val->tds;
                
            }
            
            /*$calculateLB = $leave_bal - $cMonLeave;

            $currentLB = $calculateLB < 0 ? 0 : $calculateLB;*/

            // $uLeaveBalance = EmployeeModel::where('id',$val->id)->update(['leave_balance'=>$currentLB+1]);
            
            $salarySlipDate = Carbon::create($y, $m)->lastOfMonth()->format('Y-m-d');
            
            $data = new SalaryReview;
            $data->emp_id =$val->id;
            $data->date = $salarySlipDate;
            $data->pl = $pMonLeave;
            $data->cl = $cMonLeave;
            $data->previous_balance = $val->leave_balance;
            $data->leave_balance = $currentLB;
            $data->lwp = 0;
            $data->month_days = $month_days;
            $data->working_days = workingDays($salarySlipDate);
            $data->present_days = $presentDays;
            $data->payable_days = $payable_days;
            $data->total_salary = $salary;
            $data->basic_salary =$basic;
            $data->conveyance = $conv;
            $data->HRA = $hra;
            $data->special_allowance = $sp_allowance;
            $data->TADA = $tada;
            $data->professional_tax = $prof_tax;
            $data->security_deduction = $sec_deduction;
            $data->medical_allowance = 0;
            $data->other_allowance = 0;
            $data->leave_deduction = $totalLeaveDeduct;
            $data->pf = 0;
            $data->tds = $val->tds;
            $data->total_deduction = $deduction;
            $data->total_amount = $total_amount;
            $data->save();
        }

        /*if($m == 3 || $m == 03) {
            $updateYLB = EmployeeModel::update(['leave_balance'=>1]);
        }*/

        $res = ['status'=>true,'message'=>'Salary Slip Generated Successfully'];
        return $res;
    }
    public function submitSalary()
    {
        $salaryslip = SalaryReview::all();

        if(!empty($salaryslip)){

            foreach($salaryslip as $val)
            {
                $a = new SalaryModel;
                $a->emp_id =$val->emp_id;
                $a->date = $val->date;
                $a->pl = $val->pl;
                $a->cl = $val->cl;
                $a->previous_balance = $val->previous_balance;
                $a->leave_balance = $val->leave_balance;
                $a->lwp = $val->lwp;
                $a->month_days = $val->month_days;
                $a->working_days = $val->working_days;
                $a->present_days = $val->present_days;
                $a->payable_days = $val->payable_days;
                $a->total_salary = $val->total_salary;
                $a->basic_salary =$val->basic_salary;
                $a->conveyance = $val->conveyance;
                $a->HRA = $val->HRA;
                $a->special_allowance = $val->special_allowance;
                $a->TADA = $val->TADA;
                $a->professional_tax = $val->professional_tax;
                $a->security_deduction = $val->security_deduction;
                $a->medical_allowance = $val->medical_allowance;
                $a->other_allowance = $val->other_allowance;
                $a->leave_deduction = $val->leave_deduction;
                $a->pf = $val->pf;
                $a->tds = $val->tds;
                $a->total_deduction = $val->total_deduction;
                $a->total_amount = $val->total_amount;
                $a->status = 0;
                $a->save();
            }

            $removeData = DB::table('salary_review')->delete();

            $res = ['status'=>true,'message'=>'Salary Slip Submitted Succesfully'];
            return $res;
        }
        else{
            $res = ['status'=>false,'message'=>'No Data Found'];
            return $res;
        }
    }
    public function editsalaryslip(Request $request,$id)
    {
        $data['title']='Edit Salary Slip ';
        $data['sub_title']='Salary';
        $data['sidebar']='Salary';
        $data['sub_title_url']='admin/listsalaryslip';

        if($request->isMethod('post'))
        {
            $u = SalaryReview::find($id);
            $u->date = $request->date;
            $u->pl = $request->pl;
            $u->cl = $request->cl;
            $u->month_days = $request->month_days;
            $u->present_days = $request->present_days;
            $u->payable_days = $request->payable_days;
            $u->leave_balance = $request->leave_balance;
            $u->total_salary = $request->total_salary;
            $u->basic_salary =$request->basic_salary;
            $u->conveyance = $request->conv;
            $u->HRA = $request->hra;
            $u->special_allowance = $request->sp_allowance;
            $u->TADA = $request->tada;
            $u->professional_tax = $request->p_tax;
            $u->security_deduction = $request->security_deduction;
            $u->leave_deduction = $request->leave_deduction;
            $u->medical_allowance = $request->med_allowance;
            $u->other_allowance = $request->other_allowance;
            $u->pf = $request->pf;
            $u->tds = $request->tds;
            $u->total_deduction = $request->total_deduction;
            $u->total_amount = $request->total_amount;
            $u->save();

            return redirect('admin/listsalaryslip');
        }
        else
        {
            $data['salary'] = SalaryReview::select('salary_review.*',DB::raw("CONCAT(first_name,' ',last_name) as full_name"))->join('employee','salary_review.emp_id','=','employee.id')->where('salary_review.id',$id)->first();

            return view('admin.salary.edit',compact('data'));
        }
    }
    public function deleteSalarySlip()
    {
        $delete = SalaryReview::truncate();

        return redirect()->back();
    }
    public function getSalarybyMonth(Request $request)
    {
        $date = explode('-',$request->date);

        $salary = SalaryModel::select('salary.emp_id','salary.total_amount',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image')->whereMonth('date',$date[1])->whereYear('date',$date[0])->join('employee','salary.emp_id','=','employee.id')->orderBy('salary.total_amount','DESC')->get();
        $total = SalaryModel::whereMonth('date',$date[1])->whereYear('date',$date[0])->sum('total_amount');
        $count = count($salary);
        $res = [];
        if($count > 0) {
            $res = ['status'=>true,'message'=>'Get Salary Slip Successfully','data'=>$salary,'total'=>$total,'count'=>$count];
        } else {
            $res = ['status'=>false,'message'=>'No Data Found','count'=>$count];
        }
        return $res;
    }
    public function sendSalarySlip(Request $request)
    {
        $id = $request->date;
        
        Artisan::call('send', ['id' => $id ]);
    }
    public function salary($id)
    {
        $data['title']='Salary Slip Details ';
        $data['sub_title']='Salary';
        $data['sidebar']='Salary';

        $data['salary'] = SalaryModel::select('salary.*','salary.id as sid','employee.id as empId','employee.email','d.department_name','de.designation_name','b.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.first_name','employee.join_date','employee.image')
                        ->where('salary.id',$id)
                        ->leftJoin('employee','salary.emp_id','=','employee.id')
                        ->leftJoin('department as d','employee.department_id','=','d.id')
                        ->leftJoin('designation as de','employee.designation_id','=','de.id')
                        ->leftJoin('employee_bank_detail as b','employee.id','=','b.employee_id')
                        ->first();
        
        $data['sub_title_url']= 'admin/salary_details/'.$data['salary']->emp_id;
            
        return view('admin.salary.salary',compact('data'));
    }
    public function salaryByYear(Request $request)
    {
        $data = SalaryModel::select('salary.*',DB::raw('DATE_FORMAT(date, "%d-%m-%Y") as fdate'),'employee.currentCTC')->join('employee','employee.id','=','salary.emp_id')->where('emp_id',$request->id)->whereYear('salary.date','=',$request->year)->orderBy('id','DESC')->get();

        if(count($data) > 0) {

            $res = [
                'status'=>true,
                'message' => 'Get Data Successfully',
                'data' => $data
            ];
            return $res;

        } else {

            $res = [
                'status'=>false,
                'message' => 'No Data Found',
                'data' => []
            ];
            return $res;
        }
    }
    /* To get employee in salary slip add as per current month whose slip is not made */
    public function getEmployee(Request $request)
    {
        $date = $request->date;
        $d['m'] = date('m',strtotime($date));
        $d['y'] = date('Y',strtotime($date));

        $emp = DB::table('employee')->select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"))->where('department_id','!=',1)
               ->whereNotIn('id',function($q) use ($d){
                    $q->select('emp_id')->whereMonth('date',$d['m'])->whereYear('date',$d['y'])->from('salary');
               })->get();

        if(count($emp) > 0) {
            $res = [ 'status' => true, 'data' => $emp ];
            return $res;
        } else {
            $res = [ 'status' => false, 'message' => 'No Employee Found.' ];
            return $res;
        }
    }
    public function addsalary(Request $request)
    {
        $data = new SalaryModel;
        $data->emp_id =$request->emp_id;
        $data->date =$request->date;
        $data->pl =$request->pl;
        $data->cl =$request->cl;
        $data->lwp =$request->lwp;
        $data->month_days =$request->month_days;
        $data->working_days =$request->wd;
        $data->present_days =$request->present_days;
        $data->basic_salary =$request->basic_salary;
        $data->professional_tax =$request->pt;
        $data->security_deduction =$request->security_deduction;
        $data->medical_allowance =$request->ma;
        $data->other_allowance =$request->oa;
        $data->leave_travel_allowance =$request->lta;
        $data->pf =$request->pf;
        $data->save();
        return redirect('add_salary');

    }
    public function salary_details()
    {
        $data['salary'] = SalaryModel::select('salary.*','employee.id as empId','employee.email','d.department_name','de.designation_name','b.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.first_name','employee.join_date')
                        ->where('salary.id',$id)
                        ->leftJoin('employee','salary.emp_id','=','employee.id')
                        ->leftJoin('department as d','employee.department_id','=','d.id')
                        ->leftJoin('designation as de','employee.designation_id','=','de.id')
                        ->leftJoin('employee_bank_detail as b','employee.id','=','b.employee_id')
                        ->first();

        $name = $data['salary']->first_name.'_'.date('F-Y',strtotime($data['salary']->date)).'.pdf';

        $pdf = PDF::loadView('admin.salary.salaryslippdf',compact('data'));

        return $pdf->download($name);

    }
    public function empSalarySlipInfo(Request $req)
    {
        $data['employee'] = EmployeeDetailById($req->id);

        $date = $req->date;
        $m = date('m',strtotime($date));
        $data['monthDays'] = Carbon::now()->month($m)->daysInMonth;

        if($req->date != "") {
            $p = Checkin::where([
                    ['employee_id','=',$req->id],
                    ['type','=',1]
                  ])->whereMonth('date',date('m',strtotime($date)))
                  ->whereYear('date',date('Y',strtotime($date)))->count();
            
            $current_leave = EmpLeaveModel::where('emp_id',$req->id)->whereMonth('start_date',$m)->where('status',1)->get();
            $c1 = 0;
            if(!empty($current_leave)) {
                foreach($current_leave as $c) {
                    if($c->end_date != "") {
                        $to = Carbon::createFromFormat('Y-m-d', $c->start_date);
                        $from = Carbon::createFromFormat('Y-m-d',$c->end_date);
                        $diff = $to->diffInDays($from)+1;
                        $c1 = $c1 + $diff;
                    }else{
                        if($c->leavetype == 0) {
                            $c1 = $c1 + 0.5;
                        } else {
                            $c1 = $c1 + 1;
                        }
                    }
                }
            }

            $previousMonth = Carbon::createFromFormat('Y-m-d', $date)->subMonth()->format('m');
            $c2 = 0;
            $pre_leave = EmpLeaveModel::where('emp_id',$req->id)->whereMonth('start_date',$previousMonth)->where('status',1)->get();
            if(!empty($pre_leave)) {
                foreach($pre_leave as $c) {
                    if($c->end_date != "") {
                        $to = Carbon::createFromFormat('Y-m-d', $c->start_date);
                        $from = Carbon::createFromFormat('Y-m-d',$c->end_date);
                        $diff = $to->diffInDays($from)+1;
                        $c2 = $c2 + $diff;
                    }else{
                        if($c->leavetype == 0) {
                            $c2 = $c2 + 0.5;
                        } else {
                            $c2 = $c2 + 1;
                        }
                    }
                }
            }

            $data['basicInfo'] = [
                'present_days' => $p,
                'working_days' => workingDays($date),
                'curr_leave' => $c1,
                'pre_leave' => $c2
            ];
        }

        $res = [
            'status'=>true,
            'data'=>$data,
        ];
        return $res;
    }
    public function empSalaryDetails()
    {
        $data['title'] = "Salary Information";
        $data['sidebar'] = "Salary";
        $session = session('user_data');
        $id = $session->id;
        // return redirect()->route('employee_detail',['info'=> 'salary']);
        $data['employee_details'] = EmployeeDetailById($id);
        $data['year'] = getYear($data['employee_details']->join_date);
        $data['salary'] = SalaryModel::where('emp_id',$id)->whereYear('date',date('Y'))->orderBy('id','DESC')->get();
      

        return view('admin.salary.salary-details',compact('data'));
    }
    public function downloadSalarySlip($id)
    {
        $data['salary'] = SalaryModel::select('salary.*','employee.id as empId','employee.email','d.department_name','de.designation_name','b.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.first_name','employee.join_date')
                        ->where('salary.id',$id)
                        ->leftJoin('employee','salary.emp_id','=','employee.id')
                        ->leftJoin('department as d','employee.department_id','=','d.id')
                        ->leftJoin('designation as de','employee.designation_id','=','de.id')
                        ->leftJoin('employee_bank_detail as b','employee.id','=','b.employee_id')
                        ->first();

        $name = $data['salary']->first_name.'_'.date('F-Y',strtotime($data['salary']->date)).'.pdf';

        $pdf = PDF::loadView('admin.salary.salaryslippdf',compact('data'));

        return $pdf->download($name);

    }
}

