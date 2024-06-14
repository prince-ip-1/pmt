<?php
use Carbon\Carbon;
use Carbon\CarbonPeriod;
//use mail;

function dateformat($date)
{   
     if(!empty($date)){
    $date = date('d-m-Y',strtotime($date));
     }
    return $date;
}
function timeformat($time)
{ 
    if(!empty($time)){
    $time = date('H:i:s',strtotime($time));
    }
    return $time;
}
function timeformatto($time)
{ 
    if(!empty($time)){
    $time = date('H:i',strtotime($time));
    }
    return $time;
}
function sum_time($arr) {
    $i = 0;
    foreach ($arr as $a) {
        sscanf($a, '%d:%d', $hour, $min);
        $i += $hour * 60 + $min;
    }
    if ($h = floor($i / 60)) {
        $i %= 60;
    }
    return sprintf('%2d:%2d', $h, $i);
}
function breakDuration($start,$end){
  $e = Carbon::parse($end);
                
  $s = Carbon::parse($start);

  $data['a'] = $s->diff($e)->format('%h:%i');
  $data['b'] = $s->diff($e)->format('%H:%I:%S');
  return $data;
}
function GetCompanyDetail()
{
    $company = DB::table('company_details as c')
    ->select('c.*')
    ->first();
    
    return $company;
}
function GetTable($tablename,$where)
{
		return DB::table($tablename)->where($where)->first();
}
function sendMail($data,$email = '')
{
    if(!empty($email)){
        $header = "From:xyz@gmail.com \r\n".'Reply-To: '.$data['to'].'' . "\r\n";
    }else{
        $header = "From:xyz@gmail.com \r\n";
    }
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($data['to'],$data['subject'],$data['message'],$header);
   
}
function sendMailCandidate($data,$email = '')
{
    if(!empty($email)){
        $header = "From:xyz@gmail.com \r\n".'Reply-To: '.$data['to'].'' . "\r\n";
    }else{
        $header = "From:xyz@gmail.com \r\n";
    }
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($data['to'],$data['subject'],$data['message'],$header);
}
function AdminLogo($type = '')
{
    $folder = "Companyprofile";
    $company = DB::table('company_details as c')
      ->select('c.*')
      ->first();
      $path =  public_path('uploads/'.$folder.'/');
    if($type == 1){
         $image_url =  $path.$company->primary_logo;
            if(!empty($company->primary_logo) && file_exists($image_url)){
            return URL::to('uploads/'.$folder.'/'.$company->primary_logo);
            }else{ 
                return URL::to('dist/assets/images/user_default.jpg');
            }
    }
  
     if($type == 2){
         $image_url =  $path.$company->favicon_logo;
            if(!empty($company->favicon_logo) && file_exists($image_url)){
            return URL::to('uploads/'.$folder.'/'.$company->favicon_logo);
        }
    }
    
}
function getImagePath($image_name,$folder)
{
    $path =  public_path('uploads/'.$folder.'/'.$image_name);
		if(!empty($image_name) && file_exists($path)){
    	return URL::to('uploads/'.$folder.'/'.$image_name);
		}else{
			return URL::to('dist/assets/images/user_default.jpg');
		}
}

