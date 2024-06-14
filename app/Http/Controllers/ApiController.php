<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTFactory;
use JWTAuth;
use Response;
use Hash;
use DB;
use PDF;
use Date;
use URL;
use Mail;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\EmployeeModel;
use App\Models\TokenModel;
use App\Models\Checkin;
use App\Models\EmpLeaveModel;
use App\Models\SalaryModel;
use App\Models\BankDetail;
use App\Models\Company;
use App\Models\AttendanceModel;
use App\Models\HolidayModel;
use App\Models\NotificationListModel;
use App\Models\TaskTrackingModel;
class ApiController extends Controller
{
    public function get_base_host()
    {
        $root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
        $root .= str_replace( basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME'] );
        $base_url = $root;
        $host = preg_replace('/:\d+$/', '', $base_url);
        return trim($host);
    }
    public function login(Request $request)
    {
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $email = $postData['email'];
        $password = $postData['password'];
        $checkUserExist = EmployeeModel::where('email',$email)->first();
        if(empty($checkUserExist)) 
        {
            $status = 'error';
            $msg = 'Email does not exist';
            return Response::json(compact('status','msg'));
        }else if(! Hash::check($password,$checkUserExist->password))
        {
                $status =  'error';
                $msg = 'Invalid password';
                return Response::json(compact('status', 'msg'));
        }
        else if($checkUserExist->status == 0)
        {
            $status = 'error';
            $msg = 'Seem\'s like you are not active for further access, Please contact with your administrator.';
            return Response::json(compact('status','msg'));
        }
        else if($checkUserExist->status == 2){
            $status = 'error';
            $msg = 'Your Account is Deleted, Please contact with your administrator.';
            return Response::json(compact('status','msg'));
        }else 
        {
            $user = $checkUserExist;
            $name = $user->first_name.' '.$user->last_name;
            try { 
                if (! $token = JWTAuth::fromUser($user)) { 
                    return response()->json(['status'=>'error', 'msg'=> 'Invalid Credentials'], 401);
                } 
            } catch (JWTException $e) { 
                    return response()->json(['status'=>'error', 'msg'=> 'Could not create token'], 500); 
            }
            $employee_data = [
                'user_id' => $user->id,
                'email' => $user->email,
                'full_name' => $name,
                'profile' => getImagePath($user->image,'users')
               ];
            $status = 'success';
            $msg = 'Employee logged in successfully';
            $data = $employee_data;

            $updateAuthToken = EmployeeModel::where('id',$user->id)->update(['fcm_token' => $token,'app_version' =>$postData['app_version']]);

            $addDeviceInfo = new TokenModel;
            $addDeviceInfo->user_Id = $user->id;
            $addDeviceInfo->device_Type = $postData['device_type'];
            $addDeviceInfo->fcm_Token = $postData['fcm_token'];
            $addDeviceInfo->app_version = $postData['app_version'];
            $addDeviceInfo->save();
            return Response::json(compact('status','msg','data'));
        }
    }

    public function getUserProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'type' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id',$user_id)->Where('status',1)->count();
        if($userexist == 0) 
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else 
        {
           
           
            $type = $request->type;
            if($type == 1)
            {
            $userdata1 = EmployeeModel::select('employee.*','designation.designation_name')->leftjoin('designation','designation.id','=','employee.designation_id')->where('employee.id',$user_id)->first();
            $name = $userdata1->first_name.' '.$userdata1->last_name;
            $user_data = [
            'first_name' => $userdata1->first_name?$userdata1->first_name:"",
            'full_name' => $name?$name:"",
            'dob' => isset($userdata1->dob)?dateformat($userdata1->dob):date('d-m-Y'),
            'gender' => $userdata1->gender?$userdata1->gender:"",
            'email'=>$userdata1->email?$userdata1->email:"",
            'mobile_no'=>$userdata1->contact_no?(string)$userdata1->contact_no:"",
            'address'=>$userdata1->address?$userdata1->address:"",
            'designation_name'=>$userdata1->designation_name?$userdata1->designation_name:"",
            // 'app_version' => $userdata1->app_version?$userdata1->app_version:"",
            'profile_image' => getImagePath($userdata1->image,'users'),
            ];
            $status = 'success';
            $msg = 'Get Profile Data Successfully';
            $data = $user_data;
            }
            elseif($type == 2)
            { 
                $userdata5 = EmployeeModel::select('employee.*','employee_bank_detail.bank_name','employee_bank_detail.ifsc_code','employee_bank_detail.branch_name','employee_bank_detail.account_no','designation.designation_name','department.department_name')
                ->leftjoin('employee_bank_detail','employee_bank_detail.employee_id','=','employee.id')
                ->leftjoin('department','department.id','=','employee.department_id')
                ->leftjoin('designation','designation.id','=','employee.designation_id')
                ->where('employee.id',$user_id)->first();
            
                $user_data = [
                     'department' => $userdata5->department_name?$userdata5->department_name:"",
                     'designation' => $userdata5->designation_name?$userdata5->designation_name:"",
                     'work_experience' =>$userdata5->experience?$userdata5->experience:"", 
                     'current_ctc' =>$userdata5->currentCTC?$userdata5->currentCTC:"",
                     'date_of_joining' =>$userdata5->join_date?dateformat($userdata5->join_date):"",
                     'term' =>$userdata5->term?(string)$userdata5->term:"",
                     'bond_duration' =>$userdata5->bond_duration?$userdata5->bond_duration:"",
                     'deduction_amount' =>$userdata5->deduction_amt?$userdata5->deduction_amt:"",
                     'bank_name' =>$userdata5->bank_name?$userdata5->bank_name:"",
                     'branch_name' =>$userdata5->branch_name?$userdata5->branch_name:"",
                     'account_no' =>$userdata5->account_no?$userdata5->account_no:"",
                     'ifsc_code' =>$userdata5->ifsc_code?$userdata5->ifsc_code:""
                ];
            $status = 'success';
            $msg = 'Get Official Data Successfully';
            $data = $user_data;
            }
            else
            {
                $status = 'error';
                $msg = 'No Data Found';
                $data = "";
            }
            return Response::json(compact('status', 'msg','data'));
        }
    }

    public function GetCompanyProfile(Request $request)
    {
       $Company_Data = Company::first();
        if(!empty($Company_Data)){
               $user_data = [
                'id' => $Company_Data->id,
                'company_name' => $Company_Data->company_name,
                'company_email' => $Company_Data->company_email,
                'hr_email' => $Company_Data->hr_email,
                'address' => $Company_Data->address,
                'mobile_no' => $Company_Data->mobile_no,
                'website_url' => $Company_Data->website_url,
                'skype_url' => $Company_Data->skype_url, 
                'linkdin_url' => $Company_Data->linkedin_url,
                'instagram_url' => $Company_Data->instagram_url,
                'since_year' => $Company_Data->since_year
            ];
            $status = 'success';
            $msg = 'Get Company Profile Successfully';
            $data = $user_data;
        }else
        {
            $data = "";
            $status = 'error';
            $msg = 'Data Not Found';
        }
        return Response::json(compact('status', 'msg','data'));
    }

