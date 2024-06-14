<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\ProjectModel;
use App\Models\TestModel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $sess = session('admin');
        p(324);
        if(empty($sess))
        {
            return redirect('login');
        }
        $data['title'] = "Dashboard";
        $data['sub_title'] = "";
        $data['sidebar'] = "Dashboard";
        $data = DB::table('project')->count();

        $client = DB::table('clients')->count();

        $employee = DB::table('active_employee')->count();

        $ongoing = DB::table('project')
        // ->where('start_date','<',now())
        ->where('status','!=',50)
        // ->orWhere('status','=',20)
        ->where('jobstatus','!=','completed')
        ->count();

        $completed = DB::table('project')
        // ->where('status','=',50)
        // ->orWhere('status','=',20)
        ->where('jobstatus','=','Completed')
        ->count();

        $upcoming = DB::table('project')
        ->where("start_date",'>',now())
        ->count();        

        $progressbar = ProjectModel::where('status','=',50)->get();
        $data1 =  ProjectModel :: select('id','image','project_name','member','status','start_date','jobstatus')->get();

        return view('admin.dashboard',compact('data','client','employee','data1','ongoing','upcoming','completed','progressbar'));
    }
    public function test1(Request $request)
    {
        $a = $request->name;
        foreach($a as $user)
        {
            $data = new TestModel;
            $data->name = $user;
            $data->save();
        }
    }
   public function reports()
    {
        $title = "Reports";
        $p = DB::table('project')->count();

        $client = DB::table('clients')->count();

        $employee = DB::table('employee')->count();

        return view('layouts.reports',compact('title','p','client','employee'));
    }
    public function project()
    {
        $title = "Project Report";
        $project = DB::table('project')->get();
        return view('layouts.project',compact('title','project'));
    }
    public function employee()
    {
        $title = "Employee Report";
        $employee = DB::table('employee')->get();
        return view('layouts.employee',compact('title','employee'));
    }
    public function client()
    {
        $title = "Client Report";
        $client = DB::table('clients')->get();
        return view('layouts.client',compact('title','client'));
    }
}

