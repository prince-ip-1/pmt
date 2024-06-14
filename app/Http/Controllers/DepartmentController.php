<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentModel;
use DataTables;
class DepartmentController extends Controller
{
    public function department()
    {
        $data['title'] = "Department";
        $data['sidebar'] = "Department";
        $data['sub_title'] = "";
        $data['department'] = DepartmentModel::orderBy('id','desc')->get();
        
        return view('admin.department.list',compact('data'));
    }
   
    public function adddepartment(Request $request)
    {
        
        
        if(isset($request->id) && !empty($request->id)){
            $department = DepartmentModel :: find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $department = new DepartmentModel;
             $message = 'Data added successfully.';

        }

        $department->department_name = $request->department_name;
        $department->status = $request->status;
        $department->save();
        $status = 'true';
        return response()->json(compact('status','message'));
        
    }
    
  

}
