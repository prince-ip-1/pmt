<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TaskModel;
use App\Models\TasklogsModel;
use App\Models\ProjectModel;
use App\Models\TaskTrackingModel;
use App\Models\CommentModel;
use App\Models\EmployeeModel;
use App\Models\TaskNotificationModel;
use App\Models\DepartmentModel;
use App\Http\Requests;
use DataTables;
use Illuminate\Support\Str;
use View;
use Session;
use mail;
use App\Models\Checkin; 
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;
use Carbon\Carbon;
use PDF;

class TaskController extends Controller
{
    public function viewtask()
    {
        /*$sess = session('admin');
        if(empty($sess))
        {
            return redirect('login');
        }*/
        $data = [];
        $data['title'] = "Tasks List";
        $data['sub_title'] = "";
        $data['sidebar']='Tasks List';
        $session = session('user_data');

         //->whereIn('employee_id', array($session->id))
        $project_id = session('project_id');
        if(getDepartment() == 1 || getManagerDepartment() == 3){
            $data['project_list']= ProjectModel::select('id','project_name','employee_id')->orderBy('id','desc')->get();
        }else{
            $data['project_list']= ProjectModel::select('id','project_name','employee_id')->where('employee_id','LIKE','%'.$session->id.'%')
            ->orWhere('project_manager_id',$session->id)->orWhere('project_report_id',$session->id)->orderBy('id','desc')->get();
        }
         
        if(empty($project_id)){
            
             if(count($data['project_list']) > 0){
                $employee = $data['project_list'][0]['employee_id'];
            }else{
                $employee = '';
            }
        }else{
            $project_list= ProjectModel::select('id','employee_id')->where('id',$project_id)->get();
           
            $employee = $project_list[0]['employee_id'];
            
        }
       
       
        $data['employee_list'] = getDeveloperList($employee);
        $data['qa_list'] = getQaList();
        $data['to_do_task'] = TaskModel::where('tasks.status','=',0)->count();
        $data['in_progress_task'] = TaskModel::where('tasks.status','=',1)->count();
        $data['in_testing_task'] = TaskModel::where('tasks.status','=',2)->count();
        $data['backlog_task'] = TaskModel::where('tasks.status','=',3)->count();
        $data['deploy_task'] = TaskModel::where('tasks.status','=',4)->count();
    
        return view('admin.task.task-list',compact('data'));
    }
  
    public function GetTaskDetailsById(Request $request)
    {
        $task = TaskModel::find($request->id);
        if(!empty($task)){
            echo json_encode(['status'=>'true','message'=>'Data fetch successfully','data'=>$task]);
        }else{
            echo json_encode(['status'=>'false','message'=>'Data not found']);
        }
       
    }
    
