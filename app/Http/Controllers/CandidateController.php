<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\SkillModel;
use App\Models\EmployeeModel;
use App\Models\QualificationMasterModel;
use DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use URL;


class CandidateController extends Controller
{
    public function candidate()
    {
        $data['title']='Candidate Details';
        $data['sub_title']='';
        $data['sidebar']='Candidate';
        $department = DepartmentModel::select('*')->where('status','=',1)->where('department_name','!=','Admin')->get();
        $designation = DesignationModel::select('*')->get();
        $skill = SkillModel::select('*')->get();
        $qualification = QualificationMasterModel::select('*')->orderBy('id','desc')->get();
        return view('admin.candidate.add_candidate',compact('data','department','designation','skill','qualification'));
    }
    public function addcandidate(Request $request)
    {       
        $logoname = " ";
        if($request->file('cv') != '')
        {
          $image = $request->file('cv');
          $logoname = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/uploads/candidate');
          $image->move($destinationPath, $logoname);
        }
        else{
            $logoname = $request->old_cv;
        }
        
        if(!empty($request->id)){
             $candidate = CandidateModel::find($request->id);
             if(empty($request->file('image'))){
               $imageitem = $request->old_image;
             }  
             $status = 'true';
             $message = 'Data updated successfully.';
         }else{
            $candidate = new CandidateModel;
            $status = 'true';
            $message = 'Data addedd successfully.';
         }
       
        $candidate->fullname = isset($request->fullname)?($request->fullname):"";
        $candidate->address = isset($request->address)?($request->address):"";
        $candidate->city = isset($request->city)?($request->city):"";
        $candidate->state = isset($request->state)?($request->state):"";
        $candidate->dob = $request->dob;
        $candidate->application_date = $request->application_date;
        $candidate->mobile_no = $request->mobile_no;
        $candidate->email_id = $request->email_id;
        $candidate->experience = $request->experience;
        $candidate->duration = isset($request->duration)?$request->duration:"";
        $candidate->other_years = isset($request->other_years)?$request->other_years:"";
        $candidate->education = $request->education;
        $candidate->eduction_text = $request->eduction_text;
        if(!empty($request->skills))
        {
        $candidate->skills = implode(',',$request->skills);
        }
        // else
        // {
        //     echo "Error";
        // }
        $candidate->other_skill = isset($request->other_skill)?($request->other_skill):"";
        $candidate->cv =  isset($logoname)?($logoname):"";
        $candidate->current_employer = isset($request->current_employer)?($request->current_employer):"";
        $candidate->position = isset($request->position)?($request->position):"";
        $candidate->desi_id = $request->desi_id;
        $candidate->reason_for_leaving = isset($request->reason)?($request->reason):"";
        $candidate->current_ctc = $request->cctc;
        $candidate->expected_ctc = $request->ectc;
        $candidate->additional_notes = isset($request->notes)?($request->notes):"";
        $candidate->notice_period = isset($request->notice_period)?($request->notice_period):"";
        $candidate->submit_status = isset($request->submit_status)?($request->submit_status):"";
        $candidate->portal = isset($request->portal)?($request->portal):"";
        $candidate->save();
        return response()->json(compact('status','message'));
        } 
        