function StatusDisplay($type,$message='')
{
	if($type == 2){
	    $html = '<label class="label label-warning">Pending</label>';
	}else
	if($type == 1){
		$html = '<label class="label label-success">Active</label>';
	}else{
		$html = '<label class="label label-warning">Deactive</label>';
	} 
	return $html;
}
function calculateFiscalYearForDate($month)
{
  if($month >= 4)
  {
    $y = date('Y');
    $pt = date('Y', strtotime('+1 year'));
    $fy = $y."-04-01".":".$pt."-03-31";
  }
  else
  {
    $y = date('Y', strtotime('-1 year'));
    $pt = date('Y');
    $fy = $y."-04-01".":".$pt."-03-31";
  }
  return $fy;
}
function EmployeeList($did = "")
{
    if(!empty($did)){
        $employee = DB::table('employee as e')
	->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','e.status')
	->leftjoin('department as d','d.id','=','e.department_id')
	->leftjoin('designation as de','de.id','=','e.designation_id')
	->where('e.user_type','!=','admin')
	->where('d.id','=',$did)
	->where('e.status','=','1')
	->orderby('e.id','desc')
	->get();
    }else{
        $employee = DB::table('employee as e')
	->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','e.status')
	->leftjoin('department as d','d.id','=','e.department_id')
	->leftjoin('designation as de','de.id','=','e.designation_id')
	->where('e.user_type','!=','admin')
	->where('e.status','=','1')
	->orderby('e.id','desc')
	->get();
    }

	
	return $employee;
}
function getDepartmentById($id){
    $data = DB::table('department as d')
    ->select('d.department_name')
    ->where('d.status',1)
    ->where('d.id',$id)->first(); 
    return $data->department_name;
}

function EmployeeDetailById($id)
{
	$employee = DB::table('employee as e')
	->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','join_date','e.*','de.permissions','t.device_Type','t.app_version','de.employee_id as desi_employee_id')
	->leftjoin('department as d','d.id','=','e.department_id')
	->leftjoin('designation as de','de.id','=','e.designation_id')
	->leftjoin('token as t','t.user_id','=','e.id')
	->where('e.status',1)
	->where('e.id',$id)->first(); 

	 if(!empty($employee->desi_employee_id)){
	$emp_ids = json_decode($employee->desi_employee_id);
	if(in_array($id,$emp_ids) && $employee->department_id != 1){
	if(!empty($employee->permissions)){
    	$employee->permissions = json_decode($employee->permissions);
    	 $employee->access = [];
        $module = module_name();
        if(!empty($employee->permissions)){
        foreach($employee->permissions as $k=>$row){ 
                $employee->access[$k] = $row;
        }
        $employee->permissions = $employee->access;
	}
   
    }
	}else{ 
        $employee->permissions = [];
    }
    }
	return $employee;
}

function DeactiveEmployeeDetailById($id)
{
	$employee = DB::table('employee as e')
	->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"),'e.email','d.department_name','de.designation_name','e.image','join_date','e.*','de.permissions','t.device_Type','t.app_version','de.employee_id as desi_employee_id')
	->leftjoin('department as d','d.id','=','e.department_id')
	->leftjoin('designation as de','de.id','=','e.designation_id')
	->leftjoin('token as t','t.user_id','=','e.id')
	//->where('e.status',1)
	->where('e.id',$id)->first(); 

	 if(!empty($employee->desi_employee_id)){
	$emp_ids = json_decode($employee->desi_employee_id);
	if(in_array($id,$emp_ids) && $employee->department_id != 1){
	if(!empty($employee->permissions)){
    	$employee->permissions = json_decode($employee->permissions);
    	 $employee->access = [];
        $module = module_name();
        if(!empty($employee->permissions)){
        foreach($employee->permissions as $k=>$row){ 
                $employee->access[$k] = $row;
        }
        $employee->permissions = $employee->access;
	}
   
    }
	}else{ 
        $employee->permissions = [];
    }
    }
	return $employee;
}

function EmployeeName($id)
{
  $employee = DB::table('employee as e')
  ->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"))
  ->where('e.id',$id)->first();
  return $employee;
}

function StatusDisplayLabel($type,$message='')
{
  if($type == 0){
       $html = '<label class="label label-warning">Pending</label>';
  }else if($type == 1){
    $html = '<label class="label label-success">Accepted</label>';
  }
  else if($type == 3){
    $html = '<label class="label label-inverse">Cancelled</label>';
  }
  else{
    $html = '<label class="label label-danger">Rejected</label>';
  } 
  return $html;
}


function GetTableRowCount($tablename,$where)
{
		return DB::table($tablename)->where($where)->count();
}

