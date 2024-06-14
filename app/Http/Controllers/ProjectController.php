<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\ProjectModel;
use App\Models\ProjectMilestoneModel;
use Carbon\Carbon;
use App\Models\ClientModel;
use App\Models\TaskModel;
use App\Models\AttachmentModel;
use Session;

class ProjectController extends Controller
{
    
    public function index()
    {
       /* $sess = session('admin');
        if(empty($sess))
        {
            return redirect('login');
        }*/
        $data = [];
        $data['title'] = 'Projects List';
        $data['sub_title'] = "";
        $data['sidebar'] = "Projects";
        $userdata = Session('user_data');
        $user_id = $userdata->id;
        $userdata = EmployeeDetailById($user_id);
        $permission = $userdata->permissions;
          if(getDepartment() == 1 || (isset($permission[11]->view) && $permission[11]->view == 1)){
                 $data['project_list'] = ProjectModel::select('project.*','employee.first_name','employee.last_name')
                ->leftjoin('employee','employee.id','=','project.project_manager_id')
                ->orderby('id','desc')
                ->get();
        }else{ 
           
            // $users = ProjectModel::select('id')->whereIn('employee_id', array(16))->get();
            // p($users);
             $data['project_list'] = ProjectModel::select('project.*','employee.first_name','employee.last_name')
            ->leftjoin('employee','employee.id','=','project.project_manager_id')
            ->where('employee_id','LIKE','%'.$user_id.'%')
            ->orderby('id','desc')
            ->get();
           
        }
        return view('admin.project.project_list',compact('data'));
    }
     public function viewprojecttask(Request $request)
    {
        $session = Session::put('session_project_id',$request->project_id);
        $status = 'true';
        $message = '';
        return response()->json(compact('status','message'));
    }
    public function searchProject(Request $request)
    {
        $data = ProjectModel::select('*')->where('project_name',$request->projectId)->get();
    }
    public function add_project(){
        $data['title']='Add Project';
        $data['sub_title']= 'Projects';
        $data['sidebar'] = "Project";
        $data['sub_title_url']= 'admin/projects_list';
        $data['client_list'] = ClientModel::select('id',DB::raw("CONCAT(firstname,' ',lastname) as full_name"))->get();
        $data['employee_list'] = EmployeeList();
       
        return view('admin.project.add_project',compact('data'));
    }
     public function edit_project($id){
        
        $project = ProjectModel::find($id);
        $data['title']='Edit Project';
        $data['sub_title']= 'Projects';
        $data['sidebar'] = "Project";
        $data['sub_title_url']= 'admin/projects_list';
        $data['client_list'] = ClientModel::select('id',DB::raw("CONCAT(firstname,' ',lastname) as full_name"))->get();
        $data['employee_list'] = EmployeeList();
        $data['project_details'] = $project;
        $data['milestone'] = DB::select('select * from projectmilestone where project_id = ?',[$id]);
        
        return view('admin.project.edit_project',compact('data'));
    }
    