       public function list2()
        {
            $data['title'] = "Candidates List";
            $data['sub_title'] = "";
            $data['sidebar']='Candidate';
            $data1['candidate'] = CandidateModel ::select('*')->orderby('id','desc')->get();
            $data['Pending'] = CandidateModel::select('status')->where('status','=',0)->orWhere('status','=',NULL)->count();
            $data['Selected'] = CandidateModel::select('status')->where('status','=',1)->count();
            $data['Onhold'] = CandidateModel::select('status')->where('status','=',3)->count();
            $data['Interview'] = CandidateModel::select('status')->where('status','=',4)->count();
            $data['Reschedule'] = CandidateModel::select('status')->where('status','=',8)->count();
            $data['Rejected'] = CandidateModel::select('status')->where('status','=',2)->count();
            return view('admin.candidate.list-candidate',compact('data','data1'));
        }
public function list(Request $request)
        {   
            $data['title'] = "Candidates List";
            $data['sub_title'] = "";
            $data['sidebar']='Candidate';
            
            $data['Pending'] = CandidateModel::select('status')->where('status','=',0)->orWhere('status','=',NULL)->count();
            $data['Selected'] = CandidateModel::select('status')->where('status','=',1)->count();
            $data['Onhold'] = CandidateModel::select('status')->where('status','=',3)->count();
            $data['Interview'] = CandidateModel::select('status')->where('status','=',4)->count();
            $data['Reschedule'] = CandidateModel::select('status')->where('status','=',8)->count();
            $data['Rejected'] = CandidateModel::select('status')->where('status','=',2)->count();
            $data1['candidate'] = [];
             if ($request->ajax()) {

                $data1 = CandidateModel::select('*')->orderby('id','desc')->latest();

                return DataTables::of($data1)
                
                 ->addIndexColumn()
                 ->editColumn('technology', function ($row) {
                  
                $technology = '';
                    if($row->desi_id == 1){
                        $technology .= 'Android Tech Lead';
                    }
                    elseif($row->desi_id == 2){
                        $technology .= 'iOS Tech Lead';
                    }
                    elseif($row->desi_id == 3){
                        $technology .= 'React Native Developer';
                    }
                    elseif($row->desi_id == 4){
                        $technology .='iOS Developer';
                    }
                    elseif($row->desi_id == 5){
                        $technology .='Android Developer';
                    }
                    elseif($row->desi_id == 6){
                        $technology .='Flutter Developer';
                    }
                    elseif($row->desi_id == 7){
                        $technology .='Python Developer';
                    }
                    elseif($row->desi_id == 8){
                         $technology .='Digital Marketing';
                    }
                    elseif($row->desi_id == 9){
                         $technology .='QA';
                    }
                    elseif($row->desi_id == 10){
                         $technology .='BDE';
                    }
                    elseif($row->desi_id == 11){
                        $technology .='PHP Trainee';
                    }
                    elseif($row->desi_id == 12){
                        $technology .='Android Trainee';
                    }
                    elseif($row->desi_id == 13){
                        $technology .='IOS Trainee';
                    }
                    elseif($row->desi_id == 14){
                        $technology ='PHP Developer';
                    }
                    elseif($row->desi_id == 15){
                        $technology .='Sr.PHP Tech Lead';
                    }
                    elseif($row->desi_id == 16){
                        $technology .='Project Manager';
                    }
                    elseif($row->desi_id == 17){
                        $technology .='Human Resource Executive';
                    }
                    elseif($row->desi_id == 18){
                        $technology .='Full Stack Developer';
                    }
                   
                   return $technology; 
                })
                 ->editColumn('status_name', function ($row) {
                   $status = getValue($row->status,'Candidate');
                   return $status; 
                })
                 ->filter(function ($instance) use ($request) {
                            if(!empty($request->get('candidate_status'))){
                                $instance->where('status', $request->get('candidate_status'));
                            }
                       
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('position', 'LIKE', "%$search%");
                                $w->orWhere('email_id', 'LIKE', "%$search%");
                                $w->orWhere('fullname', 'LIKE', "%$search%");
                                $w->orWhere('mobile_no', 'LIKE', "%$search%");
                            });
                        }
                    })
                ->editColumn('status', function ($row) {
                    $statusofcandiate = GetCandidateStatusList();
                    $html = '<select name="status" class="form-control form-control-primary candidatestatus  tabledit-input_'.$row->id.'" data-id="'.$row->id.'" style="height:20px; width:80%; " data-modal="modal-8">
                              <option value="">Select</option>';
                    foreach ($statusofcandiate as $k => $a) {
                        $selected = '';
                        if($row->status == $k){
                            $selected .= 'selected';
                        }
                        $html .= '<option '.$selected.' value="'.$k.'">'.$a.'</option>';
                    }
                    $html .= '</select>'; // Close the select element
                    return $html;
                })
                ->editColumn('interview_date', function ($row) {
                   $date = $row->interview_date;
                   if(!empty($date)){
                     $interview_date = date('d F Y, h:i:s A',strtotime($row->interview_date));
                 }else{
                     $interview_date = '--';
                 }
                   return $interview_date; 
                })
                    ->addColumn('action', function($row){
                        $usersession = Session('user_data');
                        $userdata = EmployeeDetailById($usersession->id);
                        $permission = $userdata->permissions;
                         $view_url = "";
                         $edit_url = "";
                         $btn = "";
                        if($userdata->department_id == 1){
                               $view_url = URL::to('admin/view_candidate/'.$row->id);
                               $edit_url = URL::to('admin/edit_candidate/'.$row->id);
                          
                        }else if(isset($permission[7]->view) && $permission[7]->view == 1){
                                $view_url = URL::to('employee/view_candidate/'.$row->id);
                                $edit_url = URL::to('employee/edit_candidate/'.$row->id);
                        }
                        
                         if(getDepartment() == 1 || isset($permission[7]) && $permission[7]->view == 1 || isset($permission[7]) && $permission[7]->edit == 1 || isset($permission[7]) && $permission[7]->delete == 1){
                           
                         $btn = '<div class="btn-group btn-group-sm tabledit-span_'.$row->id.' " style="float: none;">';
                         if( getDepartment() == 1 || isset($permission[7]->view) && $permission[7]->view == 1){
                         $btn .= '<a href="'.$view_url.'"  class="btn btn-warning waves-effect waves-light   btn-group-sm "  style="float: none;">
                                 <i class="icofont icofont-eye" style="margin-right:1px;"></i>
                                </a>';
                         }
                         if(getDepartment() == 1 || isset($permission[7]->edit) && $permission[7]->edit == 1){
                          $btn .= ' <a href="'.$edit_url.'"  class=" btn btn-primary waves-effect waves-light btn-group-sm " style="float: none;margin: 5px;"><i class="icofont icofont-ui-edit" style="margin-right:1px;"></i>
                                 </a>';
                             
                         }
                         if(getDepartment() == 1 || isset($permission[7]->delete) && $permission[7]->delete == 1){
                         $btn .= '<button type="button" data-id="'.$row->id.'" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;"><i class="icofont icofont-ui-delete" style="margin-right:1px;"></i>
                                 </button>';
                         }
                         if(getDepartment() == 1 || isset($permission[7]) && $permission[7]->view == 1 || isset($permission[7]) && $permission[7]->edit == 1 || isset($permission[7]) && $permission[7]->delete == 1){
                         $btn .= '<button type="button" data-id="'.$row->id.'" class=" btn btn-warning waves-effect waves-light " style="float: none;margin: 5px;"><a style="color: #fff;margin-right: -5px;" href = "'.getImagePath($row->cv,'candidate').'" target="_blank"><i class="icofont icofont-inbox"></i></a>
                                  </button>';  
                         }
                         $btn .= '</div>';
                         }
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
            }

            //return view('users');
            return view('admin.candidate.list-candidate2',compact('data','data1'));
        }
        public function getdesignationbyDepartment(Request $req)
        { 
        $get = DesignationModel::where('dept_id',$req->id)->where('status',1)->get();

        $res = [
            'status' => "true",
            'data' => $get
        ];
        return $res;  
         }
        public function candidate_status(Request $request)
        {
         if(isset($request->candidate_id) && !empty($request->candidate_id)){
            $candidate = CandidateModel :: find($request->candidate_id);
            $usersession = Session('user_data');
            $id = $usersession->id;
            $type = $request->type;

                if($type == 2){
                        $candidate->rejected_in = $request->rejected_in;
                        $candidate->reason = $request->reason;
                        $candidate->rejected_mail_status = $request->rejected_mail_status;
                        $candidate->status = 2;
                        $candidate->save();
                        
                        $candidate_details = CandidateDetailsById($candidate->id);
                   
                        $company_details = GetCompanyDetail();
                        $hr_details = GetHRDetailsById($id);
                       
                        $data = array('full_name'=>$candidate_details->fullname,
                        'technology'=>$candidate_details->position,
                       
                        'name'=>$hr_details->full_name,
                        'designation'=>$hr_details->designation_name,
                        'company_name'=>$company_details->company_name,
                        'website_url'=>$company_details->website_url,
                        );
                        
                            $mailData = array(
                            'to' => $candidate_details->email_id,
                            'subject' => 'Application for '. $candidate_details->position .' - '. $company_details->company_name,
                            'message' => view('mail.interview_rejected',compact('data'))
                        );
                         $a = sendMailCandidate($mailData);
                           
                }else {
                    if($request->term == 0)
                    {
                        $candidate->subject = $request->subject;
                        $candidate->btn_status = $request->term;
                        $candidate->interview_date = $request->interview_date;
                        $candidate->interview_place_status = $request->interview_place_status;
                        $candidate->send_mail = $request->send_mail;
                        $candidate->link = $request->link;
                        $candidate->employee_id = $request->employee_id;
                        $candidate->status = 4;
                        $candidate->save();
                    }
                    elseif($request->term == 1)
                    {
                        $candidate->subject = $request->subject;
                        $candidate->btn_status = $request->term;
                        $candidate->interview_date_reschedule = $request->interview_date_reschedule;
                        $candidate->interview_place_status = $request->interview_place_status;
                        $candidate->term = $request->term;
                        $candidate->link = $request->link;
                        $candidate->employee_id = $request->employee_id;
                        $candidate->status = 8;
                        $candidate->save();
                    }
                    else{
                         $candidate->status = 1;
                         $candidate->save();
                    } 
                        $candidate_details = CandidateDetailsById($candidate->id);
                       
                        $company_details = GetCompanyDetail();
                        $hr_details = GetHRDetailsById($id);
                        if($candidate->btn_status == 0 && (($candidate->send_mail == 5) || ($candidate->interview_place_status == 4))){
                             $date =  $candidate_details->interview_date;
                        }
                        else{
                            $date = $candidate_details->interview_date_reschedule;
                        }
                        $data = array('full_name'=>$candidate_details->fullname,
                        'technology'=>$candidate_details->position,
                        'date'=>date('d-m-Y',strtotime($date)),
                        'time' =>date('H:i:s A',strtotime($date)),
                        'day'=>date('l',strtotime($date)),
                        'link'=>$candidate_details->link,
                        'name'=>$hr_details->full_name,
                        'designation'=>$hr_details->designation_name,
                        'company_name'=>$company_details->company_name,
                        'website_url'=>$company_details->website_url,
                        );
                        if($candidate->btn_status == 0 && $candidate->send_mail == 5){
                           
                            $mailDataCandidate = array(
                            'to' => $candidate_details->email_id,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.schedule_interview_onfloor',compact('data'))
                        );
                        $mailDataEmployee = array(
                            'to' => $candidate_details->employee_office_email,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.schedule_interview_onfloor',compact('data'))
                        );
                        }
                        elseif($candidate->btn_status == 0 && $candidate->interview_place_status == 4){
                           
                             $mailDataCandidate = array(
                            'to' => $candidate_details->email_id,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.schedule_interview_online',compact('data'))
                        );
                        $mailDataEmployee = array(
                            'to' => $candidate_details->employee_office_email,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.schedule_interview_online',compact('data'))
                        );
                        
                        }
                        elseif($candidate->btn_status == 1 && $candidate->send_mail == 5){
                            $mailDataCandidate = array(
                            'to' => $candidate_details->email_id,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.reschedule_interview_onfloor',compact('data'))
                        );
                        $mailDataEmployee = array(
                            'to' => $candidate_details->employee_office_email,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.reschedule_interview_onfloor',compact('data'))
                        );
                        }
                        else{
                            $mailDataCandidate = array(
                            'to' => $candidate_details->email_id,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.reschedule_interview_online',compact('data'))
                        );
                        $mailDataEmployee = array(
                            'to' => $candidate_details->employee_office_email,
                            'subject' => $candidate_details->subject,
                            'message' => view('mail.reschedule_interview_online',compact('data'))
                        );
                        }
                        
                sendMailCandidate($mailDataCandidate);
                sendMailCandidate($mailDataEmployee);
                
                }
                 $message = 'Status Updated successfully.';
                 $status = 'true';
                return response()->json(compact('status','message'));
             }else{
                 $message = 'Something went wrong.';
                 $status = 'error';
                return response()->json(compact('status','message'));
             }
              
        }
        public function edit_candidate($id)
        {
            $data['title']='Edit Candidate';
            $data['sub_title']= 'Candidates';
            $data['sidebar']= 'Candidate';
            $data['sub_title_url']= 'admin/candidate_list';
            
            // $department = DepartmentModel::select('*')->where('status','=',1)->where('department_name','!=','Admin')->get();
            // $designation = DesignationModel::select('*')->get();
            $skill = SkillModel::select('*')->get();
           $data['candidate_details'] = CandidateModel::select('candidate.*','qualification_master.name')
            ->leftjoin('qualification_master','qualification_master.id','=','candidate.education')
            ->where('candidate.id',$id)->first();
            $qualification = QualificationMasterModel::select('*')->get();
            return view('admin.candidate.edit_candidate',compact('data','skill','qualification'));
        }
        
        public function view_candidate(Request $request)
        {
            $id = $request->id; 
            $data['title']='View Candidate Details';
            $data['sub_title']= 'Candidates';
            $data['sidebar']= 'Candidate';
            $data['sub_title_url']= 'admin/candidate_list';
            $data['candidate_details'] = CandidateModel::select('candidate.id','candidate.eduction_text','candidate.fullname','candidate.additional_notes','candidate.mobile_no','candidate.interview_date','candidate.interview_date_reschedule','candidate.address','candidate.email_id','candidate.city','candidate.state','candidate.experience','candidate.duration','candidate.other_years','candidate.dob','candidate.application_date','candidate.desi_id','candidate.reason','candidate.current_ctc','candidate.expected_ctc','candidate.position','candidate.current_employer','candidate.education','candidate.skills','candidate.notice_period','candidate.link','candidate.portal','candidate.employee_id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'designation.designation_name')
             ->leftjoin('employee','employee.id','=','candidate.employee_id')
            ->leftjoin('designation','designation.id','=','employee.designation_id')
            ->where('candidate.id',$id)->first();
            $skill = explode(',',$data['candidate_details']->skills);
            
            $html = "";
            foreach($skill as $val)
            {
                $html .= $this->getSkill($val);
                $html .= ',';
            }
            $data['candidate_details']->skills = $html;
            return view('admin.candidate.candidate_details',compact('data','html'));
        }
        public function getSkill($value)
        {
           
            $skill = DB::table('skill')->select('*')->where('id','=',$value)->first();
            if(!empty($skill)){
            return $skill->skill_name;
            }
        }
        public function addqualification(Request $request)
        {
            $qualification = new QualificationMasterModel;
            $qualification->name = $request->name;
            $qualification->save();
            
            $status = 'true';
            $message = 'Qualification Added Successfully';
            $data = $this->getQualififcationList();
            return response()->json(compact('status','message','data'));
        }
        public function getQualififcationList()
        {
            $bm = new QualificationMasterModel();
            $data = $bm->orderBy('id','desc')->get();
             $html = "";
             $html .=  '<option value="">Select Qualification</option>';
                
            if(!empty($data)){
               foreach($data as $row){ 
                    $html .='<option value="'.$row["id"].'">'.$row["name"].'</option>';
                }
                $html .='<option value="qualification" style="color:red;">Add Qualification</option>';
                return $html; 
            }else{
                return $html; 
            }
        }
        
        public function interview_list()
        {   
            $usersession = Session('user_data');
            $id = $usersession->id;
            $data['title']='Interview Details';
            $data['sub_title']= '';
            $data['sidebar']= 'Candidate';
            $data['sub_title_url']= 'admin/candidate_list';
           
            $data['candidate_details_list'] = EmployeeModel::select('employee.id','c.id','c.fullname','c.email_id','c.position','c.status','c.employee_id','c.emp_status','c.interview_date','c.interview_date_reschedule','c.cv')
            ->leftjoin('candidate as c','c.employee_id','=','employee.id')
            ->where('c.employee_id',$id)
            ->orderBy('c.id','desc')
            ->get();
           // p($data['candidate_details_list']);
            return view('admin.candidate.interview_list',compact('data'));
        }
        
        public function sendMailAgain(Request $request)
        {
             if(isset($request->id) && !empty($request->id)){
                $candidate = CandidateModel :: find($request->id);
             
                $mail_status = $request->mail_status;
                
                $usersession = Session('user_data');
                $id = $usersession->id;
                $type = $request->type;
                //$mail_status = $candidate->mail_status;
                $candidate_details = $employee_details = "";
                $candidate_details = CandidateDetailsById($candidate->id);
               
               /* if(in_array(0,$mail_status)){
                    
                }
                
                if(in_array(1,$mail_status)){
                 $employee_details = GetEmployeeEmailId($candidate->employee_id);
                }*/
                
                $company_details = GetCompanyDetail();
                $hr_details = GetHRDetailsById($id);
                
                foreach($mail_status as $row){
                   $candidate->mail_status = $row;
                    $candidate->save();
                }
                
               if($candidate->btn_status == 0 && (($candidate->send_mail == 5) || ($candidate->interview_place_status == 4))){
                     $date =  $candidate_details->interview_date;
                }
                else{
                    $date = $candidate_details->interview_date_reschedule;
                }
                
                 
                $data = array('full_name'=>$candidate_details->fullname,
                'technology'=>$candidate_details->position,
                'date'=>date('d-m-Y',strtotime($date)),
                'time' =>date('H:i:s A',strtotime($date)),
                'day'=>date('l',strtotime($date)),
                'link'=>$candidate_details->link,
                'name'=>$hr_details->full_name,
                'designation'=>$hr_details->designation_name,
                'company_name'=>$company_details->company_name,
                'website_url'=>$company_details->website_url,
                );
                $status = $candidate->status;
                $interview_status = $candidate->interview_place_status;
                
                $candidate_send_mail = false;
                $employee_send_mail = false;
                
               /* if(($status == 4 && in_array(0,$mail_status))){
                     $candidate_send_mail = true;
                }
                 if(($status == 4 && in_array(0,$mail_status))){
                     $employee_send_mail = true;
                }
                
                if($candidate_send_mail == true && $employee_send_mail == false){
                    // candidate
                    $to = $candidate_details->email_id;
                }else
                if($candidate_send_mail == false && $employee_send_mail == true){
                    //employee
                    $to = $candidate_details->employee_email;
                }elseif($candidate_send_mail == true && $employee_send_mail == true){{
                    $to = $candidate_details->email_id.','.$candidate_details->employee_email;
                }
                 $mailData = array(
                    'to' => $to,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_online',compact('data'))
                );*/
                if(count($mail_status) == 2){
                    if($candidate->status == 8 && $candidate->interview_place_status == 3 && in_array(1,$mail_status) && in_array(0,$mail_status)){
               
                    $mailData = array(
                        'to' => $candidate_details->email_id.','.$candidate_details->employee_email,
                        'subject' => $candidate_details->subject,
                        'message' => view('mail.reschedule_interview_onfloor',compact('data'))
                    );
                 }
                 elseif($candidate->status == 8 && $candidate->interview_place_status == 4 && in_array(1,$mail_status) && in_array(0,$mail_status)){
                    
                    $mailData = array(
                    'to' => $candidate_details->email_id.','.$candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_online',compact('data'))
                );
                 }
                  elseif($candidate->status == 4 && $candidate->interview_place_status == 3 && in_array(0,$mail_status) && in_array(1,$mail_status)){
             
                    $mailData = array(
                    'to' => $candidate_details->email_id.','.$candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_onfloor',compact('data'))
                );
               
                 }
                 elseif($candidate->status == 4 && $candidate->interview_place_status == 4 && in_array(0,$mail_status) && in_array(1,$mail_status)){
                
                    $mailData = array(
                    'to' => $candidate_details->email_id.','.$candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_online',compact('data'))
                );
                 }
                 
                }
                else{
                if($candidate->status == 4 && $candidate->interview_place_status == 3 && in_array(0,$mail_status)){
                    
                    $mailData = array(
                    'to' => $candidate_details->email_id,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_onfloor',compact('data'))
                );
                }
                 
                 
                
                elseif($candidate->status == 4 && $candidate->interview_place_status == 3 && in_array(1,$mail_status)){
                   
                    $mailData = array(
                    'to' => $candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_onfloor',compact('data'))
                );
                    
                }
                elseif($candidate->status == 4 && $candidate->interview_place_status == 4 &&  in_array(0,$mail_status)){
                  
                     $mailData = array(
                    'to' => $candidate_details->email_id,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_online',compact('data'))
                );
                
                }
                elseif($candidate->status == 4 && $candidate->interview_place_status == 4 &&  in_array(1,$mail_status)){
                  
                     $mailData = array(
                    'to' => $candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.schedule_interview_online',compact('data'))
                );
                
                }
                
                elseif($candidate->status == 8 && $candidate->interview_place_status == 3 &&  in_array(0,$mail_status)){
                  
                    $mailData = array(
                    'to' => $candidate_details->email_id,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_onfloor',compact('data'))
                );
                }
                elseif($candidate->status == 8 && $candidate->interview_place_status == 3 &&  in_array(1,$mail_status)){
                
                    $mailData = array(
                    'to' => $candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_onfloor',compact('data'))
                );
                }
                elseif($candidate->status == 8 && $candidate->interview_place_status == 4 && in_array(0,$mail_status)){
                    $mailData = array(
                    'to' => $candidate_details->email_id,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_online',compact('data'))
                );
                }
                elseif($candidate->status == 8 && $candidate->interview_place_status == 4 && in_array(1,$mail_status)){
                  
                    $mailData = array(
                    'to' => $candidate_details->employee_email,
                    'subject' => $candidate_details->subject,
                    'message' => view('mail.reschedule_interview_online',compact('data'))
                );
                 }
                }
                
                
                  sendMailCandidate($mailData);
                $message = 'Mail Sent successfully.';
                $status = 'true';
                return response()->json(compact('status','message'));
             }else{
                 $message = 'Something went wrong.';
                 $status = 'error';
                return response()->json(compact('status','message'));
             }
             
        }
        
        
        
        
    }
