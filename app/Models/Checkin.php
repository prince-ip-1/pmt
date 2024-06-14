<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;
    protected $table = 'checkin';
    
     public static function getBreakTime($date,$id){
           $attendance= Checkin::where([
                            ['date','=',$date],
                            ['employee_id','=',$id],
                            ['type','=',2],
                           ])->get();
           
           
            $sum = strtotime('00:00:00');
 
            $totaltime = 0;
            foreach($attendance as $row){  
                if($row->time_out != NULL){
                $duration = getHourDuration($row->time_in,$row->time_out); 
                $timeinsec = strtotime($duration['duration'])-$sum;
                $totaltime = $totaltime + $timeinsec;
                }
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
}