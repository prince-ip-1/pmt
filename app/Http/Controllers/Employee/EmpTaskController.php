<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\TaskModel;
use App\Http\Requests;
use DataTables;
use Session;
class EmpTaskController extends Controller
{
    public function viewtask1()
    {
        $title = "TaskList";
          $data = TaskModel::select('task.*','employee.first_name')->leftjoin('employee','task.task_assign_by','=','employee.id')->get();
        $p_id = DB::table('project')
        ->select('id','project_name')->get();

         $data1 = DB::table('task')->get();
        
        $pr_id = DB::table('project')
        ->select('id','project_name')->get();

        $emp_id = DB::table('employee')
        ->select('id','first_name')->get();

         $em_id = DB::table('employee')
        ->select('id','first_name','designation')
        ->where("designation","=",70)
        ->get();

        $assign_by = DB::table('employee')
        ->select('id','first_name','designation')
        ->where("designation","=",80)
        ->get();

        $employee  = DB::table('employee')
        ->select('id','first_name')->get();
     
        return View('employee.emp-tasklist',compact('title','data','p_id','data1','pr_id','emp_id','em_id','employee','assign_by'));
    }

    // public function getdata($id)
    // {
    //     $title = "Update Task";
    //     $data = DB::select('select * from task where id = ?',[$id]);

    //     return view('task.edit-task',compact('data','title'));
    // }
    //  public function updatetask(Request $request,$id)
    
    // {
    //     $title = "Update Task";
    //     $task_name = $request->task_name;
    //     $task_description = $request->task_description;
    //     $task_hours = $request->task_hours;
    //     $task_assign_by = $request->task_assign_by;
    //     $start_date = $request->start_date;
    //     $due_date = $request->due_date;
    //     $duration = $request->duration;
    //     $priority = $request->priority;
    //     $status = $request->status;
    // DB::update('update task set task_name=?,task_description=?,task_hours=?,task_assign_by=?,start_date=?,due_date=?,duration=?,priority=?,status=? where id=?',[$task_name,$task_description,$task_hours,$task_assign_by,$start_date,$due_date,$duration,$priority,$status,$id]);
    //    // return view('edit-task',compact('title','data'));
    // return redirect('taskboard');
    // }
    // public function addtask(Request $request)
    // {
    //     $data = new TaskModel;
        
    //     $data->task_no = $request->taskno;
    //     $data->project_id =$request->project_id;
    //     $data->task_name = $request->tname;
    //     $data->task_description = $request->desc;
    //     $data->task_hours = $request->hrs;
    //     $data->task_assign_by = $request->taskassignby;
    //     $data->status = $request->status;
    //     $data->priority = $request->priority;
    //     $data->start_date = $request->sdate;
    //     $data->due_date = $request->ddate;
    //     $data->duration = $request->duration;
    //     $data->assign_by_qa = $request->assignbyqa;
    //     $data->technology = $request->tech;
    //     $data->emp_id = $request->emp_id;
    //     $data->save();
    //     return Redirect('taskboard');
    // }
    // public function delete($id)
    // {
    //     DB::delete('delete from task where id = ?',[$id]);
    //     return redirect('taskboard');
    // }

    public function listtaskdata1()
    {
         $emp = Session::get('employee');
        $employee = TaskModel::select('task.*','employee.first_name','project.project_name')->join('employee','task.task_assign_by','=','employee.id')->join('project','task.project_id','=','project.id')->where('task.emp_id',$emp->id)->get();
        return Datatables::of($employee)
   
        ->addIndexColumn()
        ->editColumn('technology', function ($employee) {
              if($employee->technology == "10")
              {
                   return 'PHP';
              }
              elseif($employee->technology == "20")
              {
                   return 'IOS';
              }
               elseif($employee->technology == "30")
              {
                   return 'Android';
              }
               elseif($employee->technology == "40")
              {
                   return 'Flutter';
              }
              else
              {
                return "No Data";
              }
       })
         ->editColumn('status', function ($employee) {
             if($employee->status == "10")
              {
                   return 'On Hold';
              }
              elseif($employee->status == "20")
              {
                   return 'In Progress';
              }
               elseif($employee->status == "30")
              {
                   return 'In Completed';
              }
               elseif($employee->status == "50")
              {
                   return 'Completed';
              }
              else
              {
                return "NO Data";
              }
         })
          ->editColumn('priority', function ($employee) {
             if($employee->priority == "10")
              {
                   return 'High';
              }
              elseif($employee->priority == "20")
              {
                   return 'Medium';
              }
               elseif($employee->priority == "30")
              {
                   return 'Low';
              }
              else
              {
                return "NO Data";
              }
         })
        ->toJson();

    }
    public function empsearchtask($pid,$status)
    {
        $title = "TaskList";
        $data = TaskModel::select('task.id','task.project_id','task.task_assign_by','task.status','task.priority','task.task_no','task.task_name','task.task_description','task.start_date','task.due_date','task.technology','task.duration','employee.first_name')->leftjoin('employee','task.task_assign_by','=','employee.id')->where('task.status',$status)->where('task.project_id',$pid)->get();
       
         return view('employee.emp-search-task',compact('data','title'));
    }
}
