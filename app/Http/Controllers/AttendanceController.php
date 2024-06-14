<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\Checkin;
use App\Models\EmpLeaveModel;
use App\Models\EmployeeModel;

class AttendanceController extends Controller
{

     public function attendance_list()
    {
        $data['title']="Attendance List";
        $data['sidebar']="Attendance";
        $data['attendance'] = array();
        $attendance_data = Checkin::select('checkin.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"))
                            ->leftjoin('employee','employee.id','=','checkin.employee_id')
                            ->where([
                            ['date','=',date('Y-m-d')],
                            ['status','=',1],
                            ['type','=',1],
                            
                        ])->orderBy('id', 'asc')->get();
                       
       /*  $holiday = HolidayModel::orderBy('id','desc')->get();  
         p($holiday);*/
       foreach($attendance_data as $k=>$row){
            $attendance =new \stdClass();
            $emp = EmployeeDetailById($row->employee_id); 
            $attendance->employee_id= $emp->id;
            $attendance->full_name= $emp->full_name;
            $attendance->image = $emp->image;
            $attendance->checkin = timeformat($row->time_in);
            $attendance->checkout = timeformat($row->time_out);
             $data['attendance'][] = $attendance;

        }
   
        return view('admin.attendance.list',compact('data'));
    }
    
    public function view_break_detail()
    {
        $data['title']="On Board";
        $data['sidebar']="Attendance";

        $details = Checkin::select('checkin.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"), 'employee.image')
                    ->leftjoin('employee','employee.id','=','checkin.employee_id')
                    ->where([
                        ['date','=',date('Y-m-d')],
                        ['type','=',1]
                    ])
                    ->orderBy('id','DESC')
                    ->get();

        $data['checkIn'] = array();
        $data['breakIn'] = array();
        $data['breakOut'] = array();
        $data['checkOut'] = array();
        $breakOutTime = array();
        $checkOutTime = array();
        
        foreach($details as $val) {

          if($val->time_out == "") {

            $checkBreak = Checkin::where('date',date('Y-m-d'))->where('employee_id',$val->employee_id)->where('type',2)->orderBy('id','DESC')->first();
          
            if(!empty($checkBreak)) {

              if($checkBreak->time_out != NULL) {
                  $list['id'] = $checkBreak->id;
                  $list['employee_id'] = $val->employee_id;
                  $list['full_name'] = $val->full_name;
                  $list['image'] = $val->image;
                  $list['duration'] = Checkin::getBreakTime($val->date,$val->employee_id);
                  $breakOutTime[] = strtotime($checkBreak->date.' '.$checkBreak->time_out);
                  $data['breakOut'][] = $list;
              } else {
                  $list['id'] = $checkBreak->id;
                  $list['employee_id'] = $val->employee_id;
                  $list['full_name'] = $val->full_name;
                  $list['image'] = $val->image;
                  $e = date('H:i');
                  $s = Carbon::parse($checkBreak->time_in);
                  $dur =  $s->diff($e)->format('%H:%I:%S');
                  $list['duration'] = $dur;
                  $data['breakIn'][] = $list;
              }
            } else {
                $list['id'] = $val->id;
                $list['employee_id'] = $val->employee_id;
                $list['full_name'] = $val->full_name;
                $list['image'] = $val->image;
                $data['checkIn'][] = $list;
            }
          } else {
            $list['id'] = $val->id;
            $list['employee_id'] = $val->employee_id;
            $list['full_name'] = $val->full_name;
            $list['image'] = $val->image;
            $duration = getHourDuration($val->time_in, $val->time_out);
            $list['duration'] = $duration['duration'];
            $checkOutTime[] = strtotime($val->date.' '.$val->time_out);
            $data['checkOut'][] = $list;
          }
        }
        
        $pending = EmployeeModel::select('employee.id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"), 'employee.image')
                          ->where('status', 1)
                          ->where('user_type','!=','admin')
                          ->whereNotIn('id', function($query){
                                $query->select('employee_id')
                                ->from('checkin')
                                ->where('date', date('Y-m-d'))
                                ->whereRaw('checkin.employee_id = employee.id');
                            })->get();
                            
        $data['pending'] = array();
        $date = date('Y-m-d');
        foreach($pending as $val) {
            $list['id'] = $val->id;
            $list['full_name'] = $val->full_name;
            $list['image'] = $val->image;
            $list['isAbsent'] = 0;
            $leaveCheck = DB::select('Select COUNT(*) as COUNT from `leave` where emp_id = ? and status NOT IN (2,3) and (start_date = ? or end_date = ? or (? BETWEEN start_date and end_date)) ',[$val->id,$date,$date,$date]);

            if($leaveCheck[0]->COUNT > 0) {
              $list['isAbsent'] = 1;
            }
            $data['pending'][] = $list;
        }
        
        usort($data['breakIn'], function($a,$b) {
          return $b['id'] <=> $a['id'];
        });
        
        array_multisort($breakOutTime, SORT_DESC, $data['breakOut']);
        
        array_multisort($checkOutTime, SORT_DESC, $data['checkOut']);

        return view('admin.attendance.on-board',compact('data'));

    }
    
    public function attendance_details($id)
    {
        $session_data = getSessionData();
        $userdata = EmployeeDetailById($id);
        $permission = $userdata->permissions;
       
       /* if($id != $session_data->id && Session('user_type') != 'admin' && getDepartment() != 1){
            return redirect('login');
        }*/
         if(!empty($permission) && isset($permission[6]->view) && $permission[6]->view != 1){
            return redirect('login');
        }
        $data['title'] = "Attendance Information";
        $data['sidebar'] = "Attendance";
       
        $data['employee_details'] = $userdata;
        $attendance= Checkin::where([
                            ['employee_id','=',$id],
                            ['type','=',1],
                           ])->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', date('Y'))
                        ->get();
                        
        $data['attendance_list'] = array();                
        $data['month'] = date('m');
        $data['year'] = date('Y');
        
        for($i = 1; $i <=  date('d'); $i++)
        {
            $dates_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.date('m').'-'.$data['year'];
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
            $breaktime = 0;
            $checkWkend = Carbon::parse($row);
            if($checkWkend->isWeekend()) {
              continue;
            }
            
            foreach($attendance as $k2=>$row2){ 
               $date2 = date('Y-m-d',strtotime($row));
              
                if($date2 == $row2->date){ 
                    $break = Checkin::getBreakTime($date2,$id);
                    $result[$k1]->date = $row;
                    $result[$k1]->id = $row2->id;
                    $result[$k1]->checkin = timeformat($row2->time_in);
                    $result[$k1]->checkout = timeformat($row2->time_out);
                    $result[$k1]->breaktime = $break;
                    $duration = getHourDuration($row2->time_in,$row2->time_out); 
                    //$result[$k1]->duration = $duration['duration'];
                    $working_hours = GetWorkingHoures($break,$duration['duration']); 
                    $result[$k1]->duration = $working_hours;
                    $result[$k1]->remainTime = $duration['remainTime'];
                    if(!empty($row2->address)){
                    $result[$k1]->address = $row2->address;
                    }
                    
                    //For Break
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
                    
                    unset($dates_array[$k1]);
                    unset($attendance[$k2]);
                    break;

                }
            }
        }
      
        $data['date_list'] = array_reverse($result);
        
        $checkinEntry = DB::table('checkin')->select(DB::raw(' count(DISTINCT(date)) as presentDays'),DB::raw('SUM( case when time_in > "10:30" then 1 else 0 end ) as lateEntries'))->where('employee_id',$id)->whereMonth('date',date('m'))->whereYear('date',date('Y'))->where('type',1)->first();
   
        $taken_leave = DB::table('leave')->where('emp_id',$id)->whereYear('start_date',date('Y'))->whereMonth('start_date',date('m'))->where('status',1)->get();
        
        $cMonLeave = 0;
        if(!empty($taken_leave)) {
            foreach($taken_leave as $c) {
                $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                $cMonLeave = $cMonLeave + $leave;
            }
        }
        
        $taken_leave =$cMonLeave;
         
        $data['present_days'] = $checkinEntry->presentDays;
        $data['taken_leave'] = $taken_leave;
        $data['late_entry'] = $checkinEntry->lateEntries;
        $data['year'] = getYear($data['employee_details']->join_date);
      
        return view('admin.attendance.attendance-details',compact('data'));
    }

    public function getAttendanceByMonth(Request $request)
    {
         $id = $request->emp_id;

       $attendance= Checkin::where([
                            ['employee_id','=',$id],
                            ['type','=',1],
                           ])->whereMonth('created_at',$request->month)
                            ->whereYear('created_at', $request->year)
                        ->get();
                      
        $data['attendance_list'] = array();                
        $data['month'] = $request->month;
        $data['month_number'] =Carbon::now()->month($data['month'])->daysInMonth;;
        $data['year'] = $request->year;
        if(date('m',strtotime(date('Y-m-d'))) == $request->month && $data['year'] == date('Y')){
            $data['month_number'] = date('d'); 
        }else{
            $data['month_number'] = cal_days_in_month(CAL_GREGORIAN, $data['month'], $data['year']);
        }
        
        
        for($i = 1; $i <=  $data['month_number']; $i++)
        {
          $dates_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.$data['month'].'-'.$data['year'];
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
            $result[$k1]->break = [];
            $checkWkend = Carbon::parse($row);
            if($checkWkend->isWeekend()) {
              continue;
            }
           
                foreach($attendance as $k2=>$row2){ 
               $date2 = date('Y-m-d',strtotime($row));
                if($date2 == $row2->date){ 
                    $break = Checkin::getBreakTime($date2,$id);
                    $result[$k1]->date = $row;
                    $result[$k1]->id = $row2->id;
                    $result[$k1]->checkin = timeformat($row2->time_in);
                    $result[$k1]->checkout = timeformat($row2->time_out);
                    $result[$k1]->breaktime = $break;
                    $duration = getHourDuration($row2->time_in,$row2->time_out);
                    $working_hours = GetWorkingHoures($break,$duration['duration']); 
                    $result[$k1]->duration = $working_hours;
                    //$result[$k1]->duration = $duration['duration'];
                    $result[$k1]->remainTime = $duration['remainTime'];
                    if(!empty($row2->address)){
                    $result[$k1]->address = $row2->address;
                    }
                    
                    //for break
                    $total_break = Checkin::where('date',$row2->date)->where('employee_id',$request->emp_id)->where('type',2)->get();
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
                    unset($dates_array[$k1]);
                    break;
                }
              
            }
           
            
        }
       
        if(count($attendance) > 0){
            $status = true;
            $message = 'Data Fetch Successfully.';
            $data['date_list'] =  array_reverse($result);;
         
            $checkinEntry = DB::table('checkin')->select(DB::raw('count(id) as presentDays'),DB::raw('SUM( case when time_in > "10:30" then 1 else 0 end ) as lateEntries'))->where('employee_id',$id)->whereMonth('date',$request->month)->whereYear('date',$request->year)->where('type',1)->first();
           
                
            $taken_leave = EmpLeaveModel::where('emp_id',$request->emp_id)->whereMonth('start_date',$request->month)->whereYear('start_date',$request->year)->where('status',1)->get();
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $cMonLeave = $cMonLeave + $leave;
                }
            }
            $taken_leave =$cMonLeave;
            $data_html = [];
            $data_html['present_days'] = $checkinEntry->presentDays;
            $data_html['taken_leave'] = $taken_leave;
            $data_html['late_entry'] = $checkinEntry->lateEntries;
         
            $html = view('admin.attendance.monthly-list', compact('data'))->render();
        } else {
            $status = false;
            $message = 'Data Not Found.';
            $html = "";
            $data_html = [];
       }

        return Response()->json(compact('status','message','html','data_html'));;
    }
}
