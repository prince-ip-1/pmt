<?php
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Models\AttendanceModel;
use App\Models\AttendanceNewModel;
use Carbon\Carbon;
use Session;
class EmpAttendanceController extends Controller
{
    public function emplistattendance()
    {
        $usertype = Session::get('usertype');
        $emp = Session::get('employee');

        $employee = AttendanceNewModel::select('attendance_new.*','employee.first_name','employee.image')->leftjoin('employee','attendance_new.emp_id','=','employee.id')->where('attendance_new.emp_id',$emp->id)->groupBy('attendance_new.emp_id')->get();

        foreach($employee as $k=>$row){
           $days =  $this->attendance_count($row->emp_id);
           $employee[$k]->total_days= $days['total'];
           $employee[$k]->total_present= $days['present'];
           $employee[$k]->total_absent= $days['absent'];
        }
          return Datatables::of($employee)
          ->addIndexColumn()
          ->addColumn('action', function($employee)
          {
            $html='<a href="'.url('empattendancedetails/'.$employee->emp_id).'" class="btn btn-xs btn-secondary">View</a>'; 
            return $html;
          }) 
           ->addColumn('image',function($employee)
             {
                $url= asset('/upload/image/'.$employee->image);
                 return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
             }) 
           
           ->rawColumns(['image','action'])
          ->toJson();
    }
     public function attendance_count($id)
    {

        // $id = $_GET['id'];
        $days = [];
        for($i = 1; $i <= 12; $i++) 
        {
            $list['day'] = cal_days_in_month(CAL_GREGORIAN, $i, 2022);
            $list['month'] = date('F', mktime(0,0,0,$i, 1, date('Y')));
            $list['present'] = DB::table('attendance_new')
            ->select(DB::raw('COUNT(*) as value'))
            ->whereMonth('present_date', $i)->where('emp_id',$id)
            ->count();
 
            $list['absent'] = $list['day']-$list['present'];
            $days[] = $list;
            }
            $total_days['total'] = $total_days['present'] = $total_days['absent'] = 0;
            foreach($days as $row){
                $total_days['total'] += $row['day'];
                $total_days['present'] += $row['present'];
                $total_days['absent'] += $row['absent'];
            }
          
         return $total_days;
    }
    public function attendancelist1()
    {
        $title="Attendance List";
        return view('employee.emp-attendancelist',compact('title'));
    }
    public function attendance_details($id)
    {
        // $id = $_GET['id'];
        $title = "Attendance Details";
        $days = [];
        for($i = 1; $i <= 12; $i++) 
        {
            $list['day'] = cal_days_in_month(CAL_GREGORIAN, $i, 2022);
            $list['month'] = date('F', mktime(0,0,0,$i, 1, date('Y')));
             
            $list['present'] = DB::table('attendance_new')
            ->select(DB::raw('COUNT(*) as value'))
            ->whereMonth('present_date', $i)->where('emp_id',$id)
            ->count();
p( $list['present']);
            $list['absent'] = $list['day']-$list['present'];
            $days[] = $list;
            }

         return view('employee.emp-attendancedetails',compact('title','days'));
    }
}
