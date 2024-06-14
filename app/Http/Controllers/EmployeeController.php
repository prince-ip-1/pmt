<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\ProjectModel;
use App\Models\EmpLeaveModel;
use App\Models\TaskModel;
use App\Models\AttendanceModel;
use App\Models\AttendanceNewModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\SalaryModel;
use App\Models\EmployeeSalaryModel;
use App\Models\BankDetail;
use DataTables;
use Hash;
use DB;
use Carbon\Carbon;
use DateTime;
use URL;
use App\Helper\helper;
use App\Models\Checkin;

class EmployeeController extends Controller
{
    public function index($status = "")
    {
        $sess = Session('user_data');
        
        $data['title']='Employees List';
        $data['sub_title']='';
        if($status == 'active'){
            $status = 1;
        }elseif($status == 'deactive'){
            $status = 0;
        }else{
            $status = 1;
        }
        $data['sidebar'] = "Employee";
        
        $department = DepartmentModel::select('department.id','department.department_name')->where('department.id','!=',1)->get();
        
        return view('admin.employee.list',compact('data','department'));
    }
    
    public function pagination(Request $request)
    {
        $status = 1;
        if($request->search_status == 0){
           $status = 0;
        }
        
        $data['employee'] = [];
        if($request->ajax()){
            
            $query = DB::table('employee as e')
                            ->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','e.status')
                            ->leftjoin('department as d','d.id','=','e.department_id')
                            ->leftjoin('designation as de','de.id','=','e.designation_id')
                            ->where('e.user_type','!=','admin')
                            ->where('e.status','=',$status);
            
            if($request->department_id != "") {
                $query->where('e.department_id','=',$request->department_id);
            }
            if($request->search != "") {
                $search = $request->search;
                 $query->where('e.first_name','LIKE','%'.$search .'%');
                //$query->Where('e.email','LIKE','%'.$search .'%');
                // $query->orWhere('d.department_name','LIKE','%'.$search .'%');
                // $query->orWhere('de.designation_name','LIKE','%'.$search .'%');
            }
                            
            $data['employee'] = $query->paginate(12);
        }
         
        $html = view('admin.employee._employee_pagination',compact('data'))->render();
         
        return $html;

    }
     public function search(Request $request)
        {
           $data1 = [];
           $text = $request->text;
           $status = 1;

           if(isset($request->search_status) && $request->search_status == 0){
               $status = 0;
           }
           
           $data = DB::table('employee as e')
                    ->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','e.status')
                    ->leftjoin('department as d','d.id','=','e.department_id')
                    ->leftjoin('designation as de','de.id','=','e.designation_id')
                    ->where('e.user_type','!=','admin')->where('e.status',$status);
            if(!empty($text)) {
                $data->where(function($query) use ($text) {
                    $query->where('e.first_name','LIKE',"%{$text}%")
                        ->orWhere('e.email','LIKE',"%{$text}%")
                        ->orWhere('e.office_email','LIKE',"%{$text}%");
                });
            }
            if(!empty($request->department_id)) {
                $data = $data->where('e.department_id','=',$request->department_id);
            }

            $data = $data->get();
            $data1 =  view('admin.employee.search_list',compact('data'))->render();    
           
            return $data1;
             
        }
    public function employeedetail($id)
    {
        $session_data = getSessionData();
        $usersession = Session('user_data');
        $userdata = EmployeeDetailById($usersession->id);
        $permission = $userdata->permissions;
        
        if((isset($permission[2]->view) && $permission[2]->view != 1 && $id != $session_data->id) && Session('user_type') != 'admin' && getDepartment() != 1){
            return redirect('login');
        }
        $data['title']='Employee Details';
        $data['sub_title']= 'Employees';
        $data['sidebar'] = "Employee";
        $data['sub_title_url']= 'admin/employees_list';
         
        $data['employee_details'] = EmployeeDetailById($id);  
        if(empty($data['employee_details'])){
        $data['employee_details'] = DeactiveEmployeeDetailById($id);      
        }
        
        $data['leave']= EmpLeaveModel::select('leave_details.*','employee.first_name')->leftjoin('employee','leave_details.emp_id','=','employee.id')->where('employee.id',$id)->get();
    
        $data['salary'] = SalaryModel::where('emp_id',$id)->whereYear('created_at',date('Y'))->get();
        
        $data['bankDetail'] = BankDetail::where('employee_id',$id)->first();
        
        $data['year'] = getYear($data['employee_details']->join_date);
       
        $attendance= Checkin::where([
                           // ['date','=',date('Y-m-d')],
                            ['employee_id','=',$id],
                            ['type','=',1],
                           ])->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', date('Y'))
                        ->get();
        $data['attendance_list'] = array();                
       
        $data['month_number'] = date('t');
        $data['month'] = date('m');
        $data['y'] = date('Y'); 
        for($i = 1; $i <=  date('d'); $i++)
          {
            $dates_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.date('m').'-'.$data['y'];
          }
          $result = array();

        foreach($dates_array as $k1=>$row){
            $result[$k1] = new \stdClass();
            $result[$k1]->date = $row;
            $result[$k1]->id = "";
            $result[$k1]->checkin = "";
            $result[$k1]->checkout = "";
             $result[$k1]->breaktime = "";
            $result[$k1]->duration = "";
            $result[$k1]->remainTime = "";
            $result[$k1]->address = "";
            $result[$k1]->break = [];
            foreach($attendance as $k2=>$row2){ 
               $date2 = date('Y-m-d',strtotime($row));
               $break = Checkin::getBreakTime($date2,$id);
                if($date2 == $row2->date){ 
                    $result[$k1]->date = $row;
                    $result[$k1]->id = $row2->id;
                    $result[$k1]->checkin = $row2->time_in;
                    $result[$k1]->checkout = $row2->time_out;
                    $result[$k1]->breaktime = $break;
                    $duration = getHourDuration($row2->time_in,$row2->time_out); 
                    $result[$k1]->duration = $duration['duration'];
                    $result[$k1]->remainTime = $duration['remainTime'];
                    if(!empty($row2->checkin_location)){
                    $address = json_decode($row2->checkin_location); 
                    $result[$k1]->address = getAddress($address->lat,$address->long);
                    }
                    
                    //for break
                    $total_break = Checkin::where('date',$row2->date)->where('employee_id',$id)->where('type',2)->get();
                     $breaking_time = [];
                    foreach($total_break as $k3=>$row3){
                         $e = date('H:i');
                                                if($row3->time_out != "") {
                                                    $e = Carbon::parse($row3->time_out);
                                                }
                                                $s = Carbon::parse($row3->time_in);

                                                $dur =  $s->diff($e)->format('%H:%I:%S');
                        
                        $breaking_time[$k3] = new \stdClass();
                        $breaking_time[$k3]->time_in = isset($row3->time_out)?timeformat($row3->time_in):'-';
                        $breaking_time[$k3]->time_out = isset($row3->time_out)?timeformat($row3->time_out):'-';
                        $breaking_time[$k3]->duration = $dur; 
                    }
                        $result[$k1]->break = $breaking_time;

                }
            }
        }
        $present_days = DB::table('checkin')->where('employee_id',$id)->whereMonth('date',date('m'))->whereYear('date',date('Y'))->where('type',1)->count();
         $late_entry = DB::select('SELECT  * FROM checkin WHERE time_in > "10:30" AND type = 1 AND employee_id="'.$id.'" AND MONTH(date) = '.date('m'));
       
         $leave = DB::table('leave_details')->select('leave_details.id')->where('emp_id','=',$id)->whereMonth('start_date',date('m'))->where('status',1)->where('leave_details.leavetype','!=',11)->sum('leave_details.leavetype');
        
        $taken_leave = EmpLeaveModel::where('emp_id',$id)->whereMonth('start_date',date('m'))->whereYear('start_date',date('Y'))->where('status',1)->get();
       
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $cMonLeave = $cMonLeave + $leave;
                }
            }
        $taken_leave =$cMonLeave;
         
         $data['present_days'] = $present_days;
         $data['taken_leave'] = $taken_leave;
         $data['late_entry'] = count($late_entry);
        $data['date_list'] = array_reverse($result);
       
        return view('admin.employee.employee_details',compact('data'));
    }

