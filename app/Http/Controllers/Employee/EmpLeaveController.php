<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\EmpLeaveModel;
use Session;
use DB;
use App\Models\NotificationListModel;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;
use Notification;
class EmpLeaveController extends Controller
{
     public function pending_leave()
     {
        $data['title'] = "Employee Pending Leave";
        $data['sub_title'] = "";
        $data['sidebar'] = "Leave";
        $data['leave'] = EmpLeaveModel::select('leave_details.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"))->leftjoin('employee as e','e.id','=','leave_details.emp_id')->where('leave_details.status',0)->orderBy('start_date','ASC')->get();
        
       $data['employee'] = DB::table('employee')->select('id','first_name','last_name')->get();

        return view('admin.leave.pending_list',compact('data'));
    }
     public function all_leave()
     {
        $data['title'] = "All Employee Leave";
        $data['sub_title'] = "";
        $data['sidebar'] = "Leave";
        $data['leave'] = EmpLeaveModel::select('leave_details.*','e.first_name','e.last_name')->leftjoin('employee as e','e.id','=','leave_details.emp_id')->where('leave_details.status','!=',0)->orderBy('start_date','Desc')->get();
        
       $data['employee'] = DB::table('employee')->select('id','first_name','last_name')->get();

        return view('admin.leave.all_leave_list',compact('data'));
    }

    public function emp_leave_list()
     {
        $data['title'] = "Leave Information";
        $data['sub_title'] = "";
        $data['sidebar'] = "Leave List";
        
        $session = session('user_data');
        $id = $session->id;
        
        $data['leave'] = EmpLeaveModel::select('leave_details.*','e.first_name','e.last_name')->leftjoin('employee as e','e.id','=','leave_details.emp_id')->where('emp_id',$id)->orderBy('leave_details.id','desc')->get();
        
        $data['employee'] = DB::table('employee')->select('id','first_name','last_name')->get();
        
        return view('admin.leave.emp_list',compact('data'));
    }

    public function add_empleave(Request $request)
    {
        
       $usersession = Session('user_data');
        $userdata = EmployeeDetailById($usersession->id);
        $permission = $userdata->permissions;
        $id = $usersession->id;
        $leave = DB::table('leave_details')->select('emp_id')->where('id','=',$request->id)->first();
         
        if(getDepartment() == '1' ||  isset($permission[3]->edit) && $permission[3]->edit == 1 || (isset($leave->emp_id) && $leave->emp_id == $id) && (isset($request->id) && !empty($request->id)))
         
        {  
            if(!empty($request->id)){ 
                    
                    $empleave = EmpLeaveModel :: find($request->id);
                    $empleave->status = 0;
                    $empleave->title = $request->title;
                    $empleave->reason = $request->reason;
                    $empleave->start_date = $request->start_date;
                    $empleave->end_date = $request->end_date;
                    $empleave->leavetype = $request->leave_type;
                    $empleave->leave_days_others = $request->leave_days_others;
                    $empleave->save();
                     $status = 'true';
                     $message = 'Data updated successfully.';
            }else{
                
                    $empleave = new EmpLeaveModel;
                    $empleave->emp_id = $id;
                   
                    $empleave->title = $request->title;
                    $empleave->reason = $request->reason;
                    $empleave->start_date = $request->start_date;
                    $empleave->end_date = $request->end_date;
                    $empleave->leavetype = $request->leave_type;
                    $empleave->leave_days_others = $request->leave_days_others;
                    $empleave->save();
                     $status = 'true';
                    $message = 'Leave applied successfully.';
            }
           
           
            
            
        }
        else{  
        $status = 'true';
        $message = 'Leave applied successfully.';
        
        $check = EmpLeaveModel::where('start_date',$request->start_date)->where('emp_id',$id)->where('is_automatic',1)->first();
        
        if(!empty($check)) {
            $empleave = EmpLeaveModel::find($check->id);
            $empleave->status = "0";
            $empleave->title = $request->title;
            $empleave->reason = $request->reason;
            $empleave->start_date = $request->start_date;
            $empleave->end_date = $request->end_date;
            $empleave->leavetype = $request->leave_type;
            $empleave->leave_days_others = $request->leave_days_others;
            $empleave->is_automatic = 0;
            $empleave->save();
        } else {
            $empleave = new EmpLeaveModel;
            $empleave->emp_id = $id;
            $empleave->status = 0;
            $empleave->title = $request->title;
            $empleave->reason = $request->reason;
            $empleave->start_date = $request->start_date;
            $empleave->end_date = $request->end_date;
            $empleave->leavetype = $request->leave_type;
            $empleave->leave_days_others = $request->leave_days_others;
            $empleave->save();
        }
        
         //notification

        $notifylist = new NotificationListModel;
        $notifylist->sender_id = $id;
        $notifylist->receiver_id = 1;
        $notifylist->notification_type_id = 1;
        $notifylist->table_name = 'leave';
        $notifylist->data_id = $empleave->id;
        $notifylist->save();
        $status = 'true';
        $emp_details = EmployeeDetailById($id);
        $company_details = GetCompanyDetail();
        $end_date = '';
        if(!empty($request->end_date)){
            $end_date = ' to ' . dateformat($request->end_date);
        }
        $d = "";
        if($request->leave_type == '11')
        {
           $d = $request->leave_days_others;
        }
        else
        {
            $d = $request->leave_type; 
        }
     
        $date = dateformat($request->start_date) . $end_date ;
        $data = array('full_name'=>$emp_details->full_name,
                        'department_name'=>$emp_details->department_name,
                        'date'=>$date,
                        'duration' => $d,
                        'subject'=>$request->title,
                        'message'=>$request->reason ,
                        );
              
        $mailData = array(
                    'to' => $company_details->hr_email,
                    'subject' => 'Leave Application',
                    'message' => view('mail.apply_leave',compact('data'))
                );
             
                sendMail($mailData);
        }
        return response()->json(compact('status','message'));
       
    }

   
     public function add_reply(Request $request)
    {
        if(isset($request->id) && !empty($request->id)){
            $data = EmpLeaveModel :: find($request->id);
            
            $data->status = $request->status;
            $data->reply_message = $request->reply_message;
            $data->reply_date = date('Y-m-d');
            $data->save();
            $message = "";
            if($request->status == "1") {
                $message = 'Leave Approved Successfully.';
                $reply_message_status = "APPROVED";
                
                
            }
            elseif($request->status == "2") {
                $message = 'Leave Rejected Successfully.';
                $reply_message_status = "DECLINED";
            }
             $notifylist = new NotificationListModel;
                    $notifylist->sender_id = 1;
                    $notifylist->receiver_id = $data->emp_id;
                    $notifylist->notification_type_id = 2;
                    $notifylist->table_name = 'leave';
                    $notifylist->data_id = $data->id;
                    $notifylist->save();
                    $status = 'true';
                    
                     $emp_details = EmployeeDetailById($data->emp_id);
                     $notification = getTable('notification',['id'=>2]);
                    // $company_details = GetCompanyDetail();
                  
                   
                    $reply_message = str_replace('[USERNAME]',$emp_details->full_name,$notification->message);
                    $reply_message = str_replace('[STATUS]',$reply_message_status,$reply_message);
                    
                    $id = $data->emp_id;
                    
                    $data = array(
                        'reply_message_status'=>$reply_message_status,
                        'full_name' => $emp_details->full_name,
                        'message'=>$reply_message .''.$request->reply_message,
                        );
                        
                    $fcmTokens = EmployeeModel::where('id',$id)->pluck('fcm_token')->toArray();
                    $msg = $reply_message .''.$request->reply_message;
                    
                    Larafirebase::withTitle('Leave Notification')
                        ->withBody($msg)
                        ->sendMessage($fcmTokens);
                        
                    $mailData = array(
                                'to' => $emp_details->email,
                                'subject' => 'Reply On Leave',
                                'message' => view('mail.reply_leave',compact('data'))
                            );
              sendMail($mailData,1);
            $status = 'true';
        }else{
             $status = 'false';
            $message = 'Data Not Found.';
        }   
        
        return response()->json(compact('status','message'));
}
 public function cancelleave(Request $request)
    {
         if(isset($request->id) && !empty($request->id)){
            $holiday = EmpLeaveModel::find($request->id);
            $message = 'Status Updated Successfully.';
        }else{
            $holiday = new EmpLeaveModel;
            $message = 'Status Not Update.';
        }
        $session = session('user_data');
        $id = $session->id;
        $data = EmpLeaveModel::find($request->id);
        $data->status = $request->type;
        $data->save();
        $status = "true";
        
        $emp_details = EmployeeDetailById($id);
        $company_details = GetCompanyDetail();
        $end_date = '';
        if(!empty($data->end_date)){
            $end_date = ' to ' . dateformat($data->end_date);
        }
        
        $date = dateformat($data->start_date) .''. ($end_date);
       
        $data = array('full_name'=>$emp_details->full_name,
                        'department_name'=>$emp_details->department_name,
                        'date'=>$date,
                        );
              
        $mailData = array(
                    'to' => $company_details->hr_email,
                    'subject' => 'Cancel Leave',
                    'message' => view('mail.cancel_leave',compact('data'))
                );
             
                sendMail($mailData);
        return response()->json(compact('status','message'));
    }
    public function leave_details(Request $request)
    {
        $id = $request->id; 
        $data = EmpLeaveModel::select('leave_details.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'designation.designation_name')->leftjoin('employee','employee.id','=','leave_details.emp_id')->leftjoin('designation','designation.id','=','employee.designation_id')->where('leave_details.id','=',$id)->first();
        $data->start_date = dateformat($data->start_date);
        $data->end_date = dateformat($data->end_date);
      
        $status = 'true';
        return response()->json(compact('status','data'));   
    }

}