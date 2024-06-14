<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\EmployeeModel;
use App\Models\NotificationModel;
use App\Http\Requests;
use App\Models\NotificationListModel;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;
use Notification;
class NotificationController extends Controller
{
    public function notification()
    { 
        $data['title'] = "Notification Type";
        $data['sidebar'] = "notification Type";
        $data['sub_title'] = "";
        $data['notification'] = NotificationModel::orderBy('id','desc')->get();
        return view('admin.notification.list',compact('data'));
    }


    public function add_notification(Request $request)
    {   
        if(isset($request->id) && !empty($request->id)){
            $notification = NotificationModel :: find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $notification = new NotificationModel;
             $message = 'Data added successfully.';

        }
        $notification->title = $request->title;
        $notification->message = $request->message;     
        $notification->save();
        $status = 'true';
        return response()->json(compact('status','message'));
        
    }
   public function notification_list()
    {
    $data['title'] = "Notification List";
    $data['sidebar'] = "notification Type";
    $data['sub_title'] = "";
    $data['notification'] = NotificationListModel::orderBy('id','desc')->get();
    
    $id = Session('user_data')->id; 
    if(getDepartment() == 1){
      $noti = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image','leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
    ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
    ->leftjoin('employee','employee.id','=','notification_list.sender_id')
    ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
    ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')
    //->where('receiver_id','=',$id)
    ->orderBy('notification_list.id','desc')->paginate(25);
    }else{
         $noti = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image','leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
            ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
            ->leftjoin('employee','employee.id','=','notification_list.sender_id')
            ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
            ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')->orderBy('notification_list.id','desc')
            ->where('receiver_id','=',$id)
            ->orWhere('notification_type','=',1)
            ->orWhere('notification_list.emp_id','LIKE','%'.$id.'%')
            ->paginate(25); 
    }
    
    
    $data['notification_list'] = [];
    // p($noti);
    $a = "";
    if(empty($noti)){
         $data['notification_list'] = $a;
    }else{
        $data['notification_list'] = $noti;
    }
    foreach($noti as $k=>$row)
    { 
        $status = "";
        if($row->leave_status == 1){
        $status = "Approved";
        }
        elseif($row->leave_status == 2){
        $status = "Declined";
        } 
    if($row->notification_type == 0){ 
        $sender_name =   $row->full_name;
        $receiver_name =   $row->receiver_name;
        $message = str_replace('[USERNAME]',$row->full_name,$row->not_message);
        $message = str_replace('[STATUS]',$status,$message);
        $title = $row->title;
    }else if($row->notification_type == 1){ 
         $sender_name =   $row->full_name;
         $receiver_name =   'All';
         $message = $row->message;
          $title = $row->notification_type_id;
    }else{
         $sender_name =   $row->full_name;
         $receiver_name =   getReceiverName($row->emp_id);
          $message = $row->message;
         $title = $row->notification_type_id;

    }
    $noti[$k]->sender_name = $sender_name;
    $noti[$k]->receiver_name = $receiver_name;
    $noti[$k]->message = $message;
    $noti[$k]->title = $title;
    $data['notification_list'] =  $noti;
}

 if(getDepartment() == 1){
        return view('admin.notification.notification_list',compact('data'));
    }else{
        return view('employee.employee_notification_list',compact('data'));
    }
}

public function send_notification()
{
$data['title']='Send Notification';
$data['sub_title']='';
$data['sidebar']='notification Type';
return view('admin.notification.send_notification',compact('data'));
}


public function send_to(Request $request)
{
$data['title']='Send Notification';
$data['sub_title']='';
$data['sidebar']='Send Notification';


if(!empty($request->send_to)){
    if($request->send_to == 2 && empty($request->employee))
    {
         $status = 'false';
         $message = 'Please select employee';
        return response()->json(compact('status','message'));
    }
    if(empty($request->message))
    {
         $status = 'false';
         $message = 'Please write your Message';
        return response()->json(compact('status','message'));
    }
    

    $sendnoti = new NotificationListModel;
    $sendnoti->sender_id = Session('user_data')->id;;
    $sendnoti->notification_type = $request->send_to;
    $sendnoti->notification_type_id = $request->title;

    $sendnoti->emp_id = isset($request->employee)?json_encode($request->employee):""; 
    $sendnoti->message = $request->message;
    $sendnoti->save();           
    $status = 'true';
    $message = 'Data Inserted Successfully.';
    
    if($request->send_to == 1) {
        $fcmTokens = EmployeeModel::whereNotNull('fcm_token')->where('status',1)->pluck('fcm_token')->toArray();
        
        Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);
    }

        return response()->json(compact('status','message'));


}else{
      $status = 'false';
      $message = 'Something went Wrong';
      return response()->json(compact('status','message'));
    }

 }

  public function notification_details(Request $request)
    {
        
        $row = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
        ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
        ->leftjoin('employee','employee.id','=','notification_list.sender_id')
        ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
        ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')->orderBy('notification_list.id','desc')->where('notification_list.id','=',$request->id)->first();
       
  $status = "";
    if($row->leave_status == 1){
    $status = "Approved";
    }
    elseif($row->leave_status == 2){
    $status = "Declined";
    } 


  
    if($row->notification_type == 0){ 
        $row->sender_name =   $row->full_name;
        $row->receiver_name =   $row->receiver_name;
        $row->message = str_replace('[USERNAME]',$row->full_name,$row->not_message);
        $row->message = str_replace('[STATUS]',$status,$row->message);
        $row->title = $row->title;
    }else if($row->notification_type == 1){ 
         $row->sender_name =   $row->full_name;
         $row->receiver_name =   'All';
         $row->message = $row->message;
          $row->title = $row->notification_type_id;
    }else{
         $row->sender_name =   $row->full_name;
         $row->receiver_name =   getReceiverName($row->emp_id);
          $row->message = $row->message;
         $row->title = $row->notification_type_id;
    }
    $row->date=date('d-m-Y',strtotime($row->created_at));

$status = "true";
$data = $row;
return response()->json(compact('status','data'));

    }
    
    public function pagination(Request $request)
    {
        $id = Session('user_data')->id;
        
        //if($request->ajax()){
        if(getDepartment() == 1){ 
    
         $noti = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message','employee.image',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image','leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
                ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
                ->leftjoin('employee','employee.id','=','notification_list.sender_id')
                ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
                ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')
                //->where('receiver_id','=',$id)
                ->orderBy('notification_list.id','desc')->paginate(25);
    }else{
        $noti = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message','employee.image',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image','leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
                ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
                ->leftjoin('employee','employee.id','=','notification_list.sender_id')
                ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
                ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')->orderBy('notification_list.id','desc')
                ->where('receiver_id','=',$id)
                ->orWhere('notification_type','=',1)
                ->orWhere('notification_list.emp_id','LIKE','%'.$id.'%')->paginate(25);
     } 
   
            $data['notification_list'] = [];

        foreach($noti as $k=>$row)
                { 
                    $status = "";
                    if($row->leave_status == 1){
                    $status = "Approved";
                    }
                    elseif($row->leave_status == 2){
                    $status = "Declined";
                    } 
            
                if($row->notification_type == 0){ 
                    $sender_name =   $row->full_name;
                    $receiver_name =   $row->receiver_name;
                    $message = str_replace('[USERNAME]',$row->full_name,$row->not_message);
                    $message = str_replace('[STATUS]',$status,$message);
                    $title = $row->title;
                }else if($row->notification_type == 1){ 
                     $sender_name =   $row->full_name;
                     $receiver_name =   'All';
                     $message = $row->message;
                      $title = $row->notification_type_id;
                }else{
                     $sender_name =   $row->full_name;
                     $receiver_name =   getReceiverName($row->emp_id);
                      $message = $row->message;
                     $title = $row->notification_type_id;

                }
                $noti[$k]->sender_name = $sender_name;
                $noti[$k]->receiver_name = $receiver_name;
                $noti[$k]->message = $message;
                $noti[$k]->title = $title;
                $data['notification_list'] =  $noti;
            }
            $html = view('admin.notification._notification_pagination',compact('data'))->render();
    
        return $html;
    }
}