function getHourDuration($start_time,$end_time){
	
			$s = Carbon::parse($start_time);
			$e = Carbon::parse($end_time);
      $data['duration'] =  $s->diff($e)->format('%H:%I:%S');

            $timestamp = strtotime($start_time) + 60*60*9;
			$nineHourTime = date('H:i', $timestamp);

			$s1 = Carbon::parse($nineHourTime);
      $data['remainTime'] =  $s1->diff($e)->format('%H:%I:%S');
      return $data;
}

function AttendanceLabel($duration)
{
		$html = "";
	  if(strtotime($duration) > strtotime('08:00:00'))
		 {
        $html = 'FD';                                      
      }elseif(strtotime($duration) > strtotime('04:00:00') && strtotime($duration) < strtotime('08:00:00')){
        $html = 'HD';
     }
      
     return	$html;
      
      
}
function getYear($date)
{
    $year = []; 
    if(!empty($date)){
        $from = date('Y',strtotime($date));
           foreach(range($from, date('Y')) as $y) {
          $year[] = $y;
        }
    }else{
        $year[] = date('Y');
    } 
        return array_reverse($year);
}
function workingDays($date)
{
  $start = Carbon::now()->month(date('m',strtotime($date)))->startOfMonth();
  $end = Carbon::now()->month(date('m',strtotime($date)))->endOfMonth();

  CarbonPeriod::macro('countWeekdays', function () {
      return $this->filter('isWeekday')->count();
  });

  $days = CarbonPeriod::create($start,$end)->countWeekdays();
  return $days;
}
function checkInDetails($id)
{
    
    
    $checkin = DB::table('checkin')
    ->where('date','=',date('Y-m-d'))
    ->where('employee_id','=',$id)
    ->where('type','=',1)->first();
    
    if(!empty($checkin)){
    $duration = getHourDuration($checkin->time_in,$checkin->time_out);
     $result = new stdClass;
    $result->time_in = $checkin->time_in;
    $result->time_out = $checkin->time_out;
    $result->duration = $duration['duration'];
    $result->remainTime = $duration['remainTime'];
    }else{
         $result = new stdClass;
    $result->time_in = 0;
    $result->time_out = 0;
    $result->duration = 0;
    $result->remainTime = 0;
    }
   
    return $result;

}

