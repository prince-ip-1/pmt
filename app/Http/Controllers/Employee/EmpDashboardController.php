<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\EmployeeModel;
use App\Models\ProjectModel;
use App\Models\EmpLeaveModel;
use App\Models\Checkin;
use Session;
use DateTime;
class EmpDashboardController extends Controller
{
    public function dashboard()
    {
        $emp = Session::get('user_data');

        $title = "Dashboard";
        $data['sidebar'] = "Dashboard";
        
        $data['presentDays'] = DB::table('checkin')->where('employee_id',$emp->id)->whereMonth('date',date('m'))->whereYear('date',date('Y'))->where('type',1)->distinct()->count('date');
        
        /*$project = DB::table('project')
        ->select(DB::raw('count(project.id) as count'))
        ->where('member',$emp->id)
        ->get();*/
        
        $leave = DB::table('leave')->select('leave.id')->where('emp_id','=',$emp->id)->whereMonth('start_date',date('m'))->whereYear('start_date',date('y'))->where('status',1)->where('leave.leavetype','!=',11)->sum('leave.leavetype');
     
        $fiscalYr = calculateFiscalYearForDate(date('m'));
        $sFiscalYr = explode(':',$fiscalYr);
       
        $leave_taken = DB::table('leave')->where('start_date','>=',$sFiscalYr[0])->where('start_date','<=',$sFiscalYr[1])->where('emp_id',$emp->id)->where('status','=',1)->get();
    //   p($leave_taken);
        $yMonLeave = 0;
            if(!empty($leave_taken)) {
                foreach($leave_taken as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $yMonLeave = $yMonLeave + $leave;
                }
            }
        $total_leave_taken  =  $yMonLeave;
        $taken_leave = EmpLeaveModel::where('emp_id',$emp->id)->whereMonth('start_date',date('m'))->whereYear('start_date',date('Y'))->where('status',1)->get();
            
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $cMonLeave = $cMonLeave + $leave;
                }
            }
        $leave =$cMonLeave;
        
        $lateEntry = DB::select('SELECT  * FROM checkin WHERE time_in > "10:30" AND type = 1 AND employee_id="'.$emp->id.'" AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())');
        
        $message = "";
        $break = Checkin::select('*')->where('date',date('Y-m-d'))->where('employee_id',$emp->id)->where('type',2)->orderBy('id','DESC')->first();
        if(!empty($break)){
          $duration =  getHourDuration(date('H:i:s',strtotime(date('H:i:s'))),date('H:i',strtotime($break['time_in'])));
            if($break['time_in'] != ""  && $break['time_out'] == ""){
                if(strtotime($duration['duration']) > strtotime('00:45:00'))
                {
                    $message = "Right now!, You are in break...Please break out when you reach your time";
                }
            
            }
        }
        
        $employee_data = EmployeeModel::where('id',$emp->id)->first();
       
        $join_date = $employee_data->join_date;  /*2/8/2021*/
        $join_year = date('Y',strtotime($join_date));
        $join_month = date('m',strtotime($join_date));
        $currentyear = date("Y");
        $privious_year = $currentyear - 1;
        $finance_date = date($privious_year.'-04-01');  //'2021-10-08'   /*1/4/2022*/
        $data['leave_balance'] = isset($employee_data->leave_balance)?$employee_data->leave_balance:0;
        
        $start2 = date_create($join_date);
        $end2 = date_create(now());
        $c_months2 = date_diff($start2, $end2);
        if($c_months2->format('%y') >= 1){
            $from =  $finance_date;
        }else{
            $from =  $join_date;
        }
        
        $start1 = date_create($from);
        $end1 = date_create(now());
        $c_months = date_diff($start1, $end1);
        $cm = $c_months->format('%m') + 1;
        $m = $cm;
        // echo print_r($c_months2);die;
       
        /*if($c_months2->format('%y') >= 1){
            $m =   $cm + 1;
        }*/
        
        $howeverManyMonths = $m;
        
        return view('employee.dashboard',compact('title','data','leave','lateEntry','message','total_leave_taken','howeverManyMonths'));
    }
}