    public function GetCheckInDetails(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }else{
            $userdata4 = Checkin::where('employee_id','=',$user_id)->where('date','=',date('Y-m-d'))->where('type','=',1)->first();
            $user_data =[];
            if(empty($userdata4)){
                $user_data = [
                    'id'=> $user_id,
                    'date' => date('d-m-Y'),
                    'time_in' => '',
                    'time_out' => '',
                    'duration' =>'',
                    'remaining_time' =>'',
                    ];
                   }
            else
            {
                $remaintime = "00:00:00";
                if(!empty($userdata4->time_out))
                {
                    $duration = getHourDuration($userdata4->time_in,$userdata4->time_out); 
                    $user_data = [
                    'id'=> $userdata4->id,
                    'date' => dateformat($userdata4->date),
                    'time_in' => timeformatto($userdata4->time_in),
                    'time_out' => timeformatto($userdata4->time_out),
                    'duration' =>$duration['duration'],
                    'remaining_time' => $remaintime
                    ];
                }
                else
                {
                    
			$end_time = date('H:i:s');

			$s = Carbon::parse($userdata4->time_in);

			$e = Carbon::parse($end_time);

            
            	$timestamp = strtotime($userdata4->time_in) + 60*60*9;

				$nineHourTime = date('H:i:s', $timestamp);

				$s1 = Carbon::parse($nineHourTime);

				// $diff_in_hours = $s1->diffInHours($e);

				// echo $diff_in_hours;die;

            	$duration2 =  $s1->diff($e)->format('%H:%I:%S');
                
                    $duration = getHourDuration($userdata4->time_in,$userdata4->time_out); 
                    $remaining_time = strtotime(date('m/d/Y') .' ' . $nineHourTime);
                    $current_time = strtotime(date('m/d/Y H:i:s'));
                    if($current_time < $remaining_time){ 
                    	     $remaining_time = $duration['remainTime'];
                    }else{
                    	    $remaining_time = $duration['duration'];
                    }
                    
                    $user_data = [
                    'id'=> $userdata4->id,
                    'date' => dateformat($userdata4->date),
                    'time_in' => $userdata4->time_in?timeformatto($userdata4->time_in):"",
                    'time_out' => $userdata4->time_out?timeformatto($userdata4->time_out):"",
                    'duration' => $duration['duration'],
                    'remaining_time' => $remaining_time
                    ];
                }
            }
            $userdata5 = Checkin::where('employee_id','=',$user_id)->where('date','=',date('Y-m-d'))->where('type','=',2)->get();
            $user_data1 = array();
            $break = "00:00:00";
          
            if($userdata5->isEmpty()){ 
                $user_data1[0] = new \stdClass();
                    $user_data1[0]->id=1;
                    $user_data1[0]->date = date('d-m-Y');
                    $user_data1[0]->time_in = "00:00";
                    $user_data1[0]->time_out = "00:00";
                    $user_data1[0]->duration = "00:00:00";
                
            }
            else{
                foreach($userdata5 as $k1=>$row)
                {
                    $user_data1[$k1] = new \stdClass();
                    $user_data1[$k1]->id=$row->id;
                    $user_data1[$k1]->date = dateformat($row->date);
                    $user_data1[$k1]->time_in = $row->time_in?timeformatto($row->time_in):"";
                    $user_data1[$k1]->time_out = $row->time_out?timeformatto($row->time_out):"";
                    $a = breakDuration($row->time_in,$row->time_out);
                    $user_data1[$k1]->duration = $a['b'];
                    
                    $date2 = date('Y-m-d',strtotime($row->time_in));
                    $break = Checkin::getBreakTime($date2,$user_id);
                }
            } 
            $data['total_breaktime'] = $break;
            $data['checkin'] = $user_data;
            $data['breakin'] = $user_data1;
            $status = 'success';
            $msg = 'Get Checkin Details Successfully';
        return Response::json(compact('status', 'msg','data'));
       }
            
    }

    public function GetCheckIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'type' => 'required|numeric',
             $location = [
                    'lat'=>$request->lat,
                    'long'=>$request->long,
                    'accuracy'=>$request->accuracy,
                ]
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else{
            $type = $request->type;
            $check = Checkin::where('employee_id',$user_id)->where('date',date('Y-m-d'))->count();
            if($type == 1)
            {
                if($check > 0){
                    $status = 'success';
                    $msg = 'You have already checked in';
                    $data = NULL;
                    return Response::json(compact('status', 'msg'));
                }
                else{
        	        
                    $add = new Checkin;
                    $add->employee_id = $user_id;
                    $add->type = $request->type;
                    $add->time_in = date('H:i:s');
                    $add->date = date('Y-m-d');
                    $add->checkin_location = json_encode($location);
                    // $add->address = $address;
                    $add->device_type = "1";
                    $add->save();
                    
                    $args = [
                        'userId' => $user_id,
                        'id' => $add->id, 
                        'lat'=> $request->lat, 
                        'lng' => $request->long
                    ];
        
                    \Artisan::call('set:address',['args' => $args]);
        
                    $start_time = $add['time_in'];
                    $end_time = date('H:i:s');
        
                    $s = Carbon::parse($start_time);
                    $e = Carbon::parse($end_time);
                    $duration =  $s->diff($e)->format('%H:%I:%S');
                    $add->date = dateformat($add->date);
                }
                $user_data = [
                    'id' =>$add->id,
                    'date' =>$add->date,
                    'time_in'=>timeformatto($add->time_in),
                    'time_out' =>$add->time_out?timeformatto($add->time_out):"",
                ];
                $status = 'success';
                $msg = ' Check In Successfully';
                $data = $user_data;
                return Response::json(compact('status', 'msg','data'));
            }
            elseif($type == 2)
            {
                $checkin_data = Checkin::where('date','=',date('Y-m-d'))->where('employee_id','=',$user_id)->where('type','=',1)->first();
                $add = Checkin::find($checkin_data->id);
                $add->employee_id = $user_id;
                $add->time_out = date('H:i:s');
                $add->save();

                $start_time = $add['time_out'];
                $end_time = date('H:i:s');
    
                $s = Carbon::parse($start_time);
                $e = Carbon::parse($end_time);
                $duration =  $s->diff($e)->format('%H:%I:%S');
            
                $add->date = dateformat($add->date);
            
                $time = date('H:i:s');
                    $date = date('Y-m-d');
                    $checkTracking = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$user_id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','desc')->first();
                    
                     if(!empty($checkTracking)){
                        $updateBreak = TaskTrackingModel::where([
                         ['id','=',$checkTracking->id]
                         
    
                        ])->update(['end_time'=>$time,'end_date'=>$date]);
                     }
            $user_data = [
                'id' =>$add->id,
                'date' =>$add->date,
                'time_in'=>timeformatto($add->time_in),
                'time_out' =>$add->time_out?timeformatto($add->time_out):"",
                ];
                $status = 'success';
                $msg = ' Check Out Successfully';
                $data = $user_data;
            return Response::json(compact('status', 'msg','data'));
            }
            else
            {
                if($type == 3)
                {
                    $add = new Checkin;
                    $add->employee_id = $user_id;
                    $add->type = 2;
                    $add->time_in = date('H:i:s');
                    $add->date = date('Y-m-d');
                    $add->save();
        
                    $start_time = $add['time_in'];
                    $end_time = date('H:i:s');
                    $s = Carbon::parse($start_time);
                    $e = Carbon::parse($end_time);
                    $duration =  $s->diff($e)->format('%H:%I:%S');
                    $add->date = dateformat($add->date);
                    
                    $time = date('H:i:s');
                    $date = date('Y-m-d');
                    $checkTracking = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$user_id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','desc')->first();
                    
                     if(!empty($checkTracking)){
                        $updateBreak = TaskTrackingModel::where([
                         ['id','=',$checkTracking->id]
                         
    
                        ])->update(['end_time'=>$time,'end_date'=>$date]);
                     }
                    
                     
                    $user_data = [
                        'id' =>$add->id,
                        'date' =>$add->date,
                        'time_in'=>$add->time_in?timeformatto($add->time_in):"",
                        'time_out' =>$add->time_out?timeformatto($add->time_out):"",
                        ];
                        $status = 'success';
                        $msg = ' Break In Successfully';
                        $data = $user_data;
                    return Response::json(compact('status', 'msg','data'));
                }
                 elseif($type == 4)
                {
                $checkin_data = Checkin::where('date','=',date('Y-m-d'))->where('employee_id','=',$user_id)->where('type','=',2)->orderBy('id', 'desc')->first();
               
                $add = Checkin::find($checkin_data->id);
                $add->employee_id = $user_id;
                $add->time_out = date('H:i:s');
                $add->save();
                $start_time = $add['time_out'];
                $end_time = date('H:i:s');
                $s = Carbon::parse($start_time);
                $e = Carbon::parse($end_time);
                $duration =  $s->diff($e)->format('%H:%I:%S');
                $add->date = dateformat($add->date);
                $user_data = [
                    'id' =>$add->id,
                    'date' =>$add->date,
                    'time_in'=>timeformatto($add->time_in),
                    'time_out' =>$add->time_out?timeformatto($add->time_out):"",
                    ];
                    $status = 'success';
                    $msg = ' Break Out Successfully';
                    $data = $user_data;
                return Response::json(compact('status', 'msg','data'));
                }
            }
        }
    }

    public function ForgotPassword(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $email = $request->email;
        $userexist = EmployeeModel::where('email','=',$request->email)->Where('status',1)->first();
 
        if(empty($userexist)) {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        if($userexist->status = 0)
        {
            $status = 'error';
            $msg = 'Seem\'s like you are not active for further access, Please contact with your administrator.';
            return Response::json(compact('status','msg'));
        }
        else{
            $name = $userexist->first_name.' '.$userexist->last_name;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $length = 20;
            $token = '';
            for ($i = 0; $i < $length; $i++) {
                    $token .= $characters[rand(0, $charactersLength - 1)];
            }
            $updateToken = EmployeeModel::where('email',$request->email)->update(['forgot_pass_token'=>$token]);
            $data = array('name'=>$name,'token'=>$token);
            $mailData = array(
                    'to' => $userexist->email,
                    'subject' => 'Reset Password',
                    'message' => view('mail.forgot_password',compact('data'))
                );
            sendMail($mailData);
            $user_data = [
               'user_id' => $userexist->id
            ];
        $status = 'success';
        $msg = 'Please Check your Email For Reset Password';
        $data = $user_data;

        }
        return Response::json(compact('status', 'msg','data'));
    }
    public function GetAttendanceDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'month' =>'required|numeric',
            'year' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        
       
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else{
            $user = Checkin::select('*')->where([['employee_id','=',$user_id],['type','=',1],])->whereMonth('date', $request->month)->whereYear('date',$request->year)->get();
            //$present_days = DB::table('checkin')->where('employee_id',$user_id)->whereMonth('date',$request->month)->where('type',1)->count();
            //$leave = DB::table('leave')->select('leave.id')->where('emp_id','=',$user_id)->whereMonth('start_date',$request->month)->where('status',1)->count();
           // $leave = DB::table('leave')->select('leave.id')->where('emp_id','=',$user_id)->whereMonth('start_date',date('m'))->where('status',1)->where('leave.leavetype','!=',11)->sum('leave.leavetype');
       
           // $taken_leave = EmpLeaveModel::where('emp_id',$user_id)->whereMonth('start_date',date('m'))->where('status',1)->get();
                $cMonLeave = 0;
                if(!empty($taken_leave)) {
                    foreach($taken_leave as $c) {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $cMonLeave = $cMonLeave + $leave;
                    }
                }
             
            $leave =$cMonLeave;
            $lateEntry =DB::select('SELECT  * FROM checkin WHERE time_in > "10:30" AND type = 1 AND employee_id="'.$request->user_id.'" AND MONTH(date) = '.$request->month);
         
            $data['month'] = $request->month;
            $data['month_number'] = Carbon::now()->month($data['month'])->daysInMonth;
           
            $data['year'] = $request->year;
           
            if(date('m',strtotime(date('Y-m-d'))) == $request->month && $data['year'] == date('Y')){
                $data['month_number'] = date('d');
            }else{
               
            $data['month_number'] = cal_days_in_month(CAL_GREGORIAN, $data['month'], $data['year']);
       
            }
          
           // p([date('m'),$data['month']]);
           
            if(empty($user) && $data['month'] > date('m') && $request->year != date('Y',strtotime($user[0]->date))){
                $status = 'error';
                $msg = 'No Data Found';
                $data = [];
                $data['attendance_details'] = [];
                return Response::json(compact('status', 'msg','data'));
            }
            // for($i = 1; $i <=  date('d'); $i++)
            for($i = 1; $i <=  $data['month_number']; $i++)
            {
                $dates_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.$data['month'].'-'.$data['year'];
            }
           
            
            $result = array();
            $leave_data = EmpLeaveModel::where('emp_id',$user_id)->whereMonth('start_date',$request->month)->where('status',1)->get();
            $leave_date = array();
            foreach($leave_data as $val){ 
                         $period = $this->getDatesFromRange($val->start_date, $val->end_date);
                         $leave_date =   array_merge($period,$leave_date);
            }

            foreach($dates_array as $k1=>$row){
            $result[$k1] = new \stdClass();
            // $result[$k1]->id = "";
            $d = date('Y-m-d',strtotime($row));
            $result[$k1]->date = date('Y-m-d',strtotime($row));
            $result[$k1]->checkin = "";
            $result[$k1]->checkout = "";
            $result[$k1]->breaktime = "";
            $result[$k1]->duration = "";
            $result[$k1]->address = "";
            $result[$k1]->weekend = "0";
            $result[$k1]->is_present = "0";
            $result[$k1]->is_leave_taken = "0";
            $result[$k1]->is_late_entry = "0";
            $timestamp = strtotime($row);
            $day = date('D', $timestamp);
           
             $test = "";
            /*if(!empty($leave_data)){
                
                foreach($leave_data as $val){ 
                    if(isset($val->end_date) &&  $val->end_date != ""){ 
                        $period = displayDates($val->start_date,$val->end_date);
                       
                        if(in_array($d,$period)){
                            
                            $leave = EmpLeaveModel::whereDate('start_date',$val->start_date)->first();
                            
                            if(!empty($leave) && in_array($d,$period)) {
                                $test = "1";
                            }else{
                                $test = "0";
                            }
                           
                        }
                    } else if(isset($val->start_date) && $val->start_date == $d) {
                        
                        
                        $leave = EmpLeaveModel::whereDate('start_date',$val->start_date)->where('emp_id',$user_id)->first();
                       
                        if(!empty($leave)) {
                            $test = "1";
                        }else{
                            $test = "0";
                        }
                       
                     }
                     
                 }
                 
            }*/
            
            if($day == 'Sat' || $day == 'Sun')
                    $a = $result[$k1]->weekend = "1";
            else
                $a = $result[$k1]->weekend = "0";
           
            foreach($user as $k2=>$row2){ 
               $date2 = date('Y-m-d',strtotime($row));
                    if(in_array($d,$leave_date) /*&& $row2->time_in == NULL &&  $day != 'Sat' && $day != 'Sun'*/ ){
                        $test = "1";
                    }else{
                        $test = "0";
                    }
                $result[$k1]->is_leave_taken = $test;
                if($date2 == $row2->date){
                
                    $break = Checkin::getBreakTime($date2,$user_id);
                    // $result[$k1]->id = (string)$row2->id;
                    $result[$k1]->date = $row2->date;
                    $result[$k1]->checkin = timeformatto($row2->time_in);
                    $result[$k1]->checkout = $row2->time_out?(timeformatto($row2->time_out)):"";
                    $result[$k1]->breaktime = timeformatto($break);
                    $duration = getHourDuration($row2->time_in,$row2->time_out); 
                    $working_hours = GetWorkingHoures($break,$duration['duration']); 
                    $result[$k1]->duration = $working_hours;
                    // $result[$k1]->duration = timeformatto($duration['duration']);
                    $result[$k1]->weekend = $a;
                    $result[$k1]->is_present = "1";
                    $result[$k1]->is_late_entry = "0";
                    if($result[$k1]->checkin > "10:30"){
                        $result[$k1]->is_late_entry = "1";
                    }
                    $address = json_decode($row2->checkin_location); 
                    if(!empty($row2->checkin_location)){
                        $address = json_decode($row2->checkin_location); 
                        $result[$k1]->address = getAddress($address->lat,$address->long);
                    }
                }
            }
        }
        }
        if(count($user) > 0){
        $status = "success";
        $msg = 'Data Fetch Successfully.';
         $data = [];
        //  $data['present_days'] = (string)$present_days;
        //  $data['leave_taken'] = (string)$leave;
        //  $data['late_entries'] = (string)count($lateEntry);
         $data['attendance_details'] = array_reverse($result);
         
         return Response::json(compact('status', 'msg','data'));
       }else
       {
        $status = "error";
        $msg = 'Data Not Found.';
       }
        $emp_data = EmployeeDetailById($user_id);
        $year_list = getYear($emp_data->join_date);
        $data = [];
        $data['attendance_details'] = [];
        return Response::json(compact('status', 'msg','data'));

    }
    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
      if(empty($end)){
           $array[] = $start;
      }else{
           foreach($period as $date) {                 
            $array[] = $date->format($format); 
        }
      }
    
       return $array;
    }
    public function EditUserProfile(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'user_id' =>'required|numeric',
            'first_name' =>'required',
            'dob'=>'required',
            'email'=>'required',
            'contact_no' =>'required|numeric',
            'gender'=>'required',
            'location' =>'required'
        ]);
         if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id',$user_id)->Where('status',1)->count();

        if ($files = $request->file('image')) 
        {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users/');
            $image->move($destinationPath, $imagename);
                        
            EmployeeModel::where('id', $request->user_id)->update(['image' => $imagename]);
        }
        if($userexist == 0) {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else {
            $updateprofile = EmployeeModel::find($user_id);
            $updateprofile->first_name = $request->first_name;
            $updateprofile->contact_no = $request->contact_no;
            $updateprofile->email = $request->email;
            $updateprofile->dob = $request->dob;
            $updateprofile->gender = $request->gender;
            $updateprofile->address = $request->location;
            $updateprofile->save();

            $userdata = EmployeeModel::where('id',$user_id)->first();

            $status = 'success';
            $msg = 'Profile updated successfully';
            $data = [
                'user_id' => $userdata->id,
                'first_name' => $userdata->first_name,
                'dob' => dateformat($userdata->dob),
                'contact_no'=> (string)$userdata->contact_no,
                'location'=> $userdata->address,
                'gender' => $userdata->gender,
                'email' => $userdata->email, 
                'image' => asset('uploads/users/'.$userdata->image)              
            ];
            return Response::json(compact('status', 'msg','data'));
        }
    }

    public function ChangePassword(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status','msg'));
        }  
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id',$user_id)->Where('status',1)->first();
        if(empty($userexist)) {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else{
        $old = $request->old_password;
        $password = $request->password;
        if(! Hash::check($old,$userexist->password)) 
        {
                $status =  'error';
                $msg = 'Old Password does not match';
                return Response::json(compact('status', 'msg'));
        }
        else
        {
        $status = "success";
        $msg = "Password Changed Successfully";
        $user_data = EmployeeModel::where('id',$request->id)->first();
        $cpwd = EmployeeModel:: find($user_id);
        $cpwd->password = bcrypt($request->get('new_password'));
        $cpwd->save();
        return Response::json(compact('status','msg'));
        }
    }
    }

        public function UploadProfilePhoto(Request $request)
        {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg,webp'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }

        $employee = EmployeeModel::find($request->user_id);
       
        $files = $employee->image;
        
        $path = 'uploads/users/';
        
        $upload = $this->imageUploadHelper($path,$request->image);

        if($upload['status']) 
        {
            $data = [
                'image' => $upload['image_path']
            ];
            $emp = EmployeeModel::find($request->user_id);
            $emp->image = $upload['image'];
            $emp->save();
            $status = 'success';
            $msg = 'Image Uploaded Successfully';
            return response()->json(compact('status', 'msg', 'data'));
        }
        else 
        {
            $status = 'error';
            $msg = 'Error while Uploading Image';
            $data = (object)[];
            return response()->json(compact('status', 'msg', 'data'));
        }
   }

    private function imageUploadHelper($path,$image)
    {
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imagename);
        $obj = [
            'status' => true,
            'image' => $imagename,
            'image_path' => $this->get_base_host().$path.$imagename
        ];
        return $obj;
    }
    
    public function GetHolidayList(Request $request)
    {
        // $Holiday_Data = HolidayModel::get();
        $Holiday_Data = DB::select('SELECT *  FROM holiday WHERE year(start_date) = '.date('Y').' ORDER BY IF(MONTH(start_date) < MONTH(NOW()), MONTH(start_date) + 12, MONTH(start_date)),
         DAY(start_date)');
        $user_data = array();
        foreach($Holiday_Data as $k1=>$row)
        {
            $user_data[$k1] = new \stdClass();
            $user_data[$k1]->holiday_name = $row->holiday_name;
            $user_data[$k1]->holiday_description =$row->holiday_description?$row->holiday_description:"";
            $user_data[$k1]->start_date = dateformat($row->start_date);
            $user_data[$k1]->end_date = $row->end_date?dateformat($row->end_date):"";
        }
        $status = 'success';
        $msg = 'Get Holiday Data Successfully';
        $data = $user_data;
        return Response::json(compact('status', 'msg','data')); 
    }
    
    public function GetLeaveList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'year' =>'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->where('status','=',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
        // $userdata4 = EmpLeaveModel::select('*')->where('emp_id',$user_id)->whereYear('start_date','=',$request->year)->orderby('id','desc')->get();
        $userdata4 = EmpLeaveModel::select('*')->where('emp_id',$user_id)->orderby('id','desc')->get();
        $user_data = array();
        if(!empty($userdata4)){
        foreach($userdata4 as $k1=>$row)
        {
            if($row->status == 0)
            {
               $d = "Pending";
            }
            elseif($row->status == 1)
            {
                $d = "Accepted"; 
            }
            elseif($row->status == 2)
            {
                $d = "Rejected"; 
            }
            else{
                $d = "Cancelled";
            }
            if($row->end_date == NULL || empty($row->end_date) || strtotime($row->start_date) == strtotime($row->end_date))
            {
                $a = "";
            }
            else
            {
                $a =  dateformat($row->end_date);
            }
            if($row->leavetype == 11)
            {
                $x = $row->leave_days_others; 
            }
            else
            {
                 $x = $row->leavetype; 
            }
            $status_type_cancel = 0;
            
            if(strtotime($row->start_date) >= strtotime(date('Y-m-d')) && !($row->status == 3) && !($row->status == 2))
            {
             $status_type_cancel = 1;
            }
            
            $status_type_edit = 0;
            if(strtotime($row->start_date) >= strtotime(date('Y-m-d')) && !($row->status == 3) && !($row->status == 2))
            {
                $status_type_edit = 1;
            }
            $user_data[$k1] = new \stdClass();
            $user_data[$k1]->leave_id=$row->id;
            $user_data[$k1]->title = $row->title;
            $user_data[$k1]->reason = $row->reason;
            $user_data[$k1]->start_date = dateformat($row->start_date);
            $user_data[$k1]->end_date = $a;
            $user_data[$k1]->leavetype = $x;
            $user_data[$k1]->reply_date = $row->reply_date?dateformat($row->reply_date):"";
            $user_data[$k1]->reply_message =$row->reply_message?$row->reply_message:"";
            $user_data[$k1]->status = $d;
            $user_data[$k1]->is_cancel = (string)$status_type_cancel;
            $user_data[$k1]->is_edit = (string)$status_type_edit;
        }
        }
        else
        {
            $data = "No Data Avaliable";
        }
        }
        $status = 'success';
        $msg = 'Get Leave Data Successfully';
        $data = $user_data;
        return Response::json(compact('status', 'msg','data'));
    }

    public function ApplyLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'title' =>'required',
            'reason' =>'required',
            'start_date' =>'required',
            'leave_type' =>'numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $a = "";
            if($request->leave_type == "11")
            {
                $a = $request->leave_days_others;
            }
            $enddate = date('Y-m-d',strtotime($request->start_date));
            if(!empty($request->end_date)){
                $enddate = date('Y-m-d',strtotime($request->end_date));
            }
            $empleave = new EmpLeaveModel;
            $empleave->emp_id = $user_id;
            $empleave->title = $request->title;
            $empleave->reason = $request->reason;
            $empleave->start_date = date('Y-m-d',strtotime($request->start_date));
            $empleave->end_date = $enddate;
            $empleave->leavetype = $request->leave_type?$request->leave_type:"";
            $empleave->leave_days_others = $a;
            $empleave->save();
            $status = 'true';
            
            //notification
            $notifylist = new NotificationListModel;
            $notifylist->sender_id = $user_id;
            $notifylist->receiver_id = 1;
            $notifylist->notification_type_id = 1;
            $notifylist->table_name = 'leave';
            $notifylist->data_id = $user_id;
            $notifylist->save();
            $status = 'true';
            $emp_details = EmployeeDetailById($user_id);
            $company_details = GetCompanyDetail();
            $end_date = '';
            if(!empty($request->end_date)){
                $end_date = ' to ' . dateformat($request->end_date);
            }
            
            $d = "";
            if($request->leave_type == '11')
            {
               $d = $request->leave_days_others;
            }
            else
            {
                $d = $request->leave_type; 
            }
         
            $date = dateformat($request->start_date) . $end_date ;
            $data = array('full_name'=>$emp_details->full_name,
                            'department_name'=>$emp_details->department_name,
                            'date'=>$date,
                            'duration' => $d,
                            'subject'=>$request->title,
                            'message'=>$request->reason ,
                            );
                  
            $mailData = array(
                        'to' => $company_details->hr_email,
                        'subject' => 'Leave Application',
                        'message' => view('mail.apply_leave',compact('data'))
                    );
                    sendMail($mailData);
            }
            $status = 'success';
            $msg = 'Leave Applied Successfully';
            return Response::json(compact('status', 'msg'));      
    }

    public function GetNotificationList(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        $path = $this->get_base_host();
        if(empty($noti->image))
        {
            $image = '';
        }
        else
        {
            $image = $path.'uploads/'.$noti->image;
        }
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
         $noti = NotificationListModel::select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.image','notification.title','leave_details.id as leave_id','leave_details.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name"))
            ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
            ->leftjoin('employee','employee.id','=','notification_list.sender_id')
            ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
            ->leftjoin('leave_details','leave_details.id','=','notification_list.data_id')->orderBy('notification_list.id','desc')
            ->where('receiver_id','=',$user_id)
             ->orWhere('notification_type','=',1)
             ->orWhere('notification_list.emp_id','LIKE','%'.$user_id.'%')
            ->get();
             
            foreach($noti as $k=>$row)
            { 
                $status = "";
                if($row->leave_status == 1){
                $status = "Approved";
                }
                elseif($row->leave_status == 2){
                $status = "Declined";
                } 
                    if($row->notification_type == 0){ 
                    // $sender_name =   $row->full_name;
                    $receiver_name =   $row->receiver_name;
                    $message = str_replace('[USERNAME]',$row->full_name,$row->not_message);
                    $message = str_replace('[STATUS]',$status,$message);
                    $title = $row->title;
                    $image = $row->image;
                }else if($row->notification_type == 1){ 
                    //  $sender_name = $row->full_name;
                     $receiver_name =   'All';
                     $message = $row->message;
                     $title = $row->notification_type_id;
                     $image = $row->image;
                }else
                {
                    //  $sender_name =   $row->full_name;
                     $receiver_name =   getReceiverName($row->emp_id);
                     $message = $row->message;
                     $title = $row->notification_type_id;
                     $image = $row->image;
                }
                // $noti[$k]->sender_name = $sender_name;
                $noti[$k]->receiver_name = $receiver_name;
                $noti[$k]->message = $message;
                $noti[$k]->title = $title;
                $noti[$k]->image = $image;
                $data['notification_list'] =  $noti;
            }
            $user_data = array();
            if($row->notification_type_id == "1")
            {
                $a = "Leave Application";
            }
            else{
                $a = "Reply Leave";
            }
            foreach($noti as $k1=>$row)
            {
                $user_data[$k1] = new \stdClass();
                $user_data[$k1]->id = $row->id;
                $user_data[$k1]->message = $row->message;
                // $user_data[$k1]->sender_id = $row->sender_name;
                $user_data[$k1]->title = $a;
                $user_data[$k1]->created_at = get_timeago($row->created_at);
                $user_data[$k1]->image = $path.'uploads/users/'.$row->image;
            }
             $status = 'success';
            $msg = 'Get Notification Data Successfully';
            $data['notification_list'] = $user_data;
        }
            return Response::json(compact('status', 'msg','data'));     
    }

    public function GetSalaryList(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'join_year' =>'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $userdata4 = SalaryModel::where('emp_id',$user_id)->whereYear('date','=',$request->join_year)->get();
            $user_data = array();
            foreach($userdata4 as $k1=>$row)
            {
                $user_data[$k1] = new \stdClass();
                $user_data[$k1]->id =$row->id;
                $user_data[$k1]->date = dateformat($row->date);
                $user_data[$k1]->current_leave =$row->cl?$row->cl:"";
                $user_data[$k1]->professional_tax = (string)$row->professional_tax;
                $user_data[$k1]->month_no =date('m', strtotime($row->date)); 
                $user_data[$k1]->month_name =date('F', strtotime($row->date)); 
                $user_data[$k1]->total_amount =$row->total_amount?$row->total_amount:"";
            }
        }
        $status = 'success';
        $msg = 'Get Salary Data Successfully';
        $data = $user_data;
        return Response::json(compact('status', 'msg','data'));    
    }

    public function GetSalaryDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'salary_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;

        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $salary_id = $request->salary_id;
            $userdata = SalaryModel::where('emp_id',$user_id)->where('id','=',$salary_id)->first();
            if(!empty($userdata)){
            $user_data = [
                'salary_id' =>$userdata->id,
                'id' =>$userdata->id,
                'date' => dateformat($userdata->date),
                'month_days' =>$userdata->month_days,
                'working_days' =>$userdata->working_days,
                'leave_without_paid' =>$userdata->lwp,
                'present_leave' =>$userdata->pl,
                'current_leave' =>$userdata->cl,
                'leave_balance' =>$userdata->leave_balance?$userdata->leave_balance:"",
                'present_days' =>$userdata->present_days,
                'payable_days' =>$userdata->payable_days?$userdata->payable_days:"",
                'tota_salary' =>$userdata->tota_salary?$userdata->tota_salary:"",
                'basic_salary' =>$userdata->basic_salary?$userdata->basic_salary:"",
                'conveyance' =>$userdata->conveyance?$userdata->conveyance:"",
                'hra' =>$userdata->HRA?$userdata->HRA:"",
                'special_allowance' =>$userdata->special_allowance?$userdata->special_allowance:"",
                'tada' =>$userdata->TADA?$userdata->TADA:"",
                'professional_tax' =>$userdata->professional_tax,
                'security_deduction' =>$userdata->security_deduction,
                'medical_allowance' =>$userdata->medical_allowance,
                'other_allowance' =>$userdata->other_allowance,
                'provident_fund' =>$userdata->pf,
                'total_deduction' =>$userdata->total_deduction?$userdata->total_deduction:"",
                'total_amount' =>$userdata->total_amount?$userdata->total_amount:""
            ];
            $status = 'success';
            $msg = 'Get Salary Details Successfully';
            $data = $user_data;
        }
        else
        {
            $status = 'error';
            $msg = 'Data Not Found';
            $data = '';
        }
        }
        return Response::json(compact('status', 'msg','data'));
    }

    public function DownloadSalary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'year'=>'required|numeric',
            'month' => 'required|numeric',
            'salary_id' =>'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        if(CheckUserExist($user_id) == 0)
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $data['salary'] = SalaryModel::select('salary.*','employee.id as empId','employee.email','d.department_name','de.designation_name','b.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.first_name','employee.join_date')
            ->whereMonth('date',$request->month)
            ->whereYear('date',$request->year)
            ->leftJoin('employee','salary.emp_id','=','employee.id')
            ->leftJoin('department as d','employee.department_id','=','d.id')
            ->leftJoin('designation as de','employee.designation_id','=','de.id')
            ->leftJoin('employee_bank_detail as b','employee.id','=','b.employee_id')
            ->where('salary.id',$request->salary_id)
            ->first();
            
            if(empty($data['salary'])){
                $status = 'error';
                $msg = 'Data Not Found';
                return Response::json(compact('status','msg'));
            }
            
            $m['pdfname'] = $data['salary']->first_name.'_'.date('F-Y',strtotime($data['salary']->date)).'.pdf';
            $m['email'] = $data['salary']->email;
            $m['name'] = $data['salary']->full_name;
            $m['month'] = date('F-Y',strtotime($data['salary']->date));
            $m['subject'] = 'Salary Slip - '.date('F`Y',strtotime($data['salary']->date));
            
            $pdf = PDF::loadView('admin.salary.salaryslippdf',compact('data'));
            
            $filename = $m['pdfname'];
            $destinationPath = public_path('/pdf/');
            $file = $pdf->output();
            file_put_contents($destinationPath.'salary.pdf',$file);
            
            $path = $destinationPath;
            $file = $path . "/salary.pdf";
            
            Mail::send('mail.salary_slip', compact('m'), function($message) use ($m, $file) {
             $message->to($m['email'], $m['name'])
                     ->subject($m['subject']);
             $message->attach($file,[
               'as' => $m['pdfname'],
               'mime' => 'application/pdf',
            ]);
             $message->from('xyz@gmail.com','Bluepixel');
          });
           $status = 'success';
           $msg = 'Salary Slip Sent To Your E-Mail Please Check';
           return Response::json(compact('status','msg'));
        }
    }

    public function RemoveProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $employee = EmployeeModel::find($request->user_id);
            $currentPhoto = $request->image;    
            $userPhoto = public_path('uploads/users/').$currentPhoto;
            if(file_exists($userPhoto))
            { 
                $employee->image = "";
                $employee->save();
                @unlink($userPhoto); 
            }
            $status = 'success';
            $msg = 'Profile Image Removed Successfully';
            $data =  URL::to('dist/assets/images/user_default.jpg');
        }
         return Response::json(compact('status', 'msg','data'));
    }
    
    public function CancelLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'leave_id' => 'required'
        ]);
        if ($validator->fails()) 
        {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $leave_id = $request->leave_id;

        if(CheckUserExist($user_id) == 0 )
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $data = EmpLeaveModel::find($leave_id);
            $data->status = "3";
            $data->save();

        $notifylist = new NotificationListModel;
        $notifylist->sender_id = $user_id;
        $notifylist->receiver_id = 1;
        $notifylist->notification_type_id = 1;
        $notifylist->table_name = 'leave';
        $notifylist->data_id = $user_id;
        $notifylist->save();
        $status = 'true';
        $emp_details = EmployeeDetailById($user_id);
        $company_details = GetCompanyDetail();
        $end_date = '';
        if(!empty($request->end_date)){
            $end_date = ' to ' . dateformat($request->end_date);
        }
        $d = "";
        if($request->leave_type == '11')
        {
           $d = $request->leave_days_others;
        }
        else
        {
            $d = $request->leave_type; 
        }
     
        $date = dateformat($request->start_date) . $end_date ;
        $data = array('full_name'=>$emp_details->full_name,
                        'department_name'=>$emp_details->department_name,
                        'date'=>$date,
                        );
              
        $mailData = array(
                    'to' => $company_details->hr_email,
                    'subject' => 'Cancel Leave Application',
                    'message' => view('mail.cancel_leave',compact('data'))
                );
                sendMail($mailData);
        }
        $status = 'success';
        $msg = 'Leave Cancel Mail Send Successfully';
        return Response::json(compact('status', 'msg'));

    }
    
    public function App_Version(Request $request)
    {
        $app_version = DB::table('app_version')->select('device_type','version')->where('device_type','=',$request->device_type)->first();
        $data = $app_version;
        if(empty($app_version))
        {
            $status = 'error';
            $msg = 'App Version Not Found';
            return Response::json(compact('status','msg'));
        }else{
            $status = 'success';
            $msg = 'App Version Get Successfully';
            return Response::json(compact('status','msg','data'));
        }
    }
    public function HomePage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'app_version' =>'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;

        $userexist = EmployeeModel::where('id','=',$request->user_id)->Where('status',1)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else{
            $fiscalYr = calculateFiscalYearForDate(date('m'));
            $sFiscalYr = explode(':',$fiscalYr);
        
            $present_days = DB::table('checkin')->where('employee_id',$user_id)->whereMonth('date',date('m'))->whereYear('date',date('Y'))->where('type',1)->count();
           
            //$leave = DB::table('leave')->select('leave.id')->where('emp_id','=',$user_id)->whereMonth('start_date',date('m'))->where('status',1)->count();
            
            $leave = DB::table('leave_details')->select('leave_details.id')->where('emp_id','=',$user_id)->whereMonth('start_date',date('m'))->where('status',1)->where('leave_details.leavetype','!=',11)->sum('leave_details.leavetype');
            
            
            $taken_leave = EmpLeaveModel::where('emp_id',$user_id)->whereMonth('start_date',date('m'))->where('status',1)->get();
                $cMonLeave = 0;
                if(!empty($taken_leave)) {
                    foreach($taken_leave as $c) {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $cMonLeave = $cMonLeave + $leave;
                    }
                }
            $leave =$cMonLeave;
            
             $leave_taken = DB::table('leave_details')->where('start_date','>=',$sFiscalYr[0])->where('start_date','<=',$sFiscalYr[1])->where('emp_id',$user_id)->where('status','=',1)->get();
            $yMonLeave = 0;
            if(!empty($leave_taken)) {
                foreach($leave_taken as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $yMonLeave = $yMonLeave + $leave;
                }
            }
            $total_leave_taken  =  $yMonLeave;
            // $lateEntry = DB::select('SELECT  * FROM checkin WHERE time_in > "10:30" AND type = 1 AND employee_id="'.$user_id.'" AND MONTH(date) = MONTH(CURRENT_DATE())');
            $lateEntry = DB::select('SELECT  * FROM checkin WHERE time_in > "10:30" AND type = 1 AND employee_id="'.$user_id.'" AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())');
            $lat = count($lateEntry);
            $employee_data = DB::table('employee as e')->select(DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'office_pin')->where('e.id',$user_id)->first();
            $app_version = DB::table('app_version')->select('version')->first();
            $date_time = now()->format('l, F jS Y');
            $emp = EmployeeModel::select('*')->where('id','=',$user_id)->first();
          
            // $leave_balance = DB::select('SELECT  leave_balance FROM employee WHERE status =  1 AND id='.$emp->id); 
            //  $leave_balance = DB::select('SELECT  count(leave_balance) as leave_balance FROM employee WHERE status =  1 AND id='.$emp->id); 
           
             $leave_balance = $emp->leave_balance;
       
            // $total_leave_taken = DB::table('leave')->where('emp_id',$emp->id)->count();
            // $start = new DateTime(date('Y').'-04-01');
     
            // $end = new DateTime(date('Y-m-d'));
            // $Months = $end->diff($start); 
            // $howeverManyMonths = (($Months->y) * 12) + ($Months->m) + 1;
            
             $emp_data = DB::table('employee')->select('*')->where('id',$emp->id)->first();
     
         $join_date = dateformat($emp_data->join_date);  /*2/8/2021*/
        
        $join_year = date('Y',strtotime($join_date));
        $join_month = date('m',strtotime($join_date));
        $currentyear = date("Y");
        $privious_year = $currentyear - 1;
        $finance_date = date($privious_year.'-04-01');  //'2021-10-08'   /*1/4/2022*/
        
        
        // $start1 = new DateTime(date('Y-m-d',strtotime($join_date)));
        // $end1 = new DateTime(date('Y-m-d',strtotime(now())));
        // $c_months = $end1->diff($start1);
      $start2 = date_create($join_date);
        $end2 = date_create(now());
        $c_months2 = date_diff($start2, $end2);
        if($c_months2->format('%y') >= 1){
            $from =  $finance_date;
        }else{
            $from =  $join_date;
        }
        
        $start1 = date_create($from);
        $end1 = date_create(now());
        $c_months = date_diff($start1, $end1);
        $cm = $c_months->format('%m') + 1;
     
       //  $start1 = new DateTime(date('Y-m-d',strtotime($from)));
        // $end1 = new DateTime(date('Y-m-d',strtotime(now())));
        // $c_months = $end1->diff($start1);
        $m = $cm;
       
   
         if($c_months2->format('%y') >= 1){
            $m =   $cm ;
        }
        
       /* if(strtotime($join_date) < strtotime(date($currentyear.'-04-01')))
        {
             $m = $cm + 1;
            
        }
        else{
           
             $m = $cm ;
        }*/
         $howeverManyMonths = $m;
            $taken_leave = EmpLeaveModel::where('emp_id',$emp->id)->whereMonth('start_date',date('m'))->where('status',1)->get();
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $cMonLeave = $cMonLeave + $leave;
                }
            }
            $leave =$cMonLeave;
            $hrs = $this->hours();
            $msg = "";
            if($hrs >= 4)
            {
                $msg = "Good Morning!"; 
            }
            if($hrs >= 12)
            {
                $msg = "Good Afternoon!"; 
            }
            if($hrs >= 17)
            {
                $msg = "Good Evening!"; 
            }
            if($hrs >= 22)
            {
                $msg = "Good Night!"; 
            }
        }
      
        $data['full_name'] = $employee_data->full_name;
        $data['date'] = $date_time;
        $data['present_days'] = (string)$present_days;
        // $data['taken_leave'] = (string)$leave;
        $data['late_entries'] = (string)$lat;
        $data['greetings_message'] = $msg;
        $data['office_pin'] = $employee_data->office_pin?(string)$employee_data->office_pin:"";
        $data['app_version'] = $app_version->version;
        $data['user_profile'] = getImagePath($emp->image,'users');
        // $data['leave_balance'] = isset($leave_balance[0]->leave_balance)?$leave_balance[0]->leave_balance:"0";
       
        $data['total_leave'] = (string)$howeverManyMonths;
        $data['total_leave_taken'] = (string)$total_leave_taken;
        $data['leave_balance'] = isset($emp->leave_balance)?(string)$emp->leave_balance:"0";
        $data['taken_leave'] = (string)$leave;
        $emp_data = EmployeeDetailById($user_id);
        $year_list = getYear($emp_data->join_date);
        // $year_list = $year_list;
         $y1 = [];
           foreach($year_list as $y)
                  {
                        $y1[] = strval($y);
                  }
         $data['year_list'] = $y1;
        $status = 'success';
        $msg = 'Data Get Successfully';
        return Response::json(compact('status','msg','data'));

    }
    public function hours()
    {
        $now = date('H');
        return $now;
    }
    
    public function Logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'fcm_token' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$request->user_id)->first();
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {    
            $fcm_token = TokenModel::select('id','fcm_Token')->where('user_Id','=',$request->user_id)->first();
            if(!empty($fcm_token))
            {
                $fcm_token = $request->fcm_token;
                $userdata = TokenModel::where('fcm_Token','Like','%'.$fcm_token.'%')->where('user_Id','Like','%'.$user_id.'%')->delete();
            }
           else
           {
                $status = 'error';
                $msg = 'Not Logout';
           }
        }
        $status = 'success';
        $msg = 'Logout Successfully';
        return Response::json(compact('status', 'msg'));
    }
   
    public function SendNotification(Request $request)
    {
        $apiServerKey = 'AAAAla9Oz4M:APA91bEiDEc4B3ORcRdwrcE-M29z2Cry2_NhD2P-IGyqhrBL8fAvHsZewCq_OxiT9zqmI91my5FPnnSnq8saK8nZrnicUBkBrs7zes3ANir4wiwEHmGuvPU7IixU-dg6ig2c2ETuu0fC';
        if($request->device_type == 'android'){
        $aFields = array(
            'to' => "fDS3YDt8QDuMfuObYyEaxq:APA91bFTIAzENpr5p1NsgoYTeK6TxISjHfLIeQVKtXVtn9k9Urtv2D8KCtUXNioEIN3L8IXyuU8dPnH_aVPgFlIWFIOo-ig0SMdKH8aP-t7-nhpJP3JdaxV3_laqpb7GQ3rdbuiJtsxN",
            'priority' => 10,
            'data' => array(
              'sound'=>'Default',
              'title' => 'Message Title',
              'body' => 'This is a message from FCM to web',
              'requireInteraction' => 'true',
                ),
          );
        }else
        {
             $aFields = array(
            'to' => "dBaM0pmp50Q8qzwnHPgHTc:APA91bFoWzeU8k6a80wrORYEitx_hJZ67d4wH90eSZ2Z4HeaG-MW35_DEp6e--CrT04wqXkBvN4cV9O56k2ltFt3MAvY8-cCR2pv3uUrmM2vd0KUclOFho6jlvuBwiy09sf6evVR6Y2d",
            'priority' => 10,
            'notification' => array(
              'sound'=>'Default',
              'title' => 'Message Title',
              'body' => 'This is a message from FCM to web',
              'requireInteraction' => 'true',
                ),
            'data' => array(
               'title' => 'Message Title',
              'body' => 'This is a message from FCM to web',
            )
          );
        }
     
      $aHeaders = array(
        'Authorization:key=' . $apiServerKey,
        'Content-Type:application/json'
      ); 
      $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
      $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL, $fcmUrl); 
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($aFields));
      $result = curl_exec($ch);
      if(!$result)
      {
        throw new Exception(curl_error($ch));
      }
      curl_close($ch);
      echo $result;
    }
    
    public function update_leave(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'leave_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'title' =>'required',
            'reason' =>'required',
            'start_date' =>'required',
            'end_date' =>'',
            'leave_type' =>'numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $leave_id = $request->leave_id;
        $userexist = EmpLeaveModel::where('id','=',$leave_id)->first();
   
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
            $updateleave = EmpLeaveModel::find($leave_id);
            $updateleave->title = $request->title;
            $updateleave->reason = $request->reason;
            $updateleave->start_date = date('Y-m-d',strtotime($request->start_date));
            $updateleave->end_date = isset($request->end_date) ? date('Y-m-d',strtotime($request->end_date)) : "";
            $updateleave->leavetype = $request->leave_type;
            $updateleave->leave_days_others = $request->leave_days_others;
            $updateleave->save();
            $status = 'true';

            $userdata = EmpLeaveModel::where('id',$leave_id)->first();

            $status = 'success';
            $msg = 'Leave Updated Successfully';
            $data = [
                'user_id' => $userdata->emp_id,
                'title' => $userdata->title,
                'reason' => $userdata->reason,
                'start_date'=> date('Y-m-d',strtotime($request->start_date)),
                'end_date'=> date('Y-m-d',strtotime($request->end_date)),
                'leave_type' => $userdata->leavetype,
                'leave_days_others' => $userdata->leave_days_others             
            ];
            $notifylist = new NotificationListModel;
            $notifylist->sender_id = $leave_id;
            $notifylist->receiver_id = 1;
            $notifylist->notification_type_id = 1;
            $notifylist->table_name = 'leave';
            $notifylist->data_id = $updateleave->id;
            $notifylist->save();
            $status = 'success';
            $user_id = $request->user_id;
            $userexist1 = EmpLeaveModel::where('emp_id','=',$user_id)->first();
            $emp_details = EmployeeDetailById($user_id);
            $company_details = GetCompanyDetail();
            $end_date = '';
            if(!empty($request->end_date)){
                $end_date = ' to ' . dateformat($request->end_date);
            }
            $d = "";
            if($request->leave_type == '11')
            {
               $d = $request->leave_days_others;
            }
            else
            {
                $d = $request->leave_type; 
            }
         
            $date = dateformat($request->start_date) . $end_date ;
            $data = array(
                            'full_name'=>$emp_details->full_name,
                            'department_name'=>$emp_details->department_name,
                            'date'=>$date,
                            'duration' => $d,
                            'subject'=>$request->title,
                            'message'=>$request->reason ,
                            );
                  
            $mailData = array(
                        'to' => $company_details->hr_email,
                        'subject' => 'Leave Application',
                        'message' => view('mail.apply_leave',compact('data'))
                    );
                 
                    sendMail($mailData);
        }
            return Response::json(compact('status', 'msg','data'));
    }
    
        public function YearList(Request $request)
        {
             $validator = Validator::make($request->all(), [
                  'user_id' => 'required|numeric'
                 ]);
           
            if ($validator->fails()) 
        {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
       
        if(CheckUserExist($user_id) == 0 )
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else
        {
             $userdata1 = EmployeeModel::select('employee.*')->where('employee.id',$user_id)->first();
            $join_date = $userdata1->join_date;
          $year =  getYear($join_date);
          $y1 = [];
           foreach($year as $y)
                  {
                        $y1[] = strval($y);
                  }
        //  $year = []; 
        //     if(!empty($date))
        //     {
        //         $from = date('Y',strtotime($date));
        //           foreach(range($from, date('Y')) as $y)
        //           {
        //                 $year[] = $y;
        //           }
        //     }
        //     else
        //     {
        //         $year[] = date('Y');
        //     } 
        }
        $data = [];
        $status = 'success';
        $msg = 'Get Year List Successfully';
      
        $data['year_list'] = $y1;
        return Response::json(compact('status', 'msg','data'));
        }
        
        public function DeleteAccount(Request $request)
        {
            $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
            ]);
        if($validator->fails()) {
            $error = $validator->errors()->first();
            $status = 'error';
            $msg = $error;
            return Response::json(compact('status', 'msg'));
        }
        $user_id = $request->user_id;
        $userexist = EmployeeModel::where('id','=',$user_id)->first();
   
        if(empty($userexist))
        {
            $status = 'error';
            $msg = 'User does not exist';
            return Response::json(compact('status','msg'));
        }
        else{
            $user_data = EmployeeModel::find($request->user_id);
            $user_data->status = "2";
            $user_data->save();
            
        }
        $status = 'success';
        $msg = 'Account Deactive Successfully';
        return Response::json(compact('status', 'msg'));
        }
        
        public function CreateAccount(Request $request)
        {
            $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' =>'required',
            'mobile_no' =>'required',
            'password'=>'required'
            
            ]);
            $userexist = EmployeeModel::select('email')->where('email','=',$request->email)->count();
            
            if($userexist > 0)
            {
                $status = 'error';
                $msg = 'Email Already Exist';
                return Response::json(compact('status', 'msg'));
            }
            else
            {
                $data = new EmployeeModel;
                $data->first_name = $request->firstname;
                $data->last_name = $request->lastname;
                $data->email = $request->email;
                $data->contact_no = $request->mobile_no;
                $data->password = Hash::make($request->password);
                $data->organization_name = $request->organization_name;
                $data->office_email = $request->firstname."@gmail.com";
                $data->address = "1203, Elite Business Park, Opp. Shapath Hexa,\r\nNr. Kargil cross road, Sola, Ahmedabad - 380060, Gujarat";
                $data->gender = "Male";
                $data->dob = date('Y-m-d',strtotime('-20 Years'));
                $data->department_id = "6";
                $data->designation_id = "1";
                $data->user_type = "user";
                $data->join_date = date(now());
                $data->experience = "1";
                $data->currentCTC = "10000";
                $data->previousCTC = "10000";
                $data->term = "1";
                $data->bond_duration = "" ;
                $data->bond_start = date(now());
                $data->bond_end = date(now()) ;
                $data->deduction_amt = "";
                $data->document_info = "";
                $data->leave_balance = "";
                $data->office_pin = "0000";
                $data->status = 0;
               // $data->save();
                $name = $request->firstname.' '.$request->lastname;
                
                $employee_data = [
                'user_id' => "0",
                'email' => $request->email,
                'full_name' => $name,
                'profile' => ''
               ];
                $status = 'success';
                $msg = 'You Are Not Authrised Person To Register';
                return Response::json(compact('status', 'msg','employee_data'));
            }
            
        }
}
 