public function get_base_host()
    {
        $root = "http://" . $_SERVER['HTTP_HOST'];
        $root .= str_replace(
            basename($_SERVER['SCRIPT_NAME']),
            "",
            $_SERVER['SCRIPT_NAME']
        );
        $base_url = $root;
        $host = preg_replace('/:\d+$/', '', $base_url);
        return trim($host);
}
    public function add()
    {
        $data['title']='Add Employee';
        $data['sub_title']= 'Employees';
        $data['sidebar'] = "Employee";
        $data['sub_title_url']= 'admin/employees_list';

        $dept = DepartmentModel::where('status',1)->get();

        return view('admin.employee.add',compact('dept','data'));
    }

    public function store(Request $request)
    {
        $check = EmployeeModel::where('email',$request->email)->count();
        if($check > 0) {
            $res = [
                'status' => false,
                'message' => 'Email Already Exist'
            ];

            return $res;
        }
        
        $password = $request->password;
        if($password == "") {
            $password = $request->fname.'1234';
        }

        if($request->file('image'))
        {
             $image = $request->file('image');
             $imageitem = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/users');
             $image->move($destinationPath,$imageitem);
        }
        $pin = rand(1000,9999);
        $edata = new EmployeeModel;
        $edata->first_name = $request->fname;
        $edata->last_name = $request->lname;
        $edata->user_type = $request->emp_type;
        $edata->email =$request->email;
        $edata->office_email =$request->office_email;
        $edata->contact_no = $request->contact;
        $edata->gender = $request->gender;
        $edata->dob = $request->dob;
        $edata->join_date = $request->join_date;
        $edata->address = $request->address;
        $edata->image = isset($imageitem) ? $imageitem : "";
        $edata->password = Hash::make($password);
        $edata->office_email_password = base64_encode($request->office_email_password);
        $edata->department_id = $request->department;
        $edata->designation_id = $request->designation;
        $edata->join_date = $request->join_date;
        $edata->document_info = (!empty($request->document_info) ? str_replace("'", '"', $request->document_info) : '');
        $edata->experience = $request->experience;
        $edata->previousCTC = $request->preCTC;
        $edata->currentCTC =  $request->currCTC;
        $edata->professional_tax =  $request->pTax;
        $edata->term =  $request->term;
        $edata->bond_duration =  $request->bond_duration;
        $edata->bond_start = $request->bondStart;
        $edata->bond_end = $request->bondEnd;
        $edata->training_start_date = NULL;
        $edata->training_end_date = NULL;
        $edata->deduction_amt =  $request->deduct_amt;
        $edata->tds =  $request->tds;
        $edata->office_pin = $pin;
        $edata->save();
        
        $bank = new BankDetail;
        $bank->employee_id = $edata->id;
        $bank->bank_name = $request->bank_name;
        $bank->branch_name = $request->branch_name;
        $bank->account_no = $request->account_no;
        $bank->ifsc_code = $request->ifsc_code;
        $bank->save();

        $salary = new EmployeeSalaryModel;
        $salary->employee_id = $edata->id;
        $salary->year = date('Y');
        $salary->amount =  isset($request->currCTC)?$request->currCTC:0;
        $salary->save();    

        
        $name = $request->fname.' '.$request->lname;
        $data = array('email'=>$request->email,'password'=>$password,'name'=>$name,'pin'=>$pin);
        $mailData = array(
            'to' => $request->email,
            'subject' => 'Welcome To PMT',
            'message' => view('mail.welcome',compact('data'))
        );
        sendMail($mailData);
    
        /*$email = $request->email;
        $name = $request->fname.' '.$request->lname;
        $data = array('email'=>$email,'password'=>$request->password,'name'=>$name);
        
        Mail::send('mail.welcome', $data, function($message)use ($email, $name) {
            $message->to($email, $name)->subject
                ('Welcome to PMT');
            $message->from('xyz@gmail.com','PMT');
        });*/
        
        $res = [
            'status' => true,
            'message' => 'Employee Added Successfully'
        ];

        return $res;
    }

    public function edit(Request $request,$id)
    {
        $data['title']='Edit Employee';
        $data['sub_title']= 'Employees';
        $data['sidebar']= 'Employee';
        $data['sub_title_url']= 'admin/employees_list';

        $employee = EmployeeModel::select('employee.*','employee_bank_detail.id as bank_id','employee_bank_detail.bank_name','employee_bank_detail.branch_name','employee_bank_detail.account_no','employee_bank_detail.ifsc_code')->leftjoin('employee_bank_detail','employee.id','=','employee_bank_detail.employee_id')->where('employee.id',$id)->first();

        $data['dept'] =  DepartmentModel::where('status',1)->get();

        $data['desig'] = DesignationModel::where('dept_id',$employee->department_id)->get();

        $d = json_decode($employee->document_info);
        $docArr = array('10th Marksheet','12th Marksheet','Degree Certificate','Aadhar Card','Salary Slip');
        $document = array();
          $getSalaryYear = DB::table('employee_salary')->where('employee_id',$id)->pluck('year')->toArray();
        
        $end = date('Y', strtotime('+10 years'));
        $years = [];                                              
        for ($year=date("Y"); $year<=$end; $year++)
        {
            $years[] = $year;
        }
        
        $data['years'] = array_diff($years,$getSalaryYear);
        foreach($docArr as $val) {
            $list['name'] = $val;
            $list['selected'] = 0;
            if(!empty($d)) {
                foreach($d as $v) {
                    if($v == $val) {
                        $list['selected'] = 1;
                    }
                }
            }
            $document[] = $list;
        }

        return view('admin.employee.edit',compact('data','employee','document'));
    }

    public function update(Request $request)
    {
        /*if($request->file('image') !== null || $request->file('image') !== "")
        {
             $image = $request->file('image');
             $imageitem = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/users');
             $image->move($destinationPath,$imageitem);

             $update = EmployeeModel::where('id',$request->employee_id)->update(['image'=>$imageitem]);
        }*/
        // p($request->bond_duration);
        $u = EmployeeModel::find($request->employee_id);
        $u->first_name = $request->fname; 
        $u->last_name = $request->lname;
        $u->user_type = $request->emp_type;
        $u->email =$request->email;
        $u->office_email =$request->office_email;
        $u->contact_no = $request->contact;
        $u->gender = $request->gender;
        $u->dob = $request->dob;
        $u->join_date = $request->join_date;
        $u->address = $request->address;
        $u->password = $request->password != "" ? Hash::make($request->password) : $u->password;
         $u->office_email_password = base64_encode($request->office_email_password);
        $u->department_id = $request->department;
        $u->designation_id = $request->designation;
        $u->join_date = $request->join_date;
        $u->last_date =  $request->last_date;
        $u->document_info = (!empty($request->document_info) ? str_replace("'", '"', $request->document_info) : '');
        $u->experience = $request->experience;
        $u->previousCTC = $request->preCTC;
        $u->currentCTC =  $request->currCTC;
        $u->professional_tax =  $request->pTax;
        $u->term =  $request->term;
        $u->bond_duration =  $request->bond_duration;
        $u->bond_start = $request->bondStart;
        $u->bond_end = $request->bondEnd;
        $u->training_start_date = NULL;
        $u->training_end_date = NULL;
        $u->deduction_amt =  $request->deduct_amt;
        $u->tds =  $request->tds;
        $u->status =  $request->status;
        $u->save();

        if(isset($request->bank_id) && $request->bank_id != "") {
            $b = BankDetail::find($request->bank_id);
            $b->bank_name = $request->bank_name;
            $b->branch_name = $request->branch_name;
            $b->account_no = $request->account_no;
            $b->ifsc_code = $request->ifsc_code;
            $b->save();
        } else {
            $b = new BankDetail;
            $b->employee_id = $request->employee_id;
            $b->bank_name = $request->bank_name;
            $b->branch_name = $request->branch_name;
            $b->account_no = $request->account_no;
            $b->ifsc_code = $request->ifsc_code;
            $b->save();
        }

        $res = [
            'status' => true,
            'message' => 'Employee Updated Successfully'
        ];

        return $res;
       
    }

    public function designation($text)
    {
        
        if($text == "10")
              {
                   return 'PHP Developer';
              }
              elseif($text == "20")
              {
                   return 'Android Developer';
              }
              elseif($text == "30")
              {
                   return 'IOS Developer';
              }
              elseif($text == "40")
              {
                   return 'IOS Intern';
              }
              elseif($text == "50")
              {
                   return 'PHP Intern';
              }
              elseif($text == "60")
              {
                   return 'Android Intern';
              }
              elseif($text == "70")
              {
                   return 'QA';
              }
              elseif($text == "80")
              {
                   return 'Project Manager';
              }
              else
              {
                return "No Data";
              }

    }
  
    public function listemployeedata()
    {
        $employee =EmployeeModel:: select('id','image',DB::raw('CONCAT(first_name, " ",last_name ) AS first_name'),'contact_no','join_date','designation','email','status')->where('user_type',"user");
        return Datatables::of($employee)
             ->addIndexColumn()

             ->addColumn('first_name', function ($employee) {
                $designation = $this->designation($employee->designation);
                $html=  '<div><strong>'.$employee->first_name.'</strong></div>';
                $html.=  '<div class="text-muted">'.$designation.'</div>';
                return $html;
              })
             ->editColumn('join_date', function ($employee) {
            return date('F d, Y', strtotime($employee->join_date));
        })
             ->addColumn('action', function($employee)
             {
            $html='<button class="btn btn-xs btn-secondary editemployee" data-id="'.$employee->id.'"><i class="fa fa-edit"></i></button>';
            $html.='&nbsp;<a data-toggle="tooltip" title="" data-original-title="View" href="'.route('employeedetails',['id'=>$employee]).'" class="btn btn-xs btn-secondary js-sweetalert"><i class="fa fa-eye"></i></a>'; 
            return $html;
            })
             ->addColumn('image',function($employee)
             {
                $url= asset('/upload/image/'.$employee->image);
                 return '<img src="'.$url.'" border="0" width="40" class="img-rounded avatar" align="center" />';
             })
             ->addColumn('status',function($employee)
             {
                if($employee->status == 1){
                     return '<i style="margin-left: 20px;" class="fa fa-circle text-blue"></i>';
                }else{
                      return '<i style="margin-left: 20px;" class="fa fa-circle text-red"></i>';   
                }
               // return '<input data-id="'.$employee->id.'" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" '.$employee->status.' ? checked : "" >';

               
             })
              ->editColumn('designation', function ($employee) {
              $designation = $this->designation($employee->designation);
              return $designation;;
            })  
            ->rawColumns(['image','first_name','status', 'action'])  
             ->toJson();
    }

    public function changestatus(Request $request)
    {
        $data = EmployeeModel::find($request->id);
        $data->status = $request->status;
        $data->save();
        return $data;
    }

    public function searchemployee(Request $request)
    {
            $data = EmployeeModel::select('id','designation')->where('id',$request->id)->get();
            return $data;
    }

    

    public function getdesignationbyDept(Request $req)
    {
        $get = DesignationModel::where('dept_id',$req->id)->where('status',1)->get();

        $res = [
            'status' => true,
            'data' => $get
        ];
        return $res;  
    }
    
     public function update_myprofile(Request $request)
    {
        if(isset($request->id) && !empty($request->id)){
            $myprofile = EmployeeModel :: find($request->id); 
             $message = 'Data updated successfully.';

            }else{
                $myprofile = new EmployeeModel;
                 $message = 'Data added successfully.';

            }


             $myprofile->first_name = $request->first_name; 
             $myprofile->email =$request->email;
             $myprofile->contact_no = $request->contact;
             $myprofile->gender = $request->gender;
             $myprofile->dob = $request->dob;
             $myprofile->address = $request->address;

               $myprofile->save();
              
               
         $status = 'true';
         $message = 'Data Updated Successfully.';

        return response()->json(compact('status','message'));
       
    }
    
    public function getsalary(Request $request)
    {
            if(isset($request->id) && !empty($request->id)){
            // $data['employee'] = EmployeeDetailById($req->id);
            $data = DB::table('employee_salary')->where('employee_id',$request->id)->get();       
            }else{
                $status = 'false';
                $message = 'Data not view successfully.';     
            }
         
            $status = 'true';
            $message = 'Data view Successfully.';
            return response()->json(compact('status','message','data'));
    }
    public function employee_salary(Request $request)
        {
        $data = new EmployeeSalaryModel;
        $data->employee_id = $request->id;
        $data->year = $request->year;
        $data->amount = $request->salary_amount;
        $data->save();
        
        $employee = EmployeeModel::find($data->employee_id); 
        $employee->currentCTC =  $request->salary_amount;
        $employee->save();
        $status = 'true';
        $message = 'Data added successfully.';   
        return response()->json(compact('status','message','data'));  
        }

   
     public function OfficeLock(Request $request)
    {
         $emp_id = getSessionData();
        if(empty($request->pin)){
            $status = 'false';
            $message = 'Please enter pin.';
             return response()->json(compact('status','message'));
        }
        $pin = $request->pin;
       
        $result = EmployeeModel::where('id',$emp_id->id)->where('office_pin',$pin)->first();
       if(!empty($result)){
             $status = 'true';
             $message = 'Pin match.';
        }else{
             $status = 'false';
             $message = 'You enter wrong pin number.';
        }
        return response()->json(compact('status','message'));
       
    }
}



