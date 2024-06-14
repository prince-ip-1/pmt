<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Checkin;
use App\Models\EmployeeModel;
use App\Models\EmpLeaveModel;
use App\Models\SalaryModel;
use App\Models\CandidateModel;
use App\Models\BankDetail;
use App\Models\DBBackup;
use App\Models\Feedback;
use Carbon\Carbon;
use URL;
use Session;
use Hash;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\SendPushNotification;
use Notification;
use Mail;
use stdClass;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class CommonController extends Controller
{
    public function test(){
        
        /*$apiServerKey = 'AAAATP-YSa4:APA91bGr0Ez0RHVytQNn-nVVeNQ32yF_yasPizMK6qLXqt895PMu91eq0jMdY9iUZvB5tZ4341ZHbsF-vBVzZtWrrHuP_nHrksZJAjnon2EqB-Gk58k77B7uOKQ8tpHFMQh0yYHSkx7w';
            
            $fields = array(
	          'token' => 'dl7JnZxGRAOysfzkv2CNez:APA91bFOG7yDomUtcNZ8LQUVTdV1FoqNt3a-ns9sUHRVMu7Uy0NfDX4bEwzJBs8v_Kuo5gv9iLWbDhoF6HJwuGpYrxel7iAP-kk70VUMjmLu5r7EVqSzFqyT167PAhN-y09P5z46AOzt',
	          'priority' => 10,
	          'data' => array(
	                'sound'=>'Default',
	                'title' => 'Test FCM',
	                'body' => 'Test',
	                'requireInteraction' => 'true'
	          ),
	          'notification' => array(
	                'sound'=>'Default',
	                'title' => 'Test FCM',
	                'body' => 'Test',
	                'requireInteraction' => 'true'
	          )
	        );
	        
          $aFields = (array) $fields;
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
          
          if(!$result){
            throw new Exception(curl_error($ch));
          }
          curl_close($ch);
          echo "<pre>";print_r($result);*/
        
    }
    public function updateFcm(Request $request)
   {
       $session = session('user_data');
       $update = EmployeeModel::where('id',$session->id)->update(['fcm_token'=>$request->token]);
       
       $res = ['success'=>true];
       return $res;
   }
   
   public function notification(Request $request){
        
        $fcmTokens = array('c_iU1LCSdKvMuDTwWU5wQl:APA91bF2V1rjuaL8iyN_5kJtjYcvMymF2V_MaGFYTOstsmoDC68ecpUg7_EC69A1VuSuT1rK0E07L67NYf7c8DJJBBwN1II62ccnUyjKVdNCNwv-jVPLGudBf6jqkfG7VpleFVpvu97C');

            $a = Larafirebase::withTitle('Testing Push')
                ->withBody('This is a notification for testing purpose')
                ->sendMessage($fcmTokens);
    }
    
   public function delete(Request $request)
    { 
        $id=$request->id;

        switch ($request->table) {
            case 'mobile':
                $com = DB::table('system_information')->where('id',$id)->delete();
            break;
           
            case 'laptop':
                $com = DB::table('system_information')->where('id',$id)->delete();
            break;
             case 'reply':
                $com = DB::table('leave')->where('id',$id)->delete();
            break;
            case 'db_backup':
                $result = DB::table('db_backup')->where('id',$id)->first();
               
                if(file_exists(getcwd().'/database_backup/' . $result->db_name)){
                    unlink(getcwd().'/database_backup/' . $result->db_name);
                }
                $com = DB::table('db_backup')->where('id',$id)->delete();
            break;
            default:
               $com = DB::table($request->table)->where('id',$id)->delete();
                break;
        }
        // $com = DB::table($request->table)->where('id',$request->id)->delete();
        if($com){
            $data = $com;
            $status = 'true';
            $message = 'Data Deleted successfully.';
        }else{
            $data = "";
              $status = 'false';
             $message = 'Data not found.';
        }
        return Response()->json(compact('com','status','message'));
    }
    public function changeStatus(Request $request){
        $candidate = CandidateModel :: find($request->candidate_id);
        $type=$request->type;
        $table = $request->table;
        $id=$request->id;
        $usersession = Session('user_data');
        $user_id = $usersession->id;
         if ($type == 1 && $table != 'candidate'){
                $update_status = 0;
               }
            else if($type == 0 && $table != 'candidate'){
                $update_status = 1;
            }
             else if ($type == 1 && $table == 'candidate'){
                $update_status = 1;
                $candidate_details = CandidateDetailsById($id);
                       
                $company_details = GetCompanyDetail();
                $hr_details = GetHRDetailsById($user_id);
               
                $data = array('full_name'=>$candidate_details->fullname,
                'technology'=>$candidate_details->position,
               
                'name'=>$hr_details->full_name,
                'designation'=>$hr_details->designation_name,
                );
                
                   $mailData = array(
                    'to' => $candidate_details->email_id,
                    'subject' => 'Interview with' .$company_details->company_name. 'for' .$candidate_details->position,
                    'message' => view('mail.interview_selected',compact('data'))
                );
               
                 $a = sendMail($mailData);
               }
            else if($type == 0  && $table == 'candidate'){
                $update_status = 0;
            }
            
            else if($type == 2){
                $update_status = 2;
            }
            else if($type == 3){
                $update_status = 3;
            }
            else if($type == 5){
                $update_status = 5;
            }
            else if($type == 6){
                $update_status = 6;
            }
            else if($type == 7){
                $update_status = 7;
            }
            else if($type == 9){
                $update_status = 9;
            }
            else if($type == 10){
                 $update_status = 10;
            }
             else if($type == 11){
                 $update_status = 11;
            }
            
        switch ($request->table) {
            case 'mobile':
             case 'laptop':
                 $updatecategory = DB::table('system_information')->where('id',$id)->update([
        'status'=>$update_status,
        ]);
            break;
           default:
               $updatecategory = DB::table($request->table)->where('id',$id)->update([
        'status'=>$update_status,
        ]);
                break;
        }
       
       
        $data['status'] =  $update_status;
        echo json_encode(['status'=>'true','data'=>$data]);die;
    }
    
    public function employeeChangeStatus(Request $request)
        {
            $update_status = "";
            $candidate = CandidateModel::find($request->candidate_id);
            $type=$request->type;
      
            $table = $request->table;
            $id=$request->id;
             DB::table($request->table)->where('id',$id)->update([
            'emp_status'=>$type,
            ]);
            $data['status'] = $type;
            echo json_encode(['status'=>'true','data'=>$data]);
            
        }
    public function getDataById(Request $request){
        $id=$request->id;
        
        switch ($request->table) {
            case 'mobile':
                $getData = DB::table('system_information')->where('id',$id)->first();
            break;
           
            case 'laptop':
                $getData = DB::table('system_information')->where('id',$id)->first();
            break;
           default:
               $getData = DB::table($request->table)->where('id',$id)->first();
                break;
        }
        if($getData){
            $status = 'true';
            $message = 'data fetch successfully.';
            $data = $getData;
        }else{
             $status = 'false';
             $message = 'Data Not Found.';
             $data = '';
        }
        echo json_encode(['status'=>$status,'message'=>$message,'data'=>$data]);die;
    }
    
    
    
    
    public function changepassword()
    {
        $data['title']='Change Password';
        $data['sub_title']='';
        $data['sidebar']='Change Password';

        return view('employee.change-password',compact('data'));
    }
     public function change_password(Request $request)
    {
        // $user_data = $Session(data);
         $session = session('user_data');
         // print_r($session);
         $id = $session->id;
         $checkUserExist = EmployeeModel::where('id',$id)->first();
        $old = $request->oldpassword;
        $password = $checkUserExist->password;
       
        if(! Hash::check($old,$password)) {
                $status =  'false';
                $message = 'Old password is not correct.';
                return response()->json(compact('status', 'message'));
        }
        else{ 
        $status = "true";
        $message = "Password Changed Successfully";
        $cpwd = EmployeeModel:: find($id);
        $cpwd->password = Hash::make($request->pass);
        $cpwd->save();

        return response()->json(compact('status','message'));
    }
}



    public function employeedetail(){
        
        $userdata = Session('user_data');
        $id = $userdata->id;
        
        $data['title']='My Profile';
        $data['sub_title']= '';
        $data['sidebar'] = "";
        $data['sub_title_url']= 'admin/employees_list';
         
        $data['employee_details'] = EmployeeDetailById($id);
        $data['leave']= EmpLeaveModel::select('leave_details.*','employee.first_name')->leftjoin('employee','leave_details.emp_id','=','employee.id')->where('employee.id',$id)->orderBy('id','DESC')->get();
        
        $data['salary'] = SalaryModel::where('emp_id',$id)->whereYear('date',date('Y'))->where('status',1)->orderBy('id','DESC')->get();
        if(getDepartment() == 1 || session('user_type') == 'admin'){
            $data['salary'] = SalaryModel::where('emp_id',$id)->whereYear('created_at',date('Y'))->get();
        }
        
        $data['bankDetail'] = BankDetail::where('employee_id',$id)->first();
        
        $data['year'] = getYear($data['employee_details']->join_date);
       
        $attendance= Checkin::where([
                                ['employee_id','=',$id],
                                ['type','=',1],
                            ])->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', date('Y'))
                            ->get();
                            
        $data['attendance_list'] = array();                
        $data['month_number'] = date('t');
        $data['month'] = date('m');
        $data['y'] = date('Y');
        for($i = 1; $i <=  date('d'); $i++)
        {
            $dates_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.date('m').'-'.$data['y'];
        }
        
        $result = array();
        foreach($dates_array as $k1=>$row){
            $result[$k1] = new \stdClass();
            $result[$k1]->date = $row;
            $result[$k1]->id = "";
            $result[$k1]->checkin = "";
            $result[$k1]->checkout = "";
            $result[$k1]->breaktime = "";
            $result[$k1]->duration = "";
            $result[$k1]->remainTime = "";
            $result[$k1]->address = "";
            $checkWkend = Carbon::parse($row);
            if($checkWkend->isWeekend()) {
              continue;
            }
            
            foreach($attendance as $k2=>$row2){ 
               $date2 = date('Y-m-d',strtotime($row));
                if($date2 == $row2->date){ 
                     $break = Checkin::getBreakTime($date2,$id);
                    $result[$k1]->date = $row;
                    $result[$k1]->id = $row2->id;
                    $result[$k1]->checkin = $row2->time_in;
                    $result[$k1]->checkout = $row2->time_out;
                    $result[$k1]->breaktime = $break;
                    $duration = getHourDuration($row2->time_in,$row2->time_out); 
                    $working_hours = GetWorkingHoures($break,$duration['duration']); 
                    //$result[$k1]->duration = $duration['duration'];
                    $result[$k1]->duration = $working_hours;
                    $result[$k1]->remainTime = $duration['remainTime'];
                    if(!empty($row2->address)){
                    $result[$k1]->address = $row2->address;
                    }
                }
            }
        }
        
        $checkinEntry = DB::table('checkin')->select(DB::raw('count(id) as presentDays'),DB::raw('SUM( case when time_in > "10:30" then 1 else 0 end ) as lateEntries'))->where('employee_id',$id)->whereMonth('date',date('m'))->whereYear('date',date('Y'))->where('type',1)->first();
        
        $taken_leave = EmpLeaveModel::where('emp_id',$id)->whereYear('start_date',date('y'))->whereMonth('start_date',date('m'))->where('status',1)->get();
       
        $cMonLeave = 0;
        if(!empty($taken_leave)) {
            foreach($taken_leave as $c) {
                $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                $cMonLeave = $cMonLeave + $leave;
            }
        }
        $taken_leave =$cMonLeave;
         
        $data['present_days'] = $checkinEntry->presentDays;
        $data['taken_leave'] = $taken_leave;
        $data['late_entry'] = $checkinEntry->lateEntries;
         
        $data['date_list'] = array_reverse($result);
       
        return view('admin.employee.employee_details',compact('data'));
    
    }
     public function imageUpload(Request $request){
        //p($_REQUEST);
         if(!empty($request->image)){
            $base64 = $request->image;
             $data = explode(',', $base64);
             $file = base64_decode($data[1]);
             $folderName = '/uploads/users/';
             $image_name = $request->id.'_'.time().'.'.'png';
             $destinationPath = public_path() . $folderName;
             file_put_contents($destinationPath.$image_name, $file);
            /* if(!empty($request->old_image)){
             unlink($destinationPath.$request->old_image);

             }*/
             if(!empty($request->id)){
                $employee = EmployeeModel::find($request->id);
                $employee->image = $image_name;
                 $employee->save();
            }
            $status = "true";
            $message = 'Image Update Successfully.';
            $data = $image_name;
        }else{
             $status = "false";
            $message = 'Image Not Uploaded.';
            $data="";
         
             }
            return response()->json(compact('status','message','data'));
        
    }
    public function removeimage(Request $request)
    {
        $currentPhoto = $request->image;
        $data = Session('user_data');
        $employee = EmployeeModel::find($data->id);
        if($request->image == $employee->image)
        {  
            $userPhoto = public_path('uploads/users/').$currentPhoto;
            if(file_exists($userPhoto))
            { 
                $employee->image = "";
                $employee->save();
                @unlink($userPhoto); 
            }
            $status = "true";
            $message = 'Image Deleted Successfully.';
            $data = URL::to('dist/assets/images/user_default.jpg');
        }else{
                $status = "false";
                $message = 'Image Not Deleted.';
                $data = '';
             }
        return response()->json(compact('message','status','data'));
    }
     public function database_backup1(){
         $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
        $tables             = array("employee"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $tables = array_column($result, 'Tables_in_pmt');

        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }
        $file_name = 'database_backup_on_' . date('y-m-d H_i_s') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           p($file_name);
           unlink($file_name);
       
    }
    public function database_backup(){ 
        $data = [];
        $data['title'] = 'Database Backup';
        $data['sub_title'] = "";
        $data['sub_title_url'] = "";
        $data['sidebar'] = 'Database Backup';
        $data['db_backup'] = DBBackup::OrderBy('id','DESC')->get();
        $data['sub_title_url'] = '';
        return view('admin.database_backup',compact('data'));
    }
    public function generate_backup2(){
     
            $dbhost = '127.0.0.1';
            $dbuser = 'bluepkvq_admin';
            $dbpass = 'VDd{7Q=;pGz4';
            $dbname = 'bluepkvq_pmt';
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    $backupAlert = '';
    $tables = array();
    $result = mysqli_query($connection, "SHOW TABLES"); 
    if (!$result) {
        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
    } else {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        mysqli_free_result($result);
        
        $return = '';
       
        foreach ($tables as $table) { 
            if($table != 'leave'){
              $result = mysqli_query($connection, "SELECT * FROM " . $table);
             
            if (!$result) {
                $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
            } else {
                $num_fields = mysqli_num_fields($result); 
                if (!$num_fields) {
                    $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                } else {
                    $return .= 'DROP TABLE ' . $table . ';';
                    $row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE ' . $table));
                        if (!$row2) {
                        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                    } else {
                        $return .= "\n\n" . $row2[1] . ";\n\n";
                        for ($i = 0; $i < $num_fields; $i++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                                for ($j = 0; $j < $num_fields; $j++) {
                                    $row[$j] = addslashes($row[$j]);
                                    if (isset($row[$j])) {
                                        $return .= '"' . $row[$j] . '"';
                                    } else {
                                        $return .= '""';
                                    }
                                    if ($j < $num_fields - 1) {
                                        $return .= ',';
                                    }
                                }
                                $return .= ");\n";
                            }
                        }
                        $return .= "\n\n\n";

                    }
                    //echo getcwd(); die();
                    $backuppath = getcwd().'/public/database_backup';
                    
                    $backup_file = $dbname. '_' . date("Y-m-d_H:i:s") . '.sql';
                    $handle = fopen("{$backuppath}/{$backup_file}", 'w+');
                    //echo "<pre>"; print_r($handle); die();
                    fwrite($handle, $return);
                    fclose($handle);
                    $backupAlert = 'Succesfully got the backup!';
                    //echo $backupAlert.'<br>';     
                }
            }
        }
    }
                $dbData = new DBBackup;
                $dbData->db_name = $backup_file;
                 $dbData->save();
      return redirect('admin/database_backup');
    }
   
     }
     public function generate_backup(){
     
            $dbhost = '127.0.0.1';
            $dbuser = 'bluepkvq_admin';
            $dbpass = 'VDd{7Q=;pGz4';
            $dbname = 'bluepkvq_pmt';
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    $backupAlert = '';
    $tables = array();
    $result = mysqli_query($connection, "SHOW TABLES"); 
    if (!$result) {
        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
    } else {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        mysqli_free_result($result);
        
        $return = '';
       
        foreach ($tables as $table) { 
            if($table != 'leave'){
              $result = mysqli_query($connection, "SELECT * FROM " . $table);
             
            if (!$result) {
                $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
            } else {
                $num_fields = mysqli_num_fields($result); 
                if (!$num_fields) {
                    $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                } else {
                    //$return .= 'DROP TABLE ' . $table . ';';
                    $row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE ' . $table));
                        if (!$row2) {
                        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                    } else {
                        $return .= "\n\n" . $row2[1] . ";\n\n";
                        for ($i = 0; $i < $num_fields; $i++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                                for ($j = 0; $j < $num_fields; $j++) {
                                    $row[$j] = addslashes($row[$j]);
                                    if (isset($row[$j])) {
                                        $return .= '"' . $row[$j] . '"';
                                    } else {
                                        $return .= '""';
                                    }
                                    if ($j < $num_fields - 1) {
                                        $return .= ',';
                                    }
                                }
                                $return .= ");\n";
                            }
                        }
                        $return .= "\n\n\n";

                    }
                    //echo getcwd(); die();
                    //echo "<pre>"; print_r($handle); die();
                    $zip = new ZipArchive();
                    $zipFileName = $dbname . '_' . date("Y-m-d") . '.zip'; // Define the ZIP file name
                   // p(getcwd().'/public/database_backup/' . $zipFileName);
                    if ($zip->open(getcwd().'/public/database_backup/' . $zipFileName, ZipArchive::CREATE) === true) {
                        $backuppath = getcwd().'/public/database_backup';
                   
                    $backup_file = $dbname. '_' . date("Y-m-d") . '.sql';
                    $handle = fopen("{$backuppath}/{$backup_file}", 'w+');
                    fwrite($handle, $return);
                    fclose($handle);
                        // Add the SQL backup file to the ZIP archive
                    $zip->addFile("{$backuppath}/{$backup_file}", $backup_file);
                    $zip->close();
                    
                    }

                    
                    $backupAlert = 'Succesfully got the backup!';
                    //echo $backupAlert.'<br>';     
                }
            }
        }
    }
                $dbData = new DBBackup;
                $dbData->db_name = $zipFileName;
                 $dbData->save();
                 $data["body"] = "Database Backup For : ".date('d-m-Y');
            $file = getcwd().'/public/database_backup/' . $zipFileName;
            Mail::send('mail.database_backup', compact('data'), function($message)use($data, $file) {
            $message->to('xyz@gmail.com', 'Bluepixel Technologies LLP')
                            ->subject('Bluepixel Database Backup : '.date('d-m-Y'));
            $message->attach($file);
                  });       
           
      unlink(getcwd().'/public/database_backup/' . $backup_file);
      $sixMonthsAgo = Carbon::now()->subMonths(6);
      $result = DBBackup::where('created_at', '<', $sixMonthsAgo)->get();
     foreach($result as $r){
        
        if(file_exists(getcwd().'/database_backup/' . $r->db_name)){
        unlink(getcwd().'/database_backup/' . $r->db_name);
         }
         $result = DBBackup::where('id',$r->id)->delete();
     }
      return redirect('admin/database_backup');
    }
   
     }

    function sendFcmToken($id){
        $employee2 = EmployeeModel::select('employee.*')->where('id',$id)->first();
        $fcmTokens = $employee2->fcm_token;
         $msg = 'Test Message';
            Larafirebase::withTitle('Task Notification')
                ->withBody($msg)
                ->sendMessage($fcmTokens);
    }
    function Feedback(){

        $data = [];
        $data['title']='Feedback';
        $data['sidebar']='Feedback';
        return view('admin.feedback_form',compact('data'));
    }
    function PostFeedback(Request $request){
        $comment = $request->comment;
        $data = [];
        $data['message'] = $comment;
        $session = session('user_data');
        $feedback = new Feedback();
        $feedback->user_id = Crypt::encryptString($session->id);
        $feedback->description =  Crypt::encryptString($comment);
        $feedback->save();
        $mailData = array(
                    'to' => 'xyz@gmail.com',
                    //'to' => $company_details->hr_email,
                    'subject' => 'Feedback Message',
                    'message' => view('mail.feedback_message',compact('data'))
                );
             
        sendMail($mailData);
        
        $status = 'true';
        $message = 'Message sent successfully!';
       
        
       return Response()->json(compact('status','message'));
       
    }
    function feedbackList(){
        $data = [];
         $session = session('user_data');
         
        $session = session('user_data');
        if($session->department_id != 1){
          return  redirect('employee/dashboard');
        }
        $data['title'] = 'Feedback List';
        $data['sub_title'] = "";
        $data['sub_title_url'] = "";
        $data['sidebar'] = 'Feedback List';
        //$data['feedback'] = 
        $result = Feedback::OrderBy('id','DESC')->get();
        $feedback = [];
        foreach($result as $r){ 
            $feedback['id'] = $r['id'];
            $feedback['user_id'] = Crypt::decryptString($r['user_id']);
            $feedback['description'] = Crypt::decryptString($r['description']);
            $feedback['created_at'] = $r['created_at'];
            $data['feedback'][]  = $feedback;
        }
        
        $data['sub_title_url'] = '';
        return view('admin.feedback_list',compact('data'));
    }

}
