<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Checkin;
use App\Models\Cron;
use App\Models\EmployeeModel;
use App\Models\EmpLeaveModel;
use App\Models\TokenModel;
use App\Models\TaskTrackingModel;
use App\Models\HolidayModel;
use Carbon\Carbon;
use URL;
use Artisan;
use Hash;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Models\DBBackup;

class CronController extends Controller
{
    public function monthlyLeaveUpdate()
    {
        \Artisan::call('leavebalance:cron');
    }
    /*Cron for manual checkout for employees who haven't checked out 
    and for employee who is not present(Not checked in) and haven't applied leave it inserts an automatic leave entry*/  
    public function checkoutManually(){
       
        $date = date('Y-m-d');
        $attendance= Checkin::where([
                            ['date','=',$date],
                            ['type','=',1],
                            //['employee_id','=',17],
                           ])
                           ->whereNull('time_out')
                           ->get();
                        
        $data = array();               
        if(!empty( $attendance)){                   
            foreach($attendance as $k=>$row){
                $start_time = $row->time_in;
    			$end_time = date('H:i:s');
    
                $update = DB::table('checkin')->where('id',$row->id)->update([
                    'time_out'=>$end_time,
                ]);
                
                $data['employee_id'][] = $row->employee_id;
                
                $cronData = new Cron;
                $cronData->cron_name = 'checkoutManually';
                $cronData->table_name = 'Checkin';
                $cronData->data_id = $row->employee_id;
                $cronData->information = 'Checkout done';
                $cronData->save();
                
                /*Start For tracking stop*/
                $time = date('H:i:s');
                $date = date('Y-m-d');
                $checkTracking = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$row->employee_id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','desc')->first();
                    
                if(!empty($checkTracking)){
                    $updateBreak = TaskTrackingModel::where([
                         ['id','=',$checkTracking->id]
                        ])->update(['end_time'=>$time,'end_date'=>$date]);
                }
                /*End For tracking stop*/
              
            }   
           
        }
        $dt = Carbon::now();
        if(!$dt->isWeekend()) {
            $employees = EmployeeModel::where('status',1)->where('user_type','user')->whereNotIn('id',[17,24,12,23,57,74])->get();
            $checkHoliday = HolidayModel::whereDate('start_date','>=',$date)->whereDate('start_date','<=',$date)->orderBy('start_date','ASC')->count();
            
            if($checkHoliday == 0){
                foreach($employees as $emp) {
                    if($emp->last_date != "" && $emp->last_date < $date) {
                      continue;
                    }
                   $checkin = Checkin::where([
                        ['date','=',date('Y-m-d')],
                        ['employee_id','=',$emp->id],
                        ['type','=',1]
                      ])->first();
                      
                  if(empty($checkin)) {
                      
                    $leave = DB::select('SELECT * FROM `leave_details` WHERE emp_id = ? and (start_date = ? OR end_date = ? OR ? BETWEEN start_date and end_date)',[$emp->id,$date,$date,$date]);
              
                    if(empty($leave)) {
                        $empleave = new EmpLeaveModel;
                        $empleave->emp_id = $emp->id;
                        $empleave->title = 'Automatic Leave Entry';
                        $empleave->reason = 'This is an Automatic Leave generated by the system as employee was not present';
                        $empleave->start_date = $date;
                        $empleave->end_date = NULL;
                        $empleave->leavetype = '1.0';
                        $empleave->leave_days_others = NULL;
                        $empleave->is_automatic = 1;
                        $empleave->status = 1;
                        $empleave->save();
                        
                        $cronData = new Cron;
                        $cronData->cron_name = 'automaticLeave';
                        $cronData->table_name = 'Leave';
                        $cronData->data_id = $emp->id;
                        $cronData->information = 'Leave Added';
                        $cronData->save();
                    }
                  }
                }
            }
        }
        // echo json_encode(['status'=>'true','data'=>$data]);die;
    }
  
    public function generatePin(){
       
         $employee= EmployeeModel::select('id','office_pin','first_name','last_name','email')->where(
                           'status','=',1)
                           ->where(
                           'office_pin','!=',0)
                           ->get();
                       
            $data = array();               
        if(!empty( $employee)){                   
            foreach($employee as $k=>$row){
               $pin = rand(1000,9999);
               $employee[$k]->office_pin = $pin;
                $update = DB::table('employee')->where('id',$row->id)->update([
                'office_pin'=>$pin,
                ]);
                //$attendance[$k]['employee_id']= $row->employee_id;
                 $name = $row->first_name.' '.$row->last_name; 
        $data = array('office_pin'=>$row->office_pin,'name'=>$name); 
        $mailData = array(
            'to' => $row->email,
            'subject' => 'PMT pin generate ',
            'message' => view('mail.sendpin',compact('data'))
        );
        sendMail($mailData);
    
               $data[] = $employee;
           
            }   
          
        } 
        echo json_encode(['status'=>'true','data'=>$data]);die;
    }
    
    public function checkBreakTime() {

      $data = Checkin::select('checkin.*',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"))
              ->leftJoin('employee as e','checkin.employee_id','=','e.id')
              ->where('date',date('Y-m-d'))->where('type',2)->where('time_out','=',NULL)->orderBy('id','DESC')->get();

      foreach($data as $val) {
        
        $duration =  getHourDuration(date('H:i:s'),date('H:i:s',strtotime($val->time_in)));
        if(strtotime($duration['duration']) > strtotime('00:45:00'))
        {
          
          $token = TokenModel::where('user_Id',$val->employee_id)->where('fcm_Token','!=','')->get();

          foreach($token as $t) {

            $aFields = array(
              'to' => $t->fcm_Token,
              'priority' => 10,
              'notification' => array(
                'sound'=>'Default',
                'title' => 'Break Time Out',
                'body' => 'Right now you are in break! Please break out when you reach your time',
                'requireInteraction' => 'true',
              ),
              'data' => array(
                'sound'=>'Default',
                'title' => 'Break Time Out',
                'body' => 'Right now you are in break! Please break out when you reach your time',
                'requireInteraction' => 'true',
              ),
            );
            
              $apiServerKey = 'AAAAla9Oz4M:APA91bEiDEc4B3ORcRdwrcE-M29z2Cry2_NhD2P-IGyqhrBL8fAvHsZewCq_OxiT9zqmI91my5FPnnSnq8saK8nZrnicUBkBrs7zes3ANir4wiwEHmGuvPU7IixU-dg6ig2c2ETuu0fC';
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
          }
        }
      }
    }
    public function generateBackup(){
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
           $cronData = new Cron;
                        $cronData->cron_name = 'GenerateDBBackup';
                        $cronData->table_name = 'db_backup';
                        $cronData->data_id = $dbData->id;
                        $cronData->information = 'Create Backup ' .date('d-m-Y');
                        $cronData->save();
            unlink(getcwd().'/public/database_backup/' . $backup_file);
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            $result = DBBackup::where('created_at', '<', $sixMonthsAgo)->get();
             foreach($result as $r){
                $result = DBBackup::where('id', '<', $r->id)->delete();
                if(file_exists(getcwd().'/database_backup/' . $r->db_name)){
                unlink(getcwd().'/database_backup/' . $r->db_name);
                 }
             }  
            }
            return true;
    }
}