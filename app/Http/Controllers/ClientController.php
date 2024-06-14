<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ClientModel;
use App\Models\ProjectModel;
use App\Models\TaskModel;
use App\Models\ClientConversionModel;
use App\Models\ProjectBidModel;
use App\Models\CurrencyModel;
use App\Http\Requests;

class ClientController extends Controller
{
    
    public function clients_list()
    {
        $data['title'] = "Clients List";
        $data['sub_title'] = "";
         $data['sidebar']='Client';
         $data['client'] = ClientModel::select('clients.id',DB::raw("CONCAT(firstname,' ',lastname) as full_name"),'clients.email','clients.image','clients.status','c.country_name as country_name','c.ISO_code as sort_name','cur.currency_symbol')
        ->leftjoin('country as c','c.id','=','clients.country')
        ->leftjoin('country as cur','cur.currency_symbol','=','clients.cost_symbol')
        ->get();
        
         $data['client_country'] = ClientModel::select('clients.country','country.country_name')
        ->leftjoin('country','country.id','=','clients.country')
        ->distinct()
        ->get();

        return view('admin.client.list-client',compact('data'));
    }
    public function add_client()
    {
        $data['title']='Add Client';
        $data['sub_title']='';
        $data['sidebar']='Client';
        $data['country'] = DB::table('country')->select('country_name','currency_symbol','id','ISO_code as short_name')->where('country_name','!=',"")->where('currency_symbol','!=',"")->get();
        $data['project_bid'] = ProjectBidModel::orderBy('id','desc')->where('status','=',1)->get();
        $data['currency'] = CurrencyModel::select('id','name','symbol')->orderBy('id','desc')->where('status','=',1)->get();
        return view('admin.client.add-client',compact('data'));
    }
    public function getclientcomments(Request $request)
    {
        //$data = "";
         if(isset($request->id) && !empty($request->id)){
            $data_list = DB::table('client_conversion')->select('*')->where('client_id',$request->id)->where('type','=',$request->type)->orderBy('id','desc')->get();    
            $data =  [];
            foreach($data_list as $row){
                $row->created_at = dateformat($row->created_at);
                $data[] = $row;
            }
            }else{
                $status = 'false';
                $message = 'Data not view successfully.';     
            }
           // p($data);
            $html = view('admin.client._client_comments',compact('data'))->render();
         
            $status = 'true';
            $message = 'Data view Successfully.';
            return response()->json(compact('status','message','html'));
    }
    public function client_conversion(Request $request)
    {
      
        if(isset($request->comment_id) && !empty($request->comment_id)){
            $data = ClientConversionModel::find($request->comment_id);
             $status = 'true';
            $message = 'Data  Updated successfully.';  
        }
        else{
             $data = new ClientConversionModel;
             $status = 'true';
            $message = 'Data  Added successfully.';  
        }
        
        $data->client_id = $request->id;
        $data->comments = $request->comments;
        $data->type = $request->type;
        $data->save();   
    
         $html = '';
         $html = '<tr id="comments_'.$data->id.'">'.
         '<td class="forcedWidth" style="overflow: hidden;text-overflow: ellipsis;"><span>'.$request->comments.'</span></td>'.
        '<td class="forced">'.date('d-m-Y').'</td>'.
         '<td class="forced">'.
        '<div class="btn-group btn-group-sm " style="float: none;">'.
        '<button type="button" data-id="'.$data->id.'"   data-client_id="'.$data->client_id.'" data-comment="'.$data->comments.'" class=" btn btn-primary waves-effect waves-light  edit_cilent_comment_data btn-group-sm " data-add="Update" style="float: none;margin: -5px;"><span class="icofont icofont-edit"></span></button>&nbsp;&nbsp;&nbsp;'.
        '<button type="button" data-id="'.$data->id.'" class=" delete_data btn btn-danger waves-effect waves-light   btn-group-sm " style="float: none;margin: -5px;"><span class="icofont icofont-trash"></span></button>'.
        '</div>'.
        '</td>'.
        '</tr>';
        return response()->json(compact('status','message','html'));  
    }
    public function edit_client(Request $request)
    {
        $data['client'] = ClientModel::select('clients.*','country.ISO_code')
        ->leftjoin('country','country.ISO_code','=','clients.country')
        ->where('clients.id',$request->id)
        
        ->first();
      
        $data['title']='Edit Client Details';
        $data['sub_title']='Clients';
        $data['sub_title_url']='admin/clients_list';
        $data['sidebar']='Clients';
        $data['sidebar']='Clients';
        $data['country'] = DB::table('country')->select('country_name','currency_symbol','id','ISO_code as short_name')->where('country_name','!=',"")->where('currency_symbol','!=',"")->get();
      
        return view('admin.client.edit-client',compact('data'));
    }
     public function addclients(Request $request)
    {
        $userdata = Session('user_data');
        $user_id = $userdata->id;
       $image_name = "";
      
        if($request->new_image)
        {
            $base64 = $request->new_image;
            $data = explode(',', $base64);
            $file = base64_decode($data[1]);
             
            $image_name = time().'.'.'png';
            $destinationPath = public_path('/uploads/clients/');
            file_put_contents($destinationPath.$image_name, $file);
            
        }
        else{
            $image_name = $request->old_image;
        }
          
            if(!empty($request->id)){
                 $data = ClientModel::find($request->id);
                 $status = 'true';
                 $message = 'Client updated successfully.';
             }else{
                $data = new ClientModel;
                $status = 'true';
                $message = 'Client addedd successfully.';
                 $data->user_id = $user_id;
             }
          
            $data->firstname = $request->firstname;
            
            $data->lastname = $request->lastname;
           
            $data->gender = $request->gender;
           
            $data->email = $request->email;
             
            // $a = explode(' ',$request->contact_no);
           
           /* $data->country_code = $a[0];
            $data->contact_no = $a[1];*/
             $data->contact_no = $request->contact_no;
            $data->country = $request->country;
            $data->company_name = $request->company_name;
            $data->company_address = $request->company_address;
            $data->company_website = $request->company_website;
            $data->skype = remove_http($request->skype);
            $data->linkedin = remove_http($request->linkedin);
            $data->image = $image_name;
            $data->status = isset($request->status)?($request->status):"";
            $data->project_link = remove_http($request->project_link);
            $data->portal = $request->portal;
            $data->applied_from_account = $request->applied_from_account;
            $data->date = $request->date;
            $data->cost_symbol = $request->cost_symbol;
            $data->project_cost = $request->project_cost;
            $data->bid_by = $request->bid_by;
            $data->scope = $request->scope;
            $data->overview = $request->overview;
            $data->invited_by = $request->invited_by;
            // $data->response_date_by_client = $request->response_date_by_client;
            // $data->reply_date_from_you = $request->reply_date_from_you;
            $data->additional_note = $request->additional_note;
            $data->plateform = $request->plateform;
            $data->technologies = json_encode($request->technologies);
            $data->save();
          
        if(empty($request->id)){
            foreach($request->last_conversion as $row){
              
            $clientconversion = new ClientConversionModel;
            $clientconversion->client_id = $data->id;
            $clientconversion->comments = $row;
            $clientconversion->type = "1";
            $clientconversion->save();
          }
          
             foreach($request->comments_from_clients as $row){
                    
            $clientconversion = new ClientConversionModel;
            $clientconversion->client_id = $data->id;
            $clientconversion->comments = $row;
            $clientconversion->type = "2";
            $clientconversion->save();
            }
        
        /*$status = 'true';
        $message = 'Client Added Successfully.';*/
        }
       return response()->json(compact('status','message'));
    }
  
