<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\TemplateModel;
use Session;

class TemplateController extends Controller
{
    
    public function index()
    {
       /* $sess = session('admin');
        if(empty($sess))
        {
            return redirect('login');
        }*/
        $data = [];
        $data['title'] = 'Template List';
        $data['sub_title'] = "";
        $data['sidebar'] = "Templates";
         $userdata = Session('user_data');
        $user_id = $userdata->id;
        if(getDepartment() == 1){
                 $data['template_list'] = TemplateModel::select('id','template_title','template_description','status')
                ->orderby('id','desc')
                ->get();
        }else{
              $data['template_list'] = TemplateModel::select('id','template_title','template_description','status')
                ->orderby('id','desc')
                ->get();
        }
       ;
        return view('admin.custom_template.template_list',compact('data'));
    }
    public function add_template(){
        $data['title']='Add Template';
        $data['sub_title']= 'Templates';
        $data['sidebar'] = "Template";
        $data['sub_title_url']= 'admin/template_list';
       
        return view('admin.custom_template.add_template',compact('data'));
    }
    public function edit_template($id){
        
        $template = TemplateModel::find($id);
        $data['title']='Edit Template';
        $data['sub_title']= 'Templates';
        $data['sidebar'] = "Template";
        $data['sub_title_url']= 'admin/template_list';
        $data['template_details'] = $template;
        
        return view('admin.custom_template.edit_template',compact('data'));
    }
    public function view_template($id)
    {
        $template = TemplateModel::find($id);
        echo  $template->template_description;
    }
    
    public function post_template(Request $request)
    {
        $userdata = Session('user_data');
       if(!empty($request->template_id)){
            
             $data = TemplateModel::find($request->template_id);
             
             $status = 'true';
             $message = 'Data updated successfully.';
         }else{
            $data = new TemplateModel;
            $status = 'true';
            $message = 'Data addedd successfully.';
            
         }
        
        
        $data->template_title = $request->template_title;
        $data->template_description = $request->template_description;
        $data->email_subject = $request->email_subject;
       
        $data->save();
        
      
        return response()->json(compact('status','message'));
    }
    
    
    
    
}

