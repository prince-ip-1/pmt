<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\DesignationModel;
use DB;
class DesignationController extends Controller
{
     public function designation()
    {
        $data['title'] = 'Designation';
        $data['sub_title'] = "";
          $data['sidebar'] = "Designation";
        $department = DB::table('department')
        ->select('id','department_name')->where('status','=',1)->get();

        $data['designation'] = DesignationModel::select('designation.*','d.department_name')->leftJoin('department as d', 'd.id', '=', 'designation.dept_id')
       ->orderBy('id','desc')->get();
        
        return view('admin.designation.list',compact('data','department'));
    }
    public function add_designation()
    { 
        $data['title'] = 'Add Designation';
        $data['sub_title'] = "Designation";
        $data['sub_title_url'] = "admin/designation";
          $data['sidebar'] = "Designation";
        $department = DB::table('department')
        ->select('id','department_name')->where('status','=',1)->get();

        $data['designation'] = DesignationModel::select('designation.*','d.department_name')->leftJoin('department as d', 'd.id', '=', 'designation.dept_id')
       ->orderBy('id','desc')->get();
        $data['module_name'] = module_name();
        return view('admin.designation.add',compact('data','department'));
    }
    public function edit_designation($id)
    { 
        $data['title'] = 'Edit Designation';
        $data['sub_title'] = "Designation";
        $data['sub_title_url'] = "admin/designation";
          $data['sidebar'] = "Designation";
        $department = DB::table('department')
        ->select('id','department_name')->where('status','=',1)->get();
        
         $data['employees'] = DB::table('employee')
        ->select('id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"))->where('status','=',1)->where('designation_id','=',$id)->get();
       
        $data['designation'] = DesignationModel::select('designation.*','d.department_name')->leftJoin('department as d', 'd.id', '=', 'designation.dept_id')->where('designation.id',$id)
       ->orderBy('id','desc')->first();
      // p( $data['designation']);
        $data['permissions'] = json_decode($data['designation']->permissions)?json_decode($data['designation']->permissions):[];
        $d = [];
        $subtype = false;
        $sum = 0;
        $data1 = [];
        if(!empty($data['permissions'])){
            foreach($data['permissions'] as $k=>$row){ 
                $data2[]=$d;
            }
        }
   
        if(isset($data2) && count($data2) == 15){
        foreach($data['permissions'] as $k=>$row){ 
            if(isset($row->add)){
                $d['add'] = $row->add;
            }   
            if(isset($row->edit)){
                $d['edit'] = $row->edit;
            }
            if(isset($row->delete)){
                $d['delete'] = $row->delete;
            }
            if(isset($row->view)){
                $d['view'] = $row->view;
            }
            $data2[]=$d;
           $sum += count($d);
        }

         if($sum == 60){
            $subtype = true;
         }
        }
        $data['module_name'] = module_name();
       
        return view('admin.designation.edit',compact('data','department','subtype'));
    }
    public function post_designation(Request $request)
    {
        if(isset($request->id) && !empty($request->id)){
            $designation = DesignationModel :: find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $designation = new DesignationModel;
             $message = 'Data added successfully.';

        }
        //p($request->module_name);
       //p(json_encode($request->module_name));
        $designation->designation_name = $request->designation_name;
        $designation->dept_id = $request->department_id;
        $designation->status = $request->status;
        $designation->employee_id = isset($request->employee_id)?json_encode($request->employee_id):"";
        $designation->permissions = isset($request->module_name)?json_encode($request->module_name):"";
        $designation->save();
        
        $status = 'true';
       
       return response()->json(compact('status','message'));
    }
   
}
