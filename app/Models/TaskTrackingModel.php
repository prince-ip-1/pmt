<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TaskTrackingModel extends Model
{
    use HasFactory;
    protected $table = 'task_tracker';
    protected $fillable =["id","user_id","task_id","start_time","end_time","start_date","end_date","status"];
    
    public static function getTaskTime($start_date,$user_id){
           $attendance= TaskTrackingModel::where([
                            ['start_date','=',$start_date],
                            ['user_id','=',$user_id],
                           ])->get();
           
           
            $sum = strtotime('00:00:00');
 
            $totaltime = 0;
            foreach($attendance as $row){  
                if($row->end_time != NULL){
               $row->end_time = $row->end_time;
                }else{
                    $row->end_time = date('H:i:s');
                }
                $duration = getHourDuration($row->start_time,$row->end_time); 
                $timeinsec = strtotime($duration['duration'])-$sum;
                $totaltime = $totaltime + $timeinsec;
                
            }
            $h = intval($totaltime / 3600);
            
            $totaltime = $totaltime - ($h * 3600);
             
            // Minutes is obtained by dividing
            // remaining total time with 60
            $m = intval($totaltime / 60);
             
            // Remaining value is seconds
            $s = $totaltime - ($m * 60);
          
          if(strlen($h) == 1){
               $h = str_pad($h, 2, '0', STR_PAD_LEFT);
          }
          if(strlen($m) == 1){
              $m = str_pad($m, 2, '0', STR_PAD_LEFT);
          }
          if(strlen($s) == 1){
              $s = str_pad($s, 2, '0', STR_PAD_LEFT);
          }
            
            

            $time = $h.':'.$m.':'.$s; 
      
            return $time;
                       
        }
        public static function getDepartmentTaskTime($postdata){
           
            $startday = $postdata['startday'];
            $finishday = $postdata['finishday'];
            $user_id = $postdata['id'];
            $task_time =  []; 
            $dates = TaskTrackingModel::getBetweenDates($startday, $finishday);
           foreach($dates as $row){
                    $task_time = TaskTrackingModel::getTaskTime($row,$user_id); 
                    $h = date('H',strtotime($task_time));
                    if($h == 0){
                        $task_time = '0';//
                        $tracking_time[] = $task_time;
                    }else{
                        $task_time = date('H:i',strtotime($task_time));
                        $task_time = str_replace(':','.',$task_time);
                        $task_time = str_replace('0','',$task_time);
                        $tracking_time[] =  $task_time;
                    }
                   
                }
                return $tracking_time;
               
        }
        public static function getBetweenDates($startDate, $endDate) {
            $rangArray = [];
         
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);
         
            for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
                $date = date('Y-m-d', $currentDate);
                $rangArray[] = $date;
            }
         
            return $rangArray;
        }
        public static function getDepartmentTaskTimeHours($postdata){
           
            $month_report = $postdata['month_report'];
            $user_id = $postdata['id'];
            $month = date('m',strtotime($month_report));
            $year = date('Y',strtotime($month_report));
            $month_number =Carbon::now()->month($month)->daysInMonth;;
            if(date('m',strtotime(date('Y-m-d'))) == $month && $year == date('Y')){
                $month_number = date('d'); 
            }else{
                $month_number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            }
        
                for($i = 1; $i <=  $month_number; $i++)
                {
                  $date_array[] = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.$month.'-'.$year;
                }
            $task_time =  []; 
           foreach($date_array as $row){
                    $row = date('Y-m-d',strtotime($row));
                    $task_time = TaskTrackingModel::getTaskTime($row,$user_id); 
                    $h = date('H',strtotime($task_time));
                    if($h == 0){
                        $task_time = '0';//
                        $tracking_time[] = $task_time;
                    }else{
                        $task_time = date('H:i',strtotime($task_time));
                        $task_time = str_replace(':','.',$task_time);
                        $task_time = str_replace('0','',$task_time);
                        $tracking_time[] =  $task_time;
                    }
                   
                }
                return $tracking_time;
               
        }
         
}
