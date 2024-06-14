<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemInfoModel;
use DataTables;
use DB;

class SystemInfoController extends Controller
{
   public function mobile_information()
    {
        $data['title'] = "mobiles";
        $data['sidebar'] = "System Information";
        $data['sub_title'] = "";
        $data['sub_title_url'] = "";
        //$data['system_information'] = SystemInfoModel::select('system_information.*','employee.first_name','employee.last_name')->join('employee','employee.id','=','system_information.emp_id')->orderBy('system_information.id','desc')->get();
        $data['system_information'] = SystemInfoModel::select('system_information.*','employee.first_name','employee.last_name')->leftjoin('employee','system_information.emp_id','=','employee.id')->where('platform','=','Android')->orWhere('platform','=','IOS')->orderBy('system_information.id','desc')->get();
        return view('admin.system_information.mobiles_list',compact('data'));
    }
    public function laptop_information()
    {
        $data['title'] = "Laptop";
        $data['sidebar'] = "System Information";
        $data['sub_title'] = "";
        $data['sub_title_url'] = "";
        $data['system_information'] = SystemInfoModel::select('system_information.*','employee.first_name','employee.last_name')->leftjoin('employee','system_information.emp_id','=','employee.id')->where('platform','=','Mac')->orWhere('platform','=','Window')->orderBy('system_information.id','desc')->get();
        return view('admin.system_information.laptops_list',compact('data'));
    }
    public function add_system_information(Request $request)
    {
        
        
        if(isset($request->id) && !empty($request->id)){
            $systeminfo = SystemInfoModel::find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $systeminfo = new SystemInfoModel;
             $message = 'Data added successfully.';

        }
        $invoiceitem = "";
        if($request->file('invoice'))
        {
             $invoice = $request->file('invoice');
             $invoiceitem = $request->system_model.'.'.$invoice->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/invoice');
             $invoice->move($destinationPath,$invoiceitem);
        }
        else{
            $invoiceitem = $request->old_invoice;
        }
        $systeminfo->emp_id = $request->employee_name;
        $systeminfo->system_name = $request->system_name;
        $systeminfo->platform = $request->platform;
        $systeminfo->system_model = $request->system_model;
        $systeminfo->ram = $request->ram;
        $systeminfo->storage = $request->storage;
        $systeminfo->price = $request->price;
        $systeminfo->purchase_date = $request->purchase_date;
        $systeminfo->purchase_from = $request->purchase_from;
        $systeminfo->device = $request->device;
        $systeminfo->gen = $request->gen;
         $systeminfo->dealer_name = $request->dealer_name;
        $systeminfo->os_version = $request->os_version;
        $systeminfo->invoice = $invoiceitem;
        $systeminfo->save();
        $status = 'true';
        return response()->json(compact('status','message'));
        
    }
    public function analystics_system_information()
   {
    $data['title'] = "System Analystics Information";
    $data['sidebar'] = "System Information";
    $data['sub_title'] = "";
    $data['total'] = SystemInfoModel::getsum();
    $data['windows'] = SystemInfoModel::getsum('Window');
    $data['android'] = SystemInfoModel::getsum('Android');
    $data['ios'] = SystemInfoModel::getsum('IOS');
    $data['mac'] = SystemInfoModel::getsum('Mac');
    $data['total_windows'] = SystemInfoModel::getcount('Window');
    $data['total_ios'] = SystemInfoModel::getcount('IOS');
    $data['total_android'] = SystemInfoModel::getcount('Android');
    $data['total_mac'] = SystemInfoModel::getcount('Mac');
        return view('admin.system_information.analystics_system_information',compact('data'));
   }
    public function system_info_details(Request $request)
    {
        $id = $request->id;
        $data = SystemInfoModel::select('system_information.*','employee.first_name')->leftjoin('employee','employee.id','=','system_information.emp_id')->where('system_information.id','=',$id)->first();
        $status = 'true';
        return response()->json(compact('status','data'));   
    }
}