function GetNotificationList($id){ 
    /*$note = DB::table('notification_list as n')
    ->select('n.*','nl.message','nl.title','l.status as leave_status','e.image')
    ->leftjoin('employee as e','e.id','=','n.sender_id')
    ->leftjoin('notification as nl','nl.id','=','n.notification_type_id')
    ->leftjoin('leave as l','l.id','=','n.data_id')
    ->where('n.receiver_id',$id)->orderby('id','desc')->limit(5)->get();*/
    
     if(getDepartment() == 1){
        $noti =DB::table('notification_list')->select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'leave.id as leave_id','leave.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name,employee.image"))
    ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
    ->leftjoin('employee','employee.id','=','notification_list.sender_id')
    ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
    ->leftjoin('leave','leave.id','=','notification_list.data_id')
    ->where('receiver_id','=',$id)->orderBy('notification_list.id','desc')->limit(5)->get();
    }else{
        $noti =DB::table('notification_list')->select('notification_list.*','notification.title','notification.message as not_message',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'leave.id as leave_id','leave.status as leave_status',DB::raw("CONCAT(e1.first_name,' ',e1.last_name) as receiver_name,employee.image"))
            ->leftjoin('notification','notification.id','=','notification_list.notification_type_id')
            ->leftjoin('employee','employee.id','=','notification_list.sender_id')
            ->leftjoin('employee as e1','e1.id','=','notification_list.receiver_id')
            ->leftjoin('leave','leave.id','=','notification_list.data_id')
            ->orderBy('notification_list.id','desc')
            ->where('receiver_id','=',$id)
            ->orWhere('notification_type','=',1)
            ->orWhere('notification_list.emp_id','LIKE','%'.$id.'%')
            ->limit(5)->get(); 
          
    }
    
    $data = [];
    
    
    foreach($noti as $k=>$row)
    { 
        $status = "";
        if($row->leave_status == 1){
        $status = "Approved";
        }
        elseif($row->leave_status == 2){
        $status = "Declined";
        }  elseif($row->leave_status == 3){
        $status = "Cancelled";
        } 
    

    if($row->notification_type == 0){ 
        $sender_name =   $row->full_name;
        $receiver_name =   $row->receiver_name;
        $message = str_replace('[USERNAME]',$row->full_name,$row->not_message);
        $message = str_replace('[STATUS]',$status,$message);
        $title = $row->title;
    }else if($row->notification_type == 1){ 
         $sender_name =   $row->full_name;
         $receiver_name =   'All';
         $message = $row->message;
          $title = $row->notification_type_id;
    }else if($row->notification_type == 2){ 
         $sender_name =   $row->full_name;
         $receiver_name =   getReceiverName($row->emp_id);
          $message = $row->message;
         $title = $row->notification_type_id;

    }
    $noti[$k]->sender_name = $sender_name;
    $noti[$k]->receiver_name = $receiver_name;
    $noti[$k]->message = $message;
    $noti[$k]->title = $title;
    $data =  $noti;
}

 
    /*foreach($note as $k=>$row){
        $emp = EmployeeDetailById($row->sender_id); 
        $status = "";
        if($row->leave_status == 1){
            $status = "Approved";
        }elseif($row->leave_status == 2){
            $status = "Declined";
        }
        $message = str_replace('[USERNAME]',$emp->full_name,$row->message);
        $message = str_replace('[STATUS]',$status,$message);
           $note[$k]->message = $message; 
           //$note[$k]->time_ago = get_timeago($row->created_date); 
           $data = $note;
    }
   */
    return $data;
}

function get_timeago($datetime){
    
    $time = strtotime($datetime);
    $now = new DateTime;
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
         $result = [];
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
}
}

