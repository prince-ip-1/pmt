<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\ProjectModel;
use App\Models\ProjectMilestoneModel;
use Carbon\Carbon;
use App\Models\ClientModel;
use App\Models\TaskModel;
use Session;
class EmpProjectController extends Controller
{
     public function ListProject()
    {
        $emp = Session::get('employee');
        $title="Project List";
        $data = DB::table('project')->where('member',$emp->id)->get();

        $c_id = DB::table('clients')
        ->select('id','firstname')->get();

        $e_id  = DB::table('employee')->select('id','first_name')->get();
         $progressbar = ProjectModel::where('status','=',50)->get();
        return view('employee.emp-project',compact('data','title','c_id','e_id','progressbar'));
    }

     public function empprojectdetails($id)
    {
        $title = "Project Details";
        $data = DB::select('select project.*,clients.firstname from project left join clients on project.client_id = clients.id where project.id = ?',[$id]);
  
      $employee = explode(',',$data[0]->member);
         $employee_list = [];
         foreach($employee as $row){
            $data1 = DB::select('select id,first_name,last_name,image from employee where id = ?',[$row]);
            $employee_list[] = $data1[0];
         }
        $milestone = DB::select('select * from projectmilestone where projectid = ?',[$id]);
        $upcoming_task_count = TaskModel::select('id','project_id','status')->where('status',"30")->where('project_id',[$id])->count();
        
        // $task_count = TaskModel::select('id','project_id','status')->whereIn('status',["10","20"])->where('project_id',[$id])->count();
         $task_count = TaskModel::select('id','project_id','status')->where('status',"20")->where('project_id',[$id])->count();

         $incomplete_task_count = TaskModel::select('id','project_id','status')->where('status',"40")->where('project_id',[$id])->count();
        return view('employee.emp-projectdetails',compact('title','data','employee_list','milestone','task_count','upcoming_task_count','incomplete_task_count'));
    }
     public function status(Request $request)
    {
        $data = ProjectModel :: find($request->id);
        return $data;
    }  
    public function addstatus(Request $request)
    {
        // print_r($request->jobstatus);die;
        $data1 = ProjectModel :: find($request->project_id);
        $data1->jobstatus = $request->jobstatus;
        $data1->save();
    }
    public function editmilestone(Request $request)
    {
         $employee = ProjectMilestoneModel::find($request->id);
        return $employee;
    }
     public function updatemilestonestatus(Request $request)
    {
        $data2 = ProjectMilestoneModel :: find($request->id);
        $data2->status = $request->status;
        $data2->save();
    }
    
}