    public function getTaskList(Request $request)
    {
        $session_project_id = session('session_project_id');
     
        if(empty($session_project_id)){
             $session = Session::put('project_id',$request->project_id);
        }
        $session = session('user_data');
        
        if(!empty($request->task_employee_id) && empty($request->task_qa_id)){
             $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                            ->leftjoin('employee as e','tasks.report_to','=','e.id')
                            ->where('tasks.status','=',$request->tab)
                            ->where('tasks.project_id','=',$request->project_id)
                            //->where('assign_to', array($request->task_employee_id))
                            ->where('assign_to', 'like', '%' . $request->task_employee_id . '%')
                            ->where('tasks.is_delete','=',0)
                            ->orderBy('id','desc')->get();
                 
        $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id) ->where('assign_to', 'like', '%' . $request->task_employee_id . '%')->where('tasks.is_delete','=',0)->count();
                       
        }else if(!empty($request->task_qa_id) && empty($request->task_employee_id)){
             $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                            ->leftjoin('employee as e','tasks.report_to','=','e.id')
                            ->where('tasks.status','=',$request->tab)
                            ->where('tasks.project_id','=',$request->project_id)
                            //->where('assign_to', array($request->task_employee_id))
                            ->where('assign_to_qa', 'like', '%' . $request->task_qa_id . '%')
                            ->where('tasks.is_delete','=',0)
                            ->orderBy('id','desc')->get();
            
        $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id) ->where('assign_to', 'like', '%' . $request->task_employee_id . '%')->where('tasks.is_delete','=',0)->count();
                       
        }else if(!empty($request->task_qa_id) && !empty($request->task_employee_id)){
             $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                            ->leftjoin('employee as e','tasks.report_to','=','e.id')
                            ->where('tasks.status','=',$request->tab)
                            ->where('tasks.project_id','=',$request->project_id)
                            ->where('assign_to', 'like', '%' . $request->task_employee_id . '%')
                            ->where('assign_to_qa', 'like', '%' . $request->task_qa_id . '%')
                            ->where('tasks.is_delete','=',0)
                            ->orderBy('id','desc')->get();
            
        $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id) ->where('assign_to', 'like', '%' . $request->task_employee_id . '%')->where('tasks.is_delete','=',0)->count();
                       
        }else{
            $session = session('user_data');
            if($session->department_id == 3){ 
                $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                                ->leftjoin('employee as e','tasks.report_to','=','e.id')
                                ->where('tasks.status','=',$request->tab)
                                ->where('tasks.project_id','=',$request->project_id)
                                ->where('tasks.is_delete','=',0)
                                ->where('assign_to_qa', 'like', '%' . $session->id . '%')
                                ->orderBy('id','desc')->get();
            $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id)->where('assign_to_qa', 'like', '%' . $session->id . '%')->where('tasks.is_delete','=',0)->count();
               
            }else{ 
                if(getDepartment() == 1 || getManagerDepartment() == 3){
                    
                $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                                ->leftjoin('employee as e','tasks.report_to','=','e.id')
                                ->where('tasks.status','=',$request->tab)
                                ->where('tasks.project_id','=',$request->project_id)
                                ->where('tasks.is_delete','=',0)
                                //->where('assign_to', 'like', '%' . $session->id . '%')
                                ->orderBy('id','desc')->get();
                $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id)->where('tasks.is_delete','=',0)->count();
                }else{ 
                    $data['tasks'] = TaskModel::select('tasks.id','task_title','task_description','tasks.status','tasks.is_delete','assign_to','assign_to','end_date','project_id','task_project_id','priority','task_type')
                                ->leftjoin('employee as e','tasks.report_to','=','e.id')
                                ->where('tasks.status','=',$request->tab)
                                ->where('tasks.project_id','=',$request->project_id)
                                ->where('tasks.is_delete','=',0)
                                ->where('assign_to', 'like', '%' . $session->id . '%')
                                ->orderBy('id','desc')->get();
                $total_count = TaskModel::where('tasks.status','=',$request->tab)->where('tasks.project_id','=',$request->project_id)->where('assign_to', 'like', '%' . $session->id . '%')->where('tasks.is_delete','=',0)->count();
                }
            }
             
        
        
                               
        }
       
      
       
        foreach($data['tasks'] as $k=>$row){
            $getEmployeeListData = getEmployeeListData($row['assign_to']);
            $data['tasks'][$k]['employee_list'] = $getEmployeeListData;
        }
       
        $data['tab'] = $request->tab; 
        $result =  View::make("admin.task.to_do_task",compact("data"))
            ->render();
            session()->forget('session_project_id');
            return response()->json(compact('result','total_count'));
      
    }
    public function getTaskEmplist(Request $request){
        $project_list= ProjectModel::select('id','employee_id')->where('id',$request->project_id)->first();
        $employee = $project_list['employee_id'];
        $employee_data = getDeveloperList($employee);
       
        $employee_list = '';
        $employee_list = '<option value="0">Please Select Employee</option>';
       foreach($employee_data as $row){
           $employee_list .= '<option value="'.$row['id'].'">'.$row["full_name"].'</option>';
       }
        
        return response()->json(compact('employee_list'));
    }
    public function getTaskCount(Request $request)
    {
         $session = Session::put('project_id',$request->project_id);
        
         $task_count = TaskModel::where('tasks.project_id','=',$request->project_id)->count();
      
         return response()->json(compact('task_count'));
    }
    
    public function getTaskCommentList(Request $request)
    {
      
      if($request->emp_id > 0){
           $tasks_comment_list = CommentModel::select('comments.id','comments.user_id','comments.task_id','comments.comments','comments.status','t.task_title',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as name"),'e1.image','comments.updated_at')
         ->leftjoin('tasks as t','comments.task_id','=','t.id')
         ->leftjoin('employee as e1','comments.user_id','=','e1.id')
         ->where('comments.task_id','=',$request->task_id)
         ->where('comments.user_id', array($request->emp_id))
         ->orderBy('comments.id','desc')->get();
           
        }else{
         $tasks_comment_list = CommentModel::select('comments.id','comments.user_id','comments.task_id','comments.comments','comments.status','t.task_title',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as name"),'e1.image','comments.updated_at')
         ->leftjoin('tasks as t','comments.task_id','=','t.id')
         ->leftjoin('employee as e1','comments.user_id','=','e1.id')
         ->where('comments.task_id','=',$request->task_id)
         ->orderBy('comments.id','desc')->get();
        }
          $result =  View::make("admin.task.comment_list",compact("tasks_comment_list"))
            ->render();
            $status = 'true';
            $total = count($tasks_comment_list);
          
         
            return response()->json(compact('status','result','total','tasks_comment_list'));
    }
    public function getTaskTrackingList(Request $request)
    {
        if($request->emp_id > 0){
             $list = TaskTrackingModel::select('task_tracker.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.image')
             ->leftjoin('employee as e','task_tracker.user_id','=','e.id')
             ->where('task_tracker.task_id','=',$request->task_id)
             ->where('task_tracker.user_id', array($request->emp_id))
             ->orderBy('task_tracker.id','desc')->get();
        }else{
        $list = TaskTrackingModel::select('task_tracker.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.image')
             ->leftjoin('employee as e','task_tracker.user_id','=','e.id')
             ->where('task_tracker.task_id','=',$request->task_id)
             ->orderBy('task_tracker.id','desc')->get();
        }
        $total = count($list);
            
          $result =  View::make("admin.task.tracking_list",compact("list","total"))
            ->render();
            $status = 'true';
            return response()->json(compact('status','result','total'));
    }
   public function delete_task(Request $request)
    {
        $data = TaskModel::find($request->id);
        $data->is_delete = "1"; 
        $data->save();
        $status = 'true';
        $message = 'Task Deleted Successfully';
        return response()->json(compact('status','message'));
        
    }
   public function post_task(Request $request)
    {
        $userdata = Session('user_data');
        $user_id = $userdata->id;
        if($request->id == ""){
            
             $task_count = TaskModel::where('tasks.project_id','=',$request->project_id)->count();
             $data = new TaskModel;
             
               $data->task_project_id = $task_count + 1;
              
            $status = 'true';
            $message = 'Task Added Successfully';
        }else{
            $data = TaskModel::find($request->id);
            $status = 'true';
            $message = 'Task Updated Successfully';
        }
            $data->user_id = $user_id;
            $data->project_id = $request->project_id;
            $data->task_title = $request->task_title;
            $data->task_description = $request->task_description;
            $data->assign_to = isset($request->assign_to)?json_encode($request->assign_to):"";
            //$data->assign_to_dev = isset($request->assign_to_dev) && !empty($request->assign_to_dev)?json_encode($request->assign_to_dev):"";
            $data->duration = $request->duration;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->priority = $request->priority;
            $data->status = $request->status;
            $data->assign_to_qa = isset($request->assign_to_qa)?json_encode($request->assign_to_qa):"";
            $data->report_to = $request->report_to;
            $data->task_type = $request->task_type;
            $data->is_notify = isset($request->is_notify)?$request->is_notify:"0";
            $data->save();
            
            $data_new = "";
            if(!empty($request->assign_to)){
            $data_new =[
                'id'=>$data->id,
                'assign_to'=>json_encode($request->assign_to)
                ];
            $this->TaskNotification($data_new);
            }
        return response()->json(compact('status','message'));
    }
    
    function TaskNotification($data)
    { 
        $session = session('user_data');
        $data_new = new TaskNotificationModel;
        $data_new->task_id = $data['id'];
        $data_new->employee_id = $data['assign_to'];
        $data_new->save();
         $task_details = TaskModel::select('tasks.id','tasks.task_project_id','tasks.task_title','project.id','project.project_name')
        ->leftjoin('project','project.id','=','tasks.project_id')
        ->where('tasks.id','=',$data['id'])->first();
        $emp_id = json_decode($data_new->employee_id);
       
        $email =  [];
        
        foreach($emp_id as $val)
        { 
            $employee = EmployeeModel::select('employee.*')->where('id',$val)->first();
            $email[]  =  $employee->office_email;
        }  
        $email = implode (",",$email);
        $p = explode(" ",$task_details->project_name);
        $acronym = "";
        
         if(count($p) == 1){
             foreach ($p as $w) {
        $acronym .= substr($w, 0, 3);
             }
         }
         else{
        foreach ($p as $w) {
          $acronym .= mb_substr($w, 0, 1);
         }
        }
           
       $template_description = DB::table('custom_template')->select('custom_template.*')->where('template_title','=','add_task')->first();
       $task_data = TaskModel::select('tasks.user_id','tasks.id','tasks.task_title','tasks.task_project_id','tasks.task_title','tasks.task_description','tasks.assign_to','tasks.assign_to_qa','tasks.project_id','project.project_name','tasks.report_to')
       ->leftjoin('project','project.id','=','tasks.project_id')
       ->where('tasks.id','=',$data['id'])
       ->first();
      $useremail = EmployeeDetailById($session->id);
   
      $html = $template_description->template_description;
      $subject = $template_description->email_subject;
     
      $subject = str_replace("[PROJECT_NAME]", $task_data->project_name, $subject);
      $subject = str_replace("[TASK_PROJECT_ID]", $task_data->task_project_id, $subject);
      $subject = str_replace("[TASK_TITLE]", $task_data->task_title, $subject);
      $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
      $html = str_replace("[TASK_ID]", $task_data->task_project_id, $html);
      $html = str_replace("[USER_NAME]", $useremail->full_name, $html);
      $html = str_replace("[EMAIL]", $useremail->office_email, $html);
     
      $html = str_replace("[TASK_TITLE]", $task_data->task_title, $html);
      $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
      $html = str_replace("[TASK_DESCRIPTION]", $task_data->task_description, $html);
     
       $mailData = array(
                    'to' => $email,
                    'subject' => $subject,
                    'message' => view('mail.task_mail',compact('html'))
                );
              
        $res = sendMail($mailData);
       
        return true;
    }
    public function TestEmail()
    {
          $template_description = DB::table('custom_template')->select('custom_template.*')->where('template_title','=','add_task')->first();
          $task_data = TaskModel::select('tasks.user_id','tasks.task_title','tasks.task_description','tasks.assign_to','tasks.project_id','project.project_name')
          ->leftjoin('project','project.id','=','tasks.project_id')
          ->where('tasks.id','=',12)
          ->first();
          $username = 'Ruchika R Shah';
          $useremail = 'ruchika.bluepixel@gmail.com';
          $html = $template_description->template_description;
          $html = str_replace("[USER_NAME]", $username, $html);
          $html = str_replace("[EMAIL]", $useremail, $html);
          $html = str_replace("[TASK_TITLE]", $task_data->task_title, $html);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_DESCRIPTION]", $task_data->task_description, $html);
          return view('mail.task_mail',compact('html'));
          return true;
    }
    public function TaskDetails(Request $request)
    {
        $data = TaskModel::select('tasks.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as reporter_name"),DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as qa_name"))
        ->leftjoin('employee as e','tasks.report_to','=','e.id')
        ->leftjoin('employee as e1','tasks.assign_to_qa','=','e1.id')
        ->where('tasks.id',$request->id)
        ->first();
       
        $qas = json_decode($data['assign_to_qa']);
        $qaNameStr = '';
        $c = $qas != "" ? count($qas) : 0;
        
        if($qas != "") {
            foreach($qas as $k => $q){
                $empDetail = EmployeeDetailById($q);
                $add = $c == ($k+1) ? '' :', ';
                $qaNameStr .= (isset($empDetail->full_name)?$empDetail->full_name:"None").$add;
            }
        }
        $data['employee_qa_list'] = $qaNameStr;
        
        $getEmployeeListData = getEmployeeListData($data['assign_to']);
       
        $emp = $emp2 = '';
        foreach($getEmployeeListData as $row){
             $emp .= '<div class="task-list-table_div mr-1">
                        <a href="#!">
                            <img style="width: 30px;" class="img-fluid img-radius" src="'.$row['image'].'" title="'.$row['full_name'].'">
                        </a>
                     </div>';
        }
         $emp_list = '';
         $emp_list .= '<option value="0">Please Select</option>';
        foreach($getEmployeeListData as $row){
             $emp_list .= '<option value="'.$row['id'].'">'.$row['full_name'].'</option>';
                       
        }
        
        $data['employee_list'] =  $emp;
        $data['emp_list'] =  $emp_list;
        if($data->assign_to_qa == -1){
            $data['qa_name'] = 'None';
        }
          
        $data['start_date'] =  dateFormat($data['start_date']); 
        $data['end_date'] =  dateFormat($data['end_date']); 
        if($data->priority =="m")
        {
            $data['priority'] = "Medium";
        }
        elseif($data->priority == "h")
        {
            $data['priority'] = "High";
        }
        else{
            $data['priority'] = "Low";
        }
        $data->data_status = "3";
         if($data->status =="4"){
             $data->data_status  = '5';
         }
         $session = session('user_data');
         $check = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$session->id],
                    ['task_id','=',$request->id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','DESC')->first();
                    
        $data['timer_start'] = "";
        $data['time_duration'] = "";
         if(!empty($check)){
             $data['timer_start'] = $check->start_date . ' ' . $check->start_time;
             $data['time_duration'] = "";
         }  
          $data['status_name'] = getValue($data->status,'Task_Status');
       
        return response()->json(compact('data'));
       
   }
   
    function changeTaskStatus(Request $request)
    {
        $session = session('user_data');
       
        $user_id = $session->id;
         $task = TaskModel::select('tasks.assign_to','tasks.assign_to_qa','project.project_report_id','tasks.report_to')
        ->leftjoin('project','project.id','=','tasks.project_id')
        ->where('tasks.id',$request->task_id)
        ->first();
        
        
        $assign = json_decode($task['assign_to']);
        $assign_qa = json_decode($task['assign_to_qa']);
        
        $task_details = TaskModel::select('tasks.id','tasks.task_project_id','tasks.task_title','project.id','project.project_name')
        ->leftjoin('project','project.id','=','tasks.project_id')
        ->where('tasks.id','=',$request->task_id)->first();
     
        $emp_id = json_decode($task->assign_to_qa);
       // $project_report_id = $task->project_report_id;
        $task_report_id = $task->report_to;
        
        /*$employee = EmployeeModel::select('employee.*')->where('id',$emp_id)->first();
        $email  =  $employee->office_email;*/
        
       $qa_email = [];
        foreach($emp_id as $value)
        {
            if($value != -1){
                $employee = EmployeeModel::select('employee.*')->where('id',$value)->first();
                $qa_email[]  =  $employee->office_email;
            }
        }
         $qa_email = implode (",",$qa_email);
        
        // $employee1 = EmployeeModel::select('employee.*')->where('id',$project_report_id)->first();
        // $project_report_email  =  $employee1->office_email;
        
        $employee2 = EmployeeModel::select('employee.*')->where('id',$task_report_id)->first();
        $task_report_email  =  $employee2->office_email;
        $fcmTokens = $employee2->fcm_token;
        
        $employee_id = json_decode($task['assign_to']);
        $employee_email =  [];
        foreach($employee_id as $val)
        { 
            $employee2 = EmployeeModel::select('employee.*')->where('id',$val)->first();
            $employee_email[]  =  $employee2->office_email;
        }  
        $employee_email = implode (",",$employee_email);
        
        $p = explode(" ",$task_details->project_name);
        $acronym = "";
        
         if(count($p) == 1){
             foreach ($p as $w) {
        $acronym .= substr($w, 0, 3);
             }
         }
         else{
        foreach ($p as $w) {
          $acronym .= mb_substr($w, 0, 1);
         }
        }
        
        $check = TaskTrackingModel::where([
                    //['user_id','=',$session->id],
                    ['task_id','=',$request->task_id],
                    ['start_date','=',date('Y-m-d')],
                    ['end_time','=',NULL]
                    ])->orderBy('id','DESC')->count();
    
        if($check != 0){
            $status = 'false';
            $message = 'Timer start you can not move';
            return response()->json(compact('status','message'));
        }
        $change_status = false;
        $completed_status = false;
        $bug_status = false;
        if(getDepartment() == 1){
            $change_status = true;
        }
        if($request->status_id == 0 && in_array($session->id,$assign))
        {
            $change_status = true;
            $completed_status = true;
        }
        if($request->status_id == 1 && in_array($session->id,$assign)){
             $change_status = true;
              $completed_status = true;
        }
        if($request->status_id == 2 && !in_array($session->id,$assign_qa) && in_array($session->id,$assign)){
             $change_status = true;
              $completed_status = true;
             
        }
        if($request->status_id == 2 && $request->from_status == 3 && in_array($session->id,$assign))
        {
            $change_status = true;
            $completed_status = false;
        }
        if($request->status_id == 3 && $request->from_status == 2 && in_array($session->id,$assign)){
             $change_status = true;
             $completed_status = true;
             
        }
       
        if(($request->from_status == 4 || $request->from_status == 5)
            && in_array($session->id,$assign)){
               $change_status = false;
               $completed_status = false;
        }
       
        
       if(($request->status_id == 4 && $request->from_status == 5 && in_array($session->id,$assign_qa))
        ||($request->status_id == 5 && $request->from_status == 4 && in_array($session->id,$assign_qa))
         || ($request->status_id == 4 && $request->from_status == 3 && in_array($session->id,$assign_qa))
         || ($request->status_id == 0 && $request->from_status == 4 && in_array($session->id,$assign_qa))
         || ($request->status_id == 0 && $request->from_status == 5 && in_array($session->id,$assign_qa))
         || ($request->status_id == 5 && isset($request->type) && $request->type == 'mark_as_done' && in_array($session->id,$assign_qa))
        ){
             $change_status = true;
             $bug_status = false;
        }
       
        if($request->status_id == 0 && $request->from_status == 4 && $session->id == $assign_qa){
            $change_status = true;
            $bug_status = true;
            $completed_status=false;
        }
       
        if($completed_status == true){
            $template_description = DB::table('custom_template')->select('custom_template.*')->where('template_title','=','completed_task')->first();
            $task_data = TaskModel::select('tasks.user_id','tasks.id','tasks.task_title','tasks.task_project_id','tasks.task_title','tasks.task_description','tasks.assign_to','tasks.project_id','project.project_name')
           ->leftjoin('project','project.id','=','tasks.project_id')
           ->where('tasks.id','=',$request->task_id)
           ->first();
           
           $useremail = EmployeeDetailById($session->id);
   
          $html = $template_description->template_description;
          $subject = $template_description->email_subject;
         
          $subject = str_replace("[PROJECT_NAME]", $task_data->project_name, $subject);
          $subject = str_replace("[TASK_PROJECT_ID]", $task_data->task_project_id, $subject);
          $subject = str_replace("[TASK_TITLE]", $task_data->task_title, $subject);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_ID]", $task_data->task_project_id, $html);
          $html = str_replace("[USER_NAME]", $useremail->full_name, $html);
          $html = str_replace("[EMAIL]", $useremail->office_email, $html);
         
          $html = str_replace("[TASK_TITLE]", $task_data->task_title, $html);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_DESCRIPTION]", $task_data->task_description, $html);
         
           $mailData = array(
                'to' => $qa_email,
                'subject' => $subject,
                'message' => view('mail.task_mail',compact('html'))
            );
              
        $res = sendMail($mailData);
            
        }
        if($bug_status == true){
           $template_description = DB::table('custom_template')->select('custom_template.*')->where('template_title','=','backlog_task')->first();
           $task_data = TaskModel::select('tasks.user_id','tasks.id','tasks.task_title','tasks.task_project_id','tasks.task_title','tasks.task_description','tasks.assign_to','tasks.project_id','project.project_name')
           ->leftjoin('project','project.id','=','tasks.project_id')
           ->where('tasks.id','=',$request->task_id)
           ->first();
           
           $useremail = EmployeeDetailById($session->id);
   
          $html = $template_description->template_description;
          $subject = $template_description->email_subject;
         
          $subject = str_replace("[PROJECT_NAME]", $task_data->project_name, $subject);
          $subject = str_replace("[TASK_PROJECT_ID]", $task_data->task_project_id, $subject);
          $subject = str_replace("[TASK_TITLE]", $task_data->task_title, $subject);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_ID]", $task_data->task_project_id, $html);
          $html = str_replace("[USER_NAME]", $useremail->full_name, $html);
          $html = str_replace("[EMAIL]", $useremail->office_email, $html);
          $html = str_replace("[TASK_TITLE]", $task_data->task_title, $html);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_DESCRIPTION]", $task_data->task_description, $html);
         
           $mailData = array(
                'to' => $employee_email,
                'subject' => $subject,
                'message' => view('mail.task_mail',compact('html'))
            );
              
        $res = sendMail($mailData);
            // $mailData = array(
            //         'to' => $employee_email,
            //         'subject' => '[Backlog] ('.strtoupper($acronym).' - '.$task_details->task_project_id.') - '.$task_details->task_title,
            //         'message' => ucfirst($session->name) . 'Task is in Bug status'.$task_details->task_title
            //     );
            // $res = sendMail($mailData);
        }
        if($change_status == true || $bug_status == true){
            $data = TaskModel::find($request->task_id);
            $data->status = $request->status_id;
            $data->save();
        
            $task_logs = new TasklogsModel;
            $task_logs->user_id = $user_id;
            $task_logs->task_id = $request->task_id;
            $task_logs->from_status = $request->from_status;
            $task_logs->to_status = $request->status_id;
            $task_logs->save();
            $from_status = getValue($request->from_status,'Task_Status');
            $to_status = getValue($request->status_id,'Task_Status');
            
            $template_description = DB::table('custom_template')->select('custom_template.*')->where('template_title','=','task')->first();
           $task_data = TaskModel::select('tasks.user_id','tasks.id','tasks.task_title','tasks.task_project_id','tasks.task_title','tasks.task_description','tasks.assign_to','tasks.project_id','project.project_name')
           ->leftjoin('project','project.id','=','tasks.project_id')
           ->where('tasks.id','=',$request->task_id)
           ->first();
           
           $useremail = EmployeeDetailById($session->id);
 
          $html = $template_description->template_description;
          $subject = $template_description->email_subject;
         
          $subject = str_replace("[PROJECT_NAME]", $task_data->project_name, $subject);
          $subject = str_replace("[TASK_PROJECT_ID]", $task_data->task_project_id, $subject);
          $subject = str_replace("[TASK_TITLE]", $task_data->task_title, $subject);
          $subject = str_replace("[TASK_STATUS]", $to_status, $subject);
          $html = str_replace("[FROM_STATUS]", $from_status, $html);
          $html = str_replace("[TO_STATUS]", $to_status, $html);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_ID]", $task_data->task_project_id, $html);
          $html = str_replace("[USER_NAME]", $useremail->full_name, $html);
          $html = str_replace("[EMAIL]", $useremail->office_email, $html);
          $html = str_replace("[TASK_TITLE]", $task_data->task_title, $html);
          $html = str_replace("[PROJECT_NAME]", $task_data->project_name, $html);
          $html = str_replace("[TASK_DESCRIPTION]", $task_data->task_description, $html);
         
          $mailData = array(
                'to' => $task_report_email,
                'subject' => $subject,
                'message' => view('mail.task_mail',compact('html'))
            );
              
        $res = sendMail($mailData);
            // $mailData = array(
            //         'to' => $task_report_email,
            //         'subject' => '[' .$to_status. '] ('.strtoupper($acronym).' - '.$task_details->task_project_id.') - '.$task_details->task_title,
            //         'message' => ucfirst($session->name) . ' changed task from ' . $from_status . ' to '. $to_status
            //     );
            // $res = sendMail($mailData);
            
            $msg = ucfirst($session->name) . ' changed task from ' . $from_status . ' to '. $to_status;
            Larafirebase::withTitle('Task Notification')
                ->withBody($msg)
                ->sendMessage($fcmTokens);
            $time = date('H:i:s');
            $date = date('Y-m-d');
            
            if($check == 1){
                $updateBreak = TaskTrackingModel::where([
                     ['user_id','=',$session->id],
                     ['task_id','=',$request->task_id],
                     ['end_time','=',NULL]

                ])->update(['end_time'=>$time,'end_date'=>$date]);
             }
              $status = 'true';
              $message = 'Status Change Successfully';
        
        }else{
             $status = 'false';
            $message = 'You can not change status';
        }
      
       
        return response()->json(compact('status','message'));
    }
    
    public function AddComments(Request $request)
    {
        $session = session('user_data');
       if($request->comment_id == ""){
        $user_id = $session->id;
        $data = new CommentModel;
        $data->user_id = $user_id;
        $data->task_id = $request->task_id;
        $data->comments = $request->comments;
        $data->save();
        $date = date('Y-m-d H:i:s');
       
       
        $html = '<div class="media task_comment_'.$data->id.'">
                              <a class="" href="#">
                              <img class="media-object img-radius m-r-20 comment-img" src="'.getUserImage().'" alt="'.$session->name.'">
                              </a>
                              <div class="media-body b-b-muted social-client-description">
                                 <div class="chat-header comment_name">'.$session->name.'
                                 <span class="text-muted f-right">
                                  '. get_timeago($date).'
                                 <button href="#" class="btn  btn-primary waves-effect waves-light edit_comment btn-sm_comment" id="edit_comment"  data-id="'.$data->id.'" data-task_id="'.$request->task_id.'" data-add="Update" data-comment="'.$request->comments.'">
                                 <i class="fa fa-pencil" style="margin-left:-7px;font-size:14px;"></i>
                                 </button>&nbsp;&nbsp;
     <button href="#" class=" delete_data btn btn-danger waves-effect waves-light btn-group-sm btn-sm_comment "  data-id="'.$data->id.'">
     <i class="fa fa-trash" style="margin-left:-7px;font-size:14px;"></i></button>
    </span></div>
                                 <p class="text-muted">'.$request->comments.'
                                     </p>
                              </div>
                           </div>';
       
            $status = 'true';
            $message = 'Comments Added Successfully.';
            $data = $html;
       }
       else{
            
        $data = CommentModel::find($request->comment_id);
        $data->comments = $request->comments;
        $data->save();
        $date = date('Y-m-d H:i:s');
        $html = '<div class="media task_comment_'.$request->comment_id.'">
                              <a class="" href="#">
                              <img class="media-object img-radius m-r-20 comment-img" src="'.getUserImage().'" alt="'.$session->name.'">
                              </a>
                              <div class="media-body b-b-muted social-client-description">
                                 <div class="chat-header comment_name">'.$session->name.'
                                 <span class="text-muted f-right">
                                 '. get_timeago($date).'
                                 <button href="#" class="btn  btn-primary waves-effect waves-light edit_comment btn-sm_comment" id="edit_comment" data-id="'.$request->comment_id.'" data-task_id="'.$request->task_id.'" data-add="Update" data-comment="'.$request->comments.'">
                                 <i class="fa fa-pencil" ></i>
                                 </button>&nbsp;&nbsp;
     <button href="#" class=" delete_data btn btn-danger waves-effect waves-light btn-group-sm btn-sm_comment "  data-id="'.$request->comment_id.'">
     <i class="fa fa-trash" ></i></button>
     </span></div>
                                 
                                 <p class="text-muted">'.$request->comments.'
                                     </p>
                              </div>
                           </div>';
       
            $status = 'true';
            $message = 'Comments Updated Successfully.';
            $data = $html;
       }
       
        return response()->json(compact('status','message','data'));
    }
    

    function taskTracking(Request $request){
        $session = session('user_data');
        $user_id = $session->id;
       
        $task = TaskModel::select('assign_to','assign_to_qa')->where('id',$request->task_id)->first();
        $assign = json_decode($task['assign_to']);
        $assign_qa = json_decode($task['assign_to_qa']);
       
        if(($request->status != 4 && !in_array($user_id,$assign))){
             $data = "";
             $status = 'false';
             $message = 'You can not tracking task';  
        }else if(($request->status == 4 && in_array($user_id,$assign))){
             $data = "";
             $status = 'false';
             $message = 'You can not tracking task';  
        }else{
        if($request->type == 0){
             $checkin = Checkin::select('*')->where('employee_id',$user_id)->where('date','=',date('Y-m-d'))->where('time_out','=',NULL)->first();
            
            if(empty($checkin) && $request->project_id != 47){
                 $data = "";
                 $status = 'false';
                 $message = 'Please checkin first';  
                 return response()->json(compact('status','message','data'));
            }
            
            $time = date('H:i:s');
            $date = date('Y-m-d');
            
            $check_current_project = TaskTrackingModel::select('task_tracker.*','p.id as project_id')->leftjoin('tasks as t','task_tracker.task_id','=','t.id')
            ->leftjoin('project as p','p.id','=','t.project_id')
            ->where([
                    ['task_tracker.user_id','=',$session->id],
                    ['p.id','=',$request->project_id],
                   // ['task_id','=',$request->task_id],
                    ['end_time','=',NULL]
                    ])->orderBy('task_tracker.id','DESC')->first();
            if(!empty($check_current_project)){
                 $data = "";
                 $status = 'false';
                 $message = 'Your timer start in same project.';  
                  return response()->json(compact('status','message','data'));
            } 
            
            $check = TaskTrackingModel::select('task_tracker.*','p.id as project_id')->leftjoin('tasks as t','task_tracker.task_id','=','t.id')
            ->leftjoin('project as p','p.id','=','t.project_id')
            ->where([
                    ['task_tracker.user_id','=',$session->id],
                    ['p.id','!=',$request->project_id],
                   // ['task_id','=',$request->task_id],
                    ['end_time','=',NULL]
                    ])->orderBy('task_tracker.id','DESC')->first();
                    
                    
                   
            if(!empty($check)){
                 $data = "";
                 $status = 'false';
                 $message = 'Your timer start in another project.';  
                  return response()->json(compact('status','message','data'));
            }      
            $task_tracking = new TaskTrackingModel;
            $task_tracking->user_id = $user_id;
            $task_tracking->task_id = $request->task_id;
            $task_tracking->start_date =  $date;
            $task_tracking->start_time = $time;
            $task_tracking->save();
            $data['start_time'] = date('m/d/Y') .' ' . $time;
            $t_id = $task_tracking->id;
             $status = 'true';
             $message = 'Tracker Start Successfully';
             $data['html'] ='<tr>
                              <td>#</td>
                              <td>'.dateFormat($date) . ' ' . $time.'</td>
                              <td class="end_time_'.$t_id .'"></td>
                              <td class="user-box"><img class="media-object img-radius m-r-20 tracking-img" src="'.getUserImage().'" alt="'.$session->name.'"></td>
                              <td class="text-right duration_'.$t_id .'"></td>
                           </tr>';
        }else{
            $time = date('H:i:s');
            $date = date('Y-m-d');
            $check = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$session->id],
                    ['task_id','=',$request->task_id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','DESC')->first();
            
            if(!empty($check)){
                $updateBreak = TaskTrackingModel::where([
                     ['user_id','=',$session->id],
                     ['task_id','=',$request->task_id],
                     ['end_time','=',NULL]

                ])->update(['end_time'=>$time,'end_date'=>$date]);
             }
              $status = 'true';
              $message = 'Tracker Stop Successfully';

              $data['id'] = $check->id;
              $data['end_time'] = dateFormat($date) . ' ' . $time;
              $duration =breakDuration($check->start_time,$time);
              $data['duration'] = $duration['b'];
              
        }
        
       }
        return response()->json(compact('status','message','data'));
    }
    function GetProjectMemberList(Request $request){
             $data['project_list']= ProjectModel::select('project_manager_id','project_report_id','employee_id')
            ->where('id',$request->project_id)->orderBy('id','desc')->first();
            $member =  $report = $manager = [];
            $report = [];
            //$member = getEmployeeListData($data['project_list']['employee_id']);
            $member = json_decode($data['project_list']['employee_id']);
           
            $report_data = EmployeeDetailById($data['project_list']['project_report_id']);
            //p($report_data);
            if(empty( $report_data)){
                 $report[0]= '';
            }else{
                 $report[0]= $report_data->id;
            }
            
            // $report[0]['full_name']=$report_data->full_name;
            // $report[0]['image']=$report_data->full_name;
           
            $final_array = array_merge($member,$report);
            
            $manager_data = EmployeeDetailById($data['project_list']['project_manager_id']);
             if(empty( $report_data)){
                 $manager[0]= '';
            }else{
                $manager[0] = $manager_data->id;
            }
            
            // $manager[0]['full_name']=$manager_data->full_name;
            // $manager[0]['image']=$manager_data->full_name;
            
            $status = 'true';
            $message = 'Data fetch';
            $data = array_merge($final_array,$manager);
            
            $html = '<option></option>';
             $data = array_unique($data);
             $data = getEmployeeListData(json_encode($data));
            
            
            foreach($data as $row){
               $html .= '<option value="'.$row['id'].'">'.$row['full_name'].'</option>'; 
            }
            return response()->json(compact('status','message','html'));
    }
    
     public function task_board()
    {
        $data['title']="Task Board";
        $data['sidebar']="Task Board";
        
       
        $data['ideal_settings'] = array();
        $data['in_process'] = array();
        $data['in_testing'] = array();
        $data['ready_deploy'] = array();
       
        $date = date('Y-m-d');
       
             
        $ideal_settings = Checkin::select('employee.id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"), 'employee.image')
                    ->leftjoin('employee','employee.id','=','checkin.employee_id')
                    //->leftjoin('task_tracker','task_tracker.user_id','=','e.id')
                    ->where([
                        ['date','=',date('Y-m-d')],
                        ['type','=',1]
                    ])
                    ->orderBy('employee.id','DESC')
                    ->get();
               
        foreach($ideal_settings as $val){
            $tracking = TaskTrackingModel::where('start_date',date('Y-m-d'))->where('end_date','=',NULL)->where('user_id',$val->id)->orderBy('id','DESC')->first();
            
                if(empty($tracking)){
                     $list['id'] = $val->id;
                     $list['employee_id'] = $val->id;
                     $list['full_name'] = $val->full_name;
                     $list['image'] = $val->image;
                     $data['ideal_settings'][] = $list;
                }
        }            
        
        $in_process = TaskTrackingModel::select('task_tracker.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.image','p.project_name','t.task_project_id')
             ->leftjoin('tasks as t','task_tracker.task_id','=','t.id')
             ->leftjoin('project as p','p.id','=','t.project_id')
             ->leftjoin('employee as e','task_tracker.user_id','=','e.id')
             ->where([
                 ['t.status','=',2],
                 ['task_tracker.start_date','=',date('Y-m-d')],
                 ['task_tracker.end_time','=',NULL]
                 ])
             ->orderBy('task_tracker.id','desc')->get();
        $data['in_process'] = $in_process;
        
        $in_testing = TaskTrackingModel::select('task_tracker.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.image','p.project_name','t.task_project_id')
             ->leftjoin('tasks as t','task_tracker.task_id','=','t.id')
             ->leftjoin('project as p','p.id','=','t.project_id')
             ->leftjoin('employee as e','task_tracker.user_id','=','e.id')
             ->where([
                 ['t.status','=',4],
                 ['task_tracker.start_date','=',date('Y-m-d')],
                 ['task_tracker.end_time','=',NULL]
                 ])
             ->orderBy('task_tracker.id','desc')->get();
               
        $data['in_testing'] = $in_testing;
        
        $ready_deploy = TaskModel::select('tasks.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.image','p.project_name','tasks.task_project_id')
             ->leftjoin('project as p','p.id','=','tasks.project_id')
             ->leftjoin('employee as e','tasks.assign_to_qa','=','e.id')
             ->where([
                 ['tasks.status','=',5],
                 ['tasks.updated_at','>=',date('Y-m-d 00:00:00')],
                 ['tasks.updated_at','<=',date('Y-m-d 23:59:59')],
                 ])
             ->orderBy('tasks.id','desc')->get();
               
        $data['ready_deploy'] = $ready_deploy;
        
       
        
       /* foreach($details as $val) {

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
                            
       */
       

        return view('admin.task.task_board',compact('data'));

    }
    
    function updateQA()
    {
        $a = TaskModel::select('id','assign_to_qa')->get();
       
        if(!empty($a)){                   
            foreach($a as $k=>$row){
                $arr = array($row->assign_to_qa);

                $assign_to_qa = json_encode($arr);
    
                $update = DB::table('tasks')->where('assign_to_qa',$row->assign_to_qa)->update([
                'assign_to_qa'=>$assign_to_qa,
                ]);
            }   
           
        } 
          echo json_encode(['status'=>'true','data'=>$a]);die;
    }
   
}