function date_difference($join_date)
{    
        $current_date = date('Y-m-d');
        $start = new DateTime(date('Y-m-d',strtotime($join_date)));
        $end = new DateTime(date('Y-m-d',strtotime(now())));
        $Months = $end->diff($start);
        $y = $Months->y;
        $m = $Months->m;
        if($y > 0){
        return  $y . 'Year '.$m. ' Months ';
        }    
        else{
             return $m. ' Months ';
        }
    
}
function find_date_difference($date,$type)
{    
        $current_date = date('Y-m-d');
        $start = new DateTime(date('Y-m-d',strtotime($date)));
        $end = new DateTime(date('Y-m-d',strtotime(now())));
        $Months = $end->diff($start);
        $y = $Months->y;
        $m = $Months->m;
        if($type == 'h'){
           $h = $Months->h;  
        }else if($type == 'd'){
            $h = $Months->d;
        }
        return  $h;
       
}
function module_name()
{
    $module = [
        'Department',  // 0 

        'Designation', // 1

        'Employee', // 2

        'Pending Leave', // 3

        'Salary', // 4

        'Holidays', // 5

        'Attendance', // 6

        'Candidate', // 7

        'Clients', // 8

        'System Information', // 9

        'Notification', // 10
        
        'Projects', // 11
        
        'Tasks', // 12
        
        'Bugs', // 13

        'Other Expenses', // 14
        
        'Payout', // 15
         
        'Dashboard', //16
         
        'Analytics',  //17
        
        'Onboard',  //18
        
        'Custom Template',  //19
        
        'Task Board',  //20
        
        'Interview List' //21
        ]; 
    return $module;
}
function getSessionData()
{
    $usersession = Session('user_data');
    $userdata = EmployeeDetailById($usersession->id);
    return $userdata; 
}
function getDepartment(){
    $usersession = Session('user_data');
    return $usersession->department_id; 
}
function getManagerDepartment(){
    $usersession = Session('user_data');
    $id = $usersession->department_id;
    $data = DB::table('department as d')
                ->select('d.dep_category_id')
                ->where('d.id','=',$id)
                ->first();
   
    return $data->dep_category_id; 
}
function getPermission()
{
    $usersession = Session('user_data');
    $userdata = EmployeeDetailById($usersession->id);
    $permission = $userdata->permissions;
    return $permission; 
}
function getReceiverName($emp_ids)
{
    if(!empty($emp_ids)){
         $ids = json_decode($emp_ids); 
         $name = "";
         foreach($ids as $k=>$id){ 
             $employee = DB::table('employee as e')
                ->select('e.id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"))
                ->where('e.id','=',$id)
                ->where('e.status','=',1)
                ->first();
               $name .=   $employee->full_name.',';
             }    
              
    return  rtrim($name,',');
        }
}
function GetWorkingHoures($breakTime,$checkinTime){
           // Declare and define two dates
  $date1 = strtotime($checkinTime);
  $date2 = strtotime($breakTime);
 
  // Formulate the Difference between two dates
  $diff = abs($date2 - $date1);
 
  // To get the year divide the resultant date into
  // total seconds in a year (365*60*60*24)
  $years = floor($diff / (365*60*60*24));
 
  // To get the month, subtract it with years and
  // divide the resultant date into
  // total seconds in a month (30*60*60*24)
  $months = floor(($diff - $years * 365*60*60*24)
                                 / (30*60*60*24));
 
  // To get the day, subtract it with years and
  // months and divide the resultant date into
  // total seconds in a days (60*60*24)
  $days = floor(($diff - $years * 365*60*60*24 -
               $months*30*60*60*24)/ (60*60*24));
 
  // To get the hour, subtract it with years,
  // months & seconds and divide the resultant
  // date into total seconds in a hours (60*60)
  $hours = floor(($diff - $years * 365*60*60*24
         - $months*30*60*60*24 - $days*60*60*24)
                                     / (60*60));
 
  // To get the minutes, subtract it with years,
  // months, seconds and hours and divide the
  // resultant date into total seconds i.e. 60
  $minutes = floor(($diff - $years * 365*60*60*24
           - $months*30*60*60*24 - $days*60*60*24
                            - $hours*60*60)/ 60);
 
  // To get the minutes, subtract it with years,
  // months, seconds, hours and minutes
  $seconds = floor(($diff - $years * 365*60*60*24
           - $months*30*60*60*24 - $days*60*60*24
                  - $hours*60*60 - $minutes*60));
 
  // Print the result
        if(strlen($hours) == 1){
               $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
          }
          if(strlen($minutes) == 1){
              $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
          }
          if(strlen($seconds) == 1){
              $seconds = str_pad($seconds, 2, '0', STR_PAD_LEFT);
          }
            
  return $hours.':'.$minutes.':'.$seconds;
        
}

function GetTechologiesList()
{
    $module = [
        'Android',  // 0 

        'CodeIgniter', // 1

        'Flutter', // 2

        'iOS', // 3

        'Java', // 4

        'Laravel', // 5

        'Node JS', // 6

        'Python', // 7
        
        'UI/UX', // 8
        
        'QA', // 9
        
        'Sales', // 10

        ]; 
    return $module;
}

function GetClientsStatusList()
{
   
    $module = [
        'Active',  // 0 

        'Deactive', // 1

        'Dealing', // 2

        'Hold', // 3

        'InHouse', // 4

        'InProgress', // 5
        
        'Other',//6

        ]; 
    return $module;
}
function getAddress($latitude, $longitude)
{
        //google map api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyBo27sKUtOiRvIa7XzkCzh48QuCRn6ysaw&sensor=false";
        
        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->results[0]->formatted_address;  
        return $address;
}
function getAccountList()
{
    $module = [
            'Nikhil', // 0
            
        ];
        
        return $module;
}
function getPlatformList()
{
    $module = [
            'Email Inquiry', // 0
            
            'Fiver', // 1
            
            'Linkedin', // 2
            
            'Upwork', // 3
            
            'Other'//4
            ];
        
        return $module;
}
function getBid()
{
    $module = [
        'Hourly',//0
        
        'Fixed',//1
        
        'Not Defined', //2
        
        'Other' //3
        ];
    return $module;
}
function getQualificationList()
{
    $module = [
        '12th',//0
        'BCA',//1
        'MCA',//2
        'BTech',//3
        'MTech',//4
        'CE',//5
        'IT',//6
        'Others'//7
        
        ];
    return $module;
}
function getValue($value,$type)
{ 
    if($type == 'Account'){ 
        foreach(getAccountList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   if($type == 'ClientStatus'){ 
        foreach(GetClientsStatusList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   if($type == 'Techologies'){ 
        foreach(GetTechologiesList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
    if($type == 'Platform'){ 
        foreach(getPlatformList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   if($type == 'Bid'){ 
        foreach(getBid() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
     if($type == 'Qualification'){ 
       
        foreach(getQualificationList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
    if($type == 'Task_Status'){ 
       
        foreach(getTaskStatus() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   if($type == 'Candidate'){ 
       
        foreach(GetCandidateStatusList() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   if($type == 'Expense'){ 
       
        foreach(getExpenseCategory() as $key=>$row){
            if($key == $value){
                return $row;
            }
        }
   }
   
}
function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function GetCandidateStatusList()
{
   
    $module = [
        'Pending', //0
        'Selected',  // 1 
        'Rejected', // 2
        'Onhold', // 3
        'Interview Schedule', // 4
        'Not Received',//5
        'Not Reachable',//6
        'Skip',//7
        'Reschedule',//8
        'Offer Declined',//9
        'Not Looking for Job Change',//10
        'Will Call Back'//11
        ]; 
    return $module;
}

function format($date)
{
    $timestamp = strtotime($date);
    $day = date('d-m', $timestamp);
    return $day;
}
function formatTime($time)
    {
       $explode =  explode('.', $time);
       $hours = $explode[0];
       $minutes = isset($explode[1])?$explode[1]:"0";
        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }

function CheckUserExist($user_id)
{
    	$employee = DB::table('employee as e')->where('e.id',$user_id)->where('status','=',1)->count();
    	if($employee > 0){
    	     return 1; 
    	}
    	else{
    	    return 0;
    	}
}
function getExpenseCategory()
{
     $module = [
        'Stationary',//0
        'Decoration',  // 1 
        'Festival', // 2
        'Sanitary', // 3
        'Repairing', // 4
        'Electronic Accessories', //5
        'Gifts', //6
        'Snacks', //7
        'Others', //8
        'Electricity Bill', //9
        'Tea Bill', //10
        'Office Cleaning', //11
        'Water Bill', //12
        'Office Rent', //13
        'Office Maintenance', //14
        'Courier Bill', //15
        'Google Ads', //16
        ]; 
    return $module;
}
function getPaymentType()
{
    $module = [
        'Card',//0
        'Cash',//1
        'Online',//2
        ];
    return $module;
}
function getTaskStatus()
{
    $status = [
        'Backlog',//0
        'To Do',//1
        'In Progress',//2
        'Completed',//3
        'In Testing',//4
        'Ready To Deploy',//5
        
        ];
    return $status;
}
function getEmployeeListData($ids)
{
    $id = json_decode($ids);
    
    $list = [];
    
    if(!empty($id)){
    foreach($id as $row){
        $result = EmployeeDetailById($row);
        if(!empty($result))
        {
            $data['id'] = $result->id;
            $data['full_name'] = $result->full_name;
            $data['image'] = getImagePath($result->image,'users');
            $list[] = $data;
        }
        
        }
    } 
   
    return $list;
    
}
function getPriorityList()
{
    $status = [
        'High',//0
        'Medium',//1
        'Low',//2
        ];
    return $status;
}
function getUserImage()
{
    $usersession = Session('user_data'); 
    $userdata = EmployeeDetailById($usersession->id);
    $image = getImagePath($userdata->image,'users');
    return $image; 
}
function getColorOfProject()
{
    $module = [
        'Red',//0
        'Blue',//1
        'Green',//2
        'Yellow',//3

    ];
    return $module;
}
function getProjectType()
{
    $module = [
        'Hourly',//0
        'Monthly',//1
        'Fixed',//2
    ];
    return $module;
}
function getDuration($start_date,$end_date)
{
    $date1 = $start_date;
$date2 = $end_date;

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

printf("%d Y  %d M  %d D\n", $years, $months, $days);
}
function GetProjectStatusList()
{
    $module = [
        'Active',  // 0 

        'Complete', // 1

        'Deactive', // 2

        'Hold', // 3

        'InHouse', // 4

        'InProgress', // 5
        
        'Sleep',//6
        
        'Cancel',//7
        
        'Other',//8

        ]; 
    return $module;
}
function CandidateDetailsById($id)
{
    $candidate = DB::table('candidate as c')
    ->select('c.id','c.fullname','c.position','c.interview_date','c.email_id','c.subject','c.interview_date_reschedule','c.link','c.employee_id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as employee_name"),'employee.designation_id','employee.id as employee_id','employee.email as employee_email','employee.office_email as employee_office_email')
     ->leftjoin('employee','employee.id','=','c.employee_id')
    ->where('c.id',$id)
    ->first();
    return $candidate;
}
function GetHRDetailsById($id){
    $hr_details = DB::table('employee')->select('employee.id',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.designation_id','de.id','de.designation_name')
    ->leftjoin('designation as de','de.id','=','employee.designation_id')
    ->where('employee.id',$id)
    ->first();
    return $hr_details;
}
function GetEmployeeEmailId($id)
{
    $employee_details = DB::table('employee')->select('employee.id','employee.email',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'candidate.employee_id','candidate.interview_date_reschedule')
    ->leftjoin('candidate','candidate.employee_id','=','employee.id')
    ->where('employee.id',$id)
    ->first();
    return $employee_details;
}
function GetEmployeeCanddiateStatusList()
{
   
    $module = [
        'Pending',//0
        'Confirm',//1
        'Transfer',  // 2
        'Cancel', // 3
        ]; 
    return $module;
}
function ProjectStatus(){
    $module = [
        'Active', //0
        'Compelete',//1
        'Deactive',//2
        'Hold', // 3
        'InProgress', // 4
        'Paid', // 5
        'Sleep', // 6
        ]; 
    return $module;
     
}
function getDeveloperList($ids)
{
    $id = json_decode($ids);
    
    $list = [];
    
    if(!empty($id)){
    foreach($id as $row){
        $result = EmployeeDetailById($row); 
        if(!empty($result) && ($result->department_id != 1))
        //if(!empty($result) && ($result->department_id != 3 && $result->department_id != 1))
        {
            $data['id'] = $result->id;
            $data['full_name'] = $result->full_name;
            //$data['department_id'] = $result->department_id;
            $data['image'] = getImagePath($result->image,'users');
            $list[] = $data;
        }
        
        }
    } 
   
    return $list;
    
}
function getQAList()
{
    $id = EmployeeList();
    
    $list = [];
    
    if(!empty($id)){
    foreach($id as $row){
        $result = EmployeeDetailById($row->id); 
        if(!empty($result) && $result->department_id == 3)
        {
            $data['id'] = $result->id;
            $data['full_name'] = $result->full_name;
            //$data['department_id'] = $result->department_id;
            $data['image'] = getImagePath($result->image,'users');
            $list[] = $data;
        }
        
        }
    } 
   
    return $list;
    
}
?>