    public function client_details($id)
    { 
        $data = [];
        $data['title']='Client Details';
        $data['sub_title']='Clients';
        $data['sub_title_url']='admin/clients_list';
        $data['sidebar']='Client';
        $data['client_details'] = ClientModel::select('clients.*',DB::raw("CONCAT(firstname,' ',lastname) as full_name"),'country.country_name as country_name','cu.symbol as currency_symbol','pb.name as bid_by')
        ->leftjoin('country','country.id','=','clients.country')
        //->leftjoin('country as c','c.id','=','clients.cost_symbol')
        ->leftjoin('currency as cu','cu.id','=','clients.cost_symbol')
        ->leftjoin('project_bid_type as pb','pb.id','=','clients.bid_by')
        ->where('clients.id','=',$id)->orderBy('id','desc')->first();
      
        $data['total_project'] = ClientModel::select('clients.*','project.client_id')
        ->join('project','project.client_id','=','clients.id')
        ->where('clients.id','=',$id)->count();
        $data['total_revenue'] = ClientModel::select('clients.id','project.project_amount','project.client_id')
        ->join('project','project.client_id','=','clients.id')
        ->where('clients.id','=',$id)->sum('project.project_amount');
        $data['total_technology'] = ClientModel::select('clients.id','project.technology_id','project.client_id')
        ->join('project','project.client_id','=','clients.id')
        ->where('clients.id','=',$id)->count();
        
         $data['projects'] = ProjectModel::select('project.id','project.project_name','project.project_description','project.employee_id','project.color','project.created_at','project.updated_at','project.start_date','project.end_date')
        ->where('project.client_id','=',$id)->orderby('id','desc')->get();
        $data['country'] = DB::table('country')->select('country_name','currency_symbol','id')->where('country_name','!=',"")->where('currency_symbol','!=',"")->get();
        foreach($data['projects'] as $k=>$row){
            
        $data['projects'][$k]['backlog_task'] = TaskModel::where('tasks.status','=',0)->where('tasks.project_id','=',$row->id)->count();
        $data['projects'][$k]['inprogress_task'] = TaskModel::where('tasks.status','=',2)->where('tasks.project_id','=',$row->id)->count();
        $data['projects'][$k]['completed_task'] = TaskModel::where('tasks.status','=',3)->where('tasks.project_id','=',$row->id)->count();
        }
        
        $country = DB::table('country')->select('country_name','id')->where('country_name','!=',"")->get();
        
        $conversions = ClientConversionModel::select('comments')->where('client_id','=',$id)->where('type','=',1)->get();
        $data['client_details']->conversions = $conversions;
        $comments = ClientConversionModel::select('comments')->where('client_id','=',$id)->where('type','=',2)->get();
        $data['client_details']->comments = $comments;
  
        $tech = json_decode($data['client_details']->technologies);
        $html = "";
     
        $data['client_details']->techdata = [];
      
        if(!empty($tech)){
            foreach($tech as $k){
             $html .= getValue($k,'Techologies');
             $html .= ','; 
           }
           }
      
     $data['client_details']->technologies = $html;
     $data['project_bid'] = ProjectBidModel::orderBy('id','desc')->where('status','=',1)->get();
        $data['currency'] = CurrencyModel::select('id','name','symbol')->orderBy('id','desc')->where('status','=',1)->get();
        return view('admin.client.client_details',compact('data','country'));
    }
    public function update_client(Request $request){
        if(isset($request->type) && $request->type == 1){
            $data = ClientModel::find($request->client_id);
            $data->firstname = $request->firstname;
            $data->lastname = $request->lastname;
            $data->gender = $request->gender;
            $data->country = $request->country;
            $data->company_name = $request->company_name;
            $data->company_address = $request->company_address;
            $data->company_website = $request->company_website;
           $data->save();
            
        }elseif(isset($request->type) && $request->type == 2){
            $data = ClientModel::find($request->client_id);
             $data->email = $request->email;
            $data->contact_no = $request->contact_no;
             $data->skype = $request->skype;
            $data->linkedin = $request->linkedin;
            $data->save();
        }elseif(isset($request->type) && $request->type == 3){

            $data = ClientModel::find($request->client_id); 
             $data->project_link = $request->project_link;
            $data->portal = $request->portal;
            $data->applied_from_account = $request->applied_from_account;
            $data->date = $request->date;
            $data->cost_symbol = $request->cost_symbol;
            $data->project_cost = $request->project_cost;
            $data->bid_by = $request->bid_by;
            $data->scope = $request->scope;
            $data->overview = $request->overview;
            $data->invited_by = $request->invited_by;
            // $data->response_date_by_client = $request->response_date_by_client;
            // $data->reply_date_from_you = $request->reply_date_from_you;
            $data->additional_note = $request->additional_note;
            $data->plateform = $request->plateform;
            $data->technologies = json_encode($request->technologies);
            $data->last_conversion = $request->last_conversion;
            $data->comments_from_clients = $request->comments_from_clients;
            $data->status = $request->status;
            $data->save();
        }
        $status = 'true';
        $message = "Data Updated Successfully.";
        return response()->json(compact('status','message'));
        
    }   
     public function get_base_host()
    {
        $root = "http://" . $_SERVER['HTTP_HOST'];
        $root .= str_replace(
            basename($_SERVER['SCRIPT_NAME']),
            "",
            $_SERVER['SCRIPT_NAME']
        );
        $base_url = $root;
        $host = preg_replace('/:\d+$/', '', $base_url);
        return trim($host);
    }
    public function add_client_milestone()
    {
        $data['title']='Add Client Milestone';
        $data['sub_title']='';
        $data['sidebar']='Client';
        return view('admin.client.add_client_milestone',compact('data'));
    }
    public function searchClient(Request $request)
    {
        $data1 = [];

        $query = DB::table('clients')
                            ->select('clients.id','clients.firstname','clients.lastname','clients.email','clients.image','clients.status','clients.country','country.country_name as country_name','country.ISO_code as sort_name')
                            ->leftjoin('country','clients.country','=','country.id');

        if(!empty($request->clientId)) {
            $query->where('clients.country',$request->clientId);
        }
        if(!empty($request->search)) {
            $query->where('clients.firstname','like','%'.$request->search.'%')
                ->orWhere('clients.email','like','%'.$request->search.'%')
                ->orWhere('clients.company_name','like','%'.$request->search.'%');
        }

        $data = $query->get();

        $data1 =  view('admin.client.search_client_list',compact('data'))->render();    
        return $data1;
    }
     public function getdescription(Request $request)
    {       $type=$request->type;
             $data_list = DB::table('clients')->select('scope','overview')->where('id',$request->id)->orderBy('id','desc')->get();  
            if($type == 3){
           
             $html = view('admin.client._client_description',compact('data_list'))->render();
            }
            else{
                  $html = view('admin.client._client_overview',compact('data_list'))->render();
            }
           
         
            $status = 'true';
            $message = 'Data view Successfully.';
            return response()->json(compact('status','message','html'));
    }
    public function getadditionalnotes(Request $request)
    {       $type=$request->type;
             $data_list = DB::table('clients')->select('additional_note')->where('id',$request->id)->orderBy('id','desc')->get();  
            if($type == 5){
           
             $html = view('admin.client._client_additional_notes',compact('data_list'))->render();
            }
            
         
            $status = 'true';
            $message = 'Data view Successfully.';
            return response()->json(compact('status','message','html'));
    }
    /* public function checkEmail(Request $request)
      {  
         $user = ClientModel::where('email','LIKE','%'.$request->email.'%')->first();
         
         if($user){
             $status = true;
            return response()->json(compact('status'));
         }
         else{
             $status = false;
            return response()->json(compact('status'));
         }
     }*/

      public function add_project_bid(Request $request){
         if(isset($request->id) && !empty($request->id)){
            $category = ProjectBidModel::find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $category = new ProjectBidModel;
             $message = 'Data added successfully.';

        }

        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->save();
        $status = 'true';
        $list = ProjectBidModel ::where('status','=',1)->orderBy('id','desc')->get();
        $data1 = [];
        $html = '<option value="">Please Select </option>';
        foreach($list as $row){
            $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            
        }
        $html .= '<option value="-1" style="color: #01a9ac;">+ Add New Item</option>';
        
        return response()->json(compact('status','message','html'));
    } 
}