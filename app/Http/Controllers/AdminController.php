<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ProjectModel;
use App\Models\EmployeeModel;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemInfoModel;
use App\Models\OtherExpenseModel;

class AdminController extends Controller
{

   /* public function __construct()
    {  
         $this->middleware('auth');
    }*/

    public function dashboard()
    {

        $sess = Session('user_data');
        
        if(empty($sess))
        {
            return redirect('login');
        }
        $data['title'] = "Dashboard";
        $data['sub_title'] = "";
        $data['sidebar'] = "Dashboard";
        $project = GetTableRowCount('project',['status'=>1]);

        $client = DB::table('clients')->count();

        $active_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',1)->count();
        $deactive_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',0)->count();
        $present_employee = DB::table('checkin')->where([
                            ['date','=',date('Y-m-d')],
                            ['type','=',1],
                        ])->count();
        
       
        $department =  DB::table('department')->where('status','=',1)->count() ;
        $designation =  DB::table('designation')->where('status','=',1)->count();
        $systeminfo = SystemInfoModel::getsum();
        $curr_year = SystemInfoModel::select('purchase_date')->whereYear('purchase_date', date('Y'))->sum('price');
        $laptop = SystemInfoModel::select('price','platform')->where('platform','=','Window')->orWhere('platform','=','Mac')->sum('price');
        $mobile = SystemInfoModel::select('price','platform')->where('platform','=','IOS')->orWhere('platform','=','Android')->sum('price');
      
        
        $data['employee_birthday'] = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'image','dob')->whereRaw('MONTH(dob) = MONTH(NOW())')->orderByRaw('DAYOFYEAR(dob)')->where('status','=',1)->get();
        $data['employee_joining'] = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'image','join_date')->whereRaw('MONTH(join_date) = MONTH(NOW())')->whereRaw('YEAR(join_date) < YEAR(NOW())')->where('status','=',1)->orderByRaw('DAYOFYEAR(join_date)')->get();
        
        $data['employee_upcomming_birthday'] = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'image','dob')->whereRaw('MONTH(dob) = MONTH(NOW()) + 1')->orderByRaw('DAYOFYEAR(dob)')->where('status','=',1)->get();
        $data['employee_upcomming_joining'] = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'image','join_date')->whereRaw('MONTH(join_date) = MONTH(NOW()) + 1')->whereRaw('YEAR(join_date) < YEAR(NOW())')->where('status','=',1)->orderByRaw('DAYOFYEAR(join_date)')->get();
        
        $data['project'] = $project;
        $data['client'] = $client;
        $data['active_employee'] = $active_employee;
        $data['deactive_employee'] = $deactive_employee;
        $data['department'] = $department;
        $data['designation'] = $designation;
                $data['systeminfo'] = $systeminfo;
        $data['curr_year'] = $curr_year;
        $data['laptop'] = $laptop;
        $data['mobile'] = $mobile;
        
        $data['present_employee'] = $present_employee;
        $data['progress_bar'] = number_format($present_employee/$active_employee *100,2);
        return view('admin.dashboard',compact('data'));
        
    }

     public function analytics()
    {
        $data['title'] = "Analytics";
        $data['sub_title'] = "";
        $data['sidebar'] = "Analytics";

        $project = GetTableRowCount('project',['status'=>1]);

        $client = DB::table('clients')->count();

        $active_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',1)->count();
        $deactive_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',0)->count();
        $present_employee = DB::table('checkin')->where([
                            ['date','=',date('Y-m-d')],
                            ['type','=',1],
                        ])->count();
        
        
        $android = SystemInfoModel::select('emp_id','platform')->where('platform','=','android')->where('status','=',1)->count();
        $ios = SystemInfoModel::select('emp_id','platform')->where('platform','=','mac')->where('status','=',1)->count();
        $department =  DB::table('department')->where('status','=',1)->count() ;
        $designation =  DB::table('designation')->where('status','=',1)->count();
        
        $fiscalYr = calculateFiscalYearForDate(date('m'));
        $sFiscalYr = explode(':',$fiscalYr);
        
        $systeminfo = SystemInfoModel::getsum();
        $curr_year = SystemInfoModel::whereDate('purchase_date','>=',$sFiscalYr[0])->whereDate('purchase_date','<=',$sFiscalYr[1])->sum('price');
        $laptop = SystemInfoModel::where('platform','=','Window')->orWhere('platform','=','Mac')->sum('price');
        $mobile = SystemInfoModel::where('platform','=','IOS')->orWhere('platform','=','Android')->sum('price');
        
        
        $annual_expense = OtherExpenseModel::whereDate('date','>=',$sFiscalYr[0])->whereDate('date','<=',$sFiscalYr[1])->sum('total_amount');
        $monthly_expense = OtherExpenseModel::whereMonth('date',date('m'))->whereYear('date',date('Y'))->sum('total_amount');
        
        $data['project'] = $project;
        $data['client'] = $client;
        $data['active_employee'] = $active_employee;
        $data['deactive_employee'] = $deactive_employee;
        $data['android'] = $android;
        $data['ios'] = $ios;
        $data['department'] = $department;
        $data['designation'] = $designation;
        $data['systeminfo'] = $systeminfo;
        $data['curr_year'] = $curr_year;
        $data['laptop'] = $laptop;
        $data['mobile'] = $mobile;
        
       
        $data['present_employee'] = $present_employee;
        
        $data['web'] = DB::table('checkin')->where('device_type','=',2)->where('date','=',date('Y-m-d'))->count();
        $data['mobile_users'] = DB::table('checkin')->where('device_type','=',1)->where('date','=',date('Y-m-d'))->count();
        $data['annual_expense'] = $annual_expense;
        $data['monthly_expense'] = $monthly_expense;
         $data['progress_bar'] = number_format($present_employee/$active_employee *100,2);
        return view('admin.analytics',compact('data'));
    }
       public function employee_analytics()
    {
        $data['title'] = "Analytics";
        $data['sub_title'] = "";
        $data['sidebar'] = "Analytics";

        $project = GetTableRowCount('project',['status'=>1]);

        $client = DB::table('clients')->count();

        $active_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',1)->count();
        $deactive_employee = DB::table('employee')->where('user_type','!=','admin')->where('status',0)->count();
        $present_employee = DB::table('checkin')->where([
                            ['date','=',date('Y-m-d')],
                            ['type','=',1],
                        ])->count();
        
        
        $android = SystemInfoModel::select('emp_id','platform')->where('platform','=','android')->where('status','=',1)->count();
        $ios = SystemInfoModel::select('emp_id','platform')->where('platform','=','mac')->where('status','=',1)->count();
        $department =  DB::table('department')->where('status','=',1)->count() ;
        $designation =  DB::table('designation')->where('status','=',1)->count();
        $systeminfo = SystemInfoModel::getsum();
        $curr_year = SystemInfoModel::select('purchase_date')->whereYear('purchase_date', date('Y'))->sum('price');
        $laptop = SystemInfoModel::select('price','platform')->where('platform','=','Window')->orWhere('platform','=','Mac')->sum('price');
        $mobile = SystemInfoModel::select('price','platform')->where('platform','=','IOS')->orWhere('platform','=','Android')->sum('price');
       
        $data['project'] = $project;
        $data['client'] = $client;
        $data['active_employee'] = $active_employee;
        $data['deactive_employee'] = $deactive_employee;
        $data['android'] = $android;
        $data['ios'] = $ios;
        $data['department'] = $department;
        $data['designation'] = $designation;
        $data['systeminfo'] = $systeminfo;
        $data['curr_year'] = $curr_year;
        $data['laptop'] = $laptop;
        $data['mobile'] = $mobile;
        
        
        $data['present_employee'] = $present_employee;
         $data['progress_bar'] = number_format($present_employee/$active_employee *100,2);
        $data['web'] = DB::table('checkin')->where('device_type','=',2)->where('date','=',date('Y-m-d'))->count();
        $data['mobile_users'] = DB::table('checkin')->where('device_type','=',1)->where('date','=',date('Y-m-d'))->count();
        return view('admin.employee_analytics',compact('data'));
    }
}
