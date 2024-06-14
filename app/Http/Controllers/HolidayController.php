<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\HolidayModel;
use DB;

class HolidayController extends Controller
{
    public function view()
    {
        $data['title'] = "Holidays";
        $data['sub_title'] = "";
        $data['sub_title_url'] = "";
        $data['sidebar']='Holiday';
        $current_year = date('Y'); 
        $fiscalYr = calculateFiscalYearForDate(date('m'));
        $sFiscalYr = explode(':',$fiscalYr);
        
        $holiday = HolidayModel::whereDate('start_date','>=',$sFiscalYr[0])->whereDate('start_date','<=',$sFiscalYr[1])->orderBy('start_date','ASC')->get();
        
        /*$holiday = DB::select('SELECT *  FROM holiday WHERE year(start_date) = '.date('Y').' ORDER BY IF(MONTH(start_date) < MONTH(NOW()), MONTH(start_date) + 12, MONTH(start_date)),
         DAY(start_date)');*/
    //  $holiday = HolidayModel::get();
        $data['holiday'] = array();
        foreach($holiday as $val) {
            $list['name'] = $val->holiday_name;
            $list['description'] = $val->holiday_description;
            $list['date'] = date('F d, Y', strtotime($val->start_date));
            if($val->end_date != "") {
                $list['date'] .= ' - '.date('F d, Y', strtotime($val->end_date));
            }
            $data['holiday'][] = $list;
        }
        return view('employee.holidays',compact('data'));
    }

    public function holiday()
    {
        $data['title'] = "Holidays";
        $data['sub_title'] = "";
        $data['sidebar'] = "Holiday";
        $data['holiday'] = HolidayModel::orderBy('id','desc')->get();
        
        return view('admin.holiday.list',compact('data'));
    }


    public function add_holiday(Request $request)
    {
        if(isset($request->id) && !empty($request->id)){
            $holiday = HolidayModel::find($request->id);
            $message = 'Data updated successfully.';
        }else{
            $holiday = new HolidayModel;
            $message = 'Data added successfully.';
        }
       
        $holiday->holiday_name = $request->holiday_name;
        $holiday->holiday_description = $request->holiday_description;
        $holiday->start_date = $request->start_date;
        $holiday->end_date = $request->end_date;
        $holiday->status = $request->status;
        $holiday->save();

        $status = 'true';
        return response()->json(compact('status','message'));
    }
   

}