    public function edit_project_description(Request $request)
    {
        $a = ProjectModel::find($request->project_id);
        if(!empty($a)){
            $a->project_description = $request->project_description;
            $a->save();
        }

        $res = [
            'status' => 'true',
            'message' => 'Project Description Updated successfully.'
        ];

        return $res;
    }
    public function view_project_details($id)
    {
        $data['title']='View Project Details';
        $data['sub_title']= 'Projects';
        $data['sidebar'] = "Project";
        $data['sub_title_url']= 'admin/projects_list';

         $data['project_details'] = ProjectModel::select('project.*','projectmilestone.project_id',DB::raw("CONCAT(clients.firstname,' ',clients.lastname) as client_name"),'employee.first_name','employee.last_name','employee.image','attachments.attachment',DB::raw("CONCAT(e.first_name,' ',e.last_name) as creator_name"),DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as reporter_name"))
        ->leftjoin('clients','clients.id','=','project.client_id')
        ->leftjoin('employee','employee.id','=','project.employee_id')
        ->leftjoin('employee as e','e.id','=','project.project_manager_id')
        ->leftjoin('employee as e1','e1.id','=','project.project_report_id')
        ->leftjoin('attachments','attachments.project_id','=','project.id')
        ->leftjoin('projectmilestone','projectmilestone.project_id','=','project.id')
        ->where('project.id','=',$id)
        ->first();
        
        $data['attachments'] = AttachmentModel::select('*')->where('project_id',$id)->get();
   
        $data['completed_task'] = TaskModel::select('project_id','status')->where('status',3)->where('project_id',[$id])->count();
        $data['inprogress_task'] = TaskModel::select('project_id','status')->where('status',2)->where('project_id',[$id])->count();
        $data['pending_task'] = TaskModel::select('project_id','status')->where('status',1)->where('project_id',[$id])->count();
        $attachment_details = ProjectModel::select('attachments.id','attachments.attachment')->leftjoin('attachments','attachments.project_id','=','project.id')
        ->where('project.id','=',$id)
        ->get();
        
        $data['project_list'] = ProjectModel::select('project.id')->where('project.id',$id)->first();
       
        $attachments = [];
        foreach($attachment_details as $row){

                $attachments['id'] = $row->id;
                $attachments['attachment'] = $row->attachment;
                $attachments2[] =  $attachments;
        }
        $data['project_details']->attachments = $attachments2;
        
        $employee_id = json_decode($data['project_details']->employee_id, true);
        $employee_list = EmployeeList();
        $team_members = [];
        foreach($employee_list as $row){
            if(in_array($row->id,$employee_id)){

                $team_members['id'] = $row->id;
                $team_members['full_name'] = $row->full_name;
                $team_members['image'] = $row->image;
                $team_members2[] =  $team_members;
            }
        }
        $data['project_details']->team_members = $team_members2;
        $data['milestone'] = DB::select('select * from projectmilestone where project_id = ?',[$id]);
       
        return view('admin.project.view_project_details',compact('data'));
    }
    
     public function post_project(Request $request)
    {
        $userdata = Session('user_data');
        $user_id = $userdata->id;
        $imageitem="";

       
        if($request->file('project_logo') != '')
        {
          $image = $request->file('project_logo');
          $imageitem = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/uploads/project_logo');
          $image->move($destinationPath, $imageitem);
        }
        else
        {
            $imageitem = isset($request->old_project_logo)?($request->old_project_logo):"";
        }
       
         if(!empty($request->project_id)){
            
             $data = ProjectModel::find($request->project_id);
             
             $status = 'true';
             $message = 'Data updated successfully.';
         }else{
            $data = new ProjectModel;
            $status = 'true';
            $message = 'Data addedd successfully.';
            $data->user_id = $user_id;
         }
        
        
        $data->project_name = $request->project_name;
        $data->project_description = $request->project_description;
        $data->client_id = $request->client_id;
        $data->start_date =$request->start_date;
        $data->end_date = $request->end_date;
        $data->project_status = $request->project_status;
        $data->color = $request->color;
        $data->project_manager_id = $request->project_manager_id;
        $data->project_report_id = $request->project_report_id;
        $data->technology_id = json_encode($request->technology_id);
        $data->employee_id = json_encode($request->employee_id);
        $data->project_logo = $imageitem;
        $data->project_type = $request->project_type;
        $data->hour_rate = $request->hour_rate;
        $data->project_amount = $request->project_amount;
        $data->project_priority = $request->project_priority;
        $data->save();
        
        //p($request->milestone);
        if(!empty($request->milestone)){  
            foreach($request->milestone as $row){
                if(!empty($row['title'])){
                    if(isset($row['m_id']) && !empty($row['m_id'])){
                        $projectmilestone = ProjectMilestoneModel::find($row['m_id']);
                    
                    }else{
                        $projectmilestone = new ProjectMilestoneModel;
                    }
                    
                    $projectmilestone->project_id = $data->id;
                    $projectmilestone->title = $row['title'];
                    $projectmilestone->start_date = $row['sdate'];
                    $projectmilestone->end_date = $row['edate'];
                    $projectmilestone->status = $row['status'];
                    $projectmilestone->notify = isset($row['notify'])?$row['notify']:"0";
                    $projectmilestone->save();
                }
          }
      
    }
       
        return response()->json(compact('status','message'));
    }
   
    public function project_details($id)
    {
        return view('project.project-details',compact('data'));
    }
   
    public function add_attachment(Request $request)
    {
        $imageitem = "";
        
        if($request->file('attachment'))
        {
             $image = $request->file('attachment');
             $imageitem = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/attachment');
             $image->move($destinationPath,$imageitem);
        }
        $attachment = new AttachmentModel;
        $attachment->project_id = $request->project_id;
        $attachment->attachment = $imageitem;
        $attachment->save();
    
         $html = '';
         $html .='<p class="attachment_'.$attachment['id'].'"><i class="fa fa-paperclip" style="margin-right:1px;"></i>'.$attachment->attachment.
        '<a href="'.getImagePath($attachment['attachment'],'attachment').'" target="_blank" > <button type="button"  class="f-right btn btn-warning waves-effect waves-light btn-group-sm btn-sm" style="margin-left: 5px;"><span class="icofont icofont-eye"></span></button></a>'.
        '<button class="f-right delete_data btn btn-danger waves-effect waves-light btn-group-sm btn-sm" data-id="'.$attachment['id'].'"><span class="icofont icofont-trash"></span></button>'.
        '</p>';
        
        $status = 'true';
        $message = 'Attachment Uploaded Successfully.';
        return response()->json(compact('status','message','html'));
    }
    public function getprojectdescription(Request $request)
    {       $type=$request->type;
             $data_list = DB::table('project')->select('project_description')->where('id',$request->id)->orderBy('id','desc')->get();  
            if($type == 2){
           
             $html = view('admin.project._project_description',compact('data_list'))->render();
            }
            
         
            $status = 'true';
            $message = 'Data view Successfully.';
            return response()->json(compact('status','message','html'));
    }
    public function delete_milestone(Request $request){
        $id = $request->id;
        $com = DB::table('projectmilestone')->where('id',$id)->delete();
         if($com){
            $data = $com;
            $status = 'true';
            $message = 'Data Deleted successfully.';
        }else{
            $data = "";
              $status = 'false';
             $message = 'Data not found.';
        }
        return Response()->json(compact('com','status','message'));
    }
}

