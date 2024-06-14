<?php
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkin;
use Session;
use Carbon\Carbon;
use App\Models\TaskTrackingModel;

class CheckinController extends Controller
{
    public function index()

    {

    	$emp = $emp = Session::get('user_data');

    	if(empty($emp)) {

    		return redirect('login');

    	}

    	$data['title']='Punch';

        $data['sub_title']='';
        $data['sidebar'] = "";

    	$data['checkinData'] = Checkin::where([

				    		['date','=',date('Y-m-d')],

				    		['employee_id','=',$emp->id],

				    		['type','=',1]

			    		])->first();

    	$data['duration'] = "-";
    	
    	$data['currentBreakDr'] = "";

    	$data['remainTime'] = "00:00:00";
        $nineHourTime = "00:00:00";
        $start_time = date('H:i:s');
    	if(!empty($data['checkinData'])) {

	    	$start_time = $data['checkinData']->time_in;

			$end_time = date('H:i:s');

			$s = Carbon::parse($start_time);

			$e = Carbon::parse($end_time);

            if($data['checkinData']->time_out == NULL) {

            	$timestamp = strtotime($start_time) + 60*60*9;

				$nineHourTime = date('H:i:s', $timestamp);

				$s1 = Carbon::parse($nineHourTime);

				// $diff_in_hours = $s1->diffInHours($e);

				// echo $diff_in_hours;die;

            	$data['remainTime'] =  $s1->diff($e)->format('%H:%I:%S');
            }
            else  {
                
            	$e = Carbon::parse($data['checkinData']->time_out);
            }

            $data['duration'] =  $s->diff($e)->format('%H:%I:%S');
            
            $checkBr = Checkin::where([

					    		['date','=',date('Y-m-d')],

					    		['employee_id','=',$emp->id],

					    		['type','=',2],

					    		['time_out','=',NULL]

				    		])->first();

            $data['currentBreakDr'] = !empty($checkBr) ? date('m/d/Y') .' ' . date('H:i:s',strtotime($checkBr->time_in)) : "";

		}

    	$data['break'] = Checkin::where('date',date('Y-m-d'))->where('employee_id',$emp->id)->where('type',2)->get();
    	
    	$data['prevBreakHr'] = "";
    	
    	$data['totalBreak'] = "00:00:00";
    	
    	if(!empty($data['break'])) {
    		$dur = [];
    		$viewDur = [];
    		foreach($data['break'] as $v)
    		{
    			if($v->time_out != "") {
                    $s = breakDuration($v->time_in,$v->time_out);

	                $dur[] =  $s['b'];
	                $viewDur[] = $s['b'];
            	}
    		}
    		
    		$data['prevBreakHr'] = sum_time($dur);

    		$i = 0;
		    foreach ($viewDur as $a) {
		        sscanf($a, '%d:%d:%d', $hour, $min, $sec);
		        $i += $hour * 60 + $min;
		    }
		    if ($h = floor($i / 60)) {
		        $i %= 60;
		    }
		    sprintf('%02d:%02d:%02d', $h, $i, 00);
            $break = Checkin::getBreakTime(date('Y-m-d'),$emp->id); 
		    $data['totalBreak'] = $break;
		    $data['prevBreakHr'] = $break;
		     //$data['currentBreakDr'] = $break;

    	}

    	$data['checkBr'] = Checkin::where('date',date('Y-m-d'))->where('employee_id',$emp->id)->where('type',2)->orderBy('id','DESC')->first();

        $data['end_time'] = date('m/d/Y') .' ' . $nineHourTime;
        $remaining_time = strtotime(date('m/d/Y') .' ' . $nineHourTime);
        $current_time = strtotime(date('m/d/Y H:i:s'));
         if(empty($data['checkinData']->time_in)){
			$getTime = date('m/d/Y H:i:s');
		}else{
			$getTime = date('m/d/Y'). ' ' . date('H:i:s',strtotime($data['checkinData']->time_in));
		}
    	if($current_time < $remaining_time){
    		$data['remaining_time'] = date('m/d/Y') .' ' . $nineHourTime;
    		$data['current_time'] = $getTime;
    	}else{
    		$data['current_time'] = $getTime;
    		$data['remaining_time'] = date('m/d/Y H:i:s');
    	} 
    
    	return view('employee.checkin',compact('data'));

    }

    public function storePunch(Request $req)

    {

    	$session = session('user_data');

    	if(empty($session)) {

    		return redirect('login');

    	}

    	if($req->type == "in") {

	    	$check = Checkin::where('employee_id',$session->id)->where('date',date('Y-m-d'))->where('type',1)->count();

	    	if($check == 1) {

	    		$res = [

	    			'status' => false,

	    			'message' => 'You have already checked in'

	    		];

	    		return $res;

	    	}
            
            $latitude = $req->lat;
            $longitude = $req->long;
            $location = [
	    			'lat'=>$latitude,
	    			'long'=>$longitude,
	    			'accuracy'=>$req->accuracy,
	    	];
	    	
            /*$address = "";
            if($latitude != "" && $longitude != "") {
                
                $address = getAddress($latitude,$longitude);
                
            }*/

	    	$add = new Checkin;

	    	$add->employee_id = $session->id;

	    	$add->type = 1;

	    	$add->time_in = date('H:i:s');

	    	$add->date = date('Y-m-d');
	    	
	    	$add->checkin_location = json_encode($location);
	    	
	   // 	$add->address = $address;
	    	
	        $add->device_type = "2";

	    	$add->save();
	    	
	    	$args = [
                'userId' => $session->id,
                'id' => $add->id, 
                'lat'=> $latitude, 
                'lng' => $longitude
            ];

            \Artisan::call('set:address',['args' => $args]);

	    	$start_time = $add['time_in'];
			$end_time = date('H:i:s');

			$s = Carbon::parse($start_time);
			$e = Carbon::parse($end_time);
            $duration =  $s->diff($e)->format('%H:%I:%S');
            
            $add->date = dateformat($add->date);

	    	$res = [

	    		'status' => true,
	    		'message' => 'Checked in successfully',
	    		'type' => 'in',
	    		'data' => $add,
	    		'duration' => $duration

	    	];
	    	return $res;

    	}

    	elseif ($req->type == "out") {
            $checkTracking = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$session->id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','desc')->get();
            if(count($checkTracking) > 0){
                        $res = ['status' => false,'message' => 'Seems like your tracker is on'];
        	    		return $res;
             }      
    		$updateTimeOut = Checkin::where([

	    		['employee_id','=',$session->id],

	    		['date','=',date('Y-m-d')],

	    		['type','=',1],

	    		['time_out','=',NULL]

	    	])->update(['time_out'=>date('H:i:s')]);

	    	if($updateTimeOut) {

	    		$res = [

		    		'status' => true,
		    		'message' => 'Checked out successfully',
		    		'type' => 'out',
		    		'time_out' => date('H:i:s') 

		    	];

		    	return $res;

	    	} else {

	    		$res = [

		    		'status' => false,

		    		'message' => 'Something went wrong'

		    	];

		    	return $res;

	    	}



    	}

    }



    public function storeBreak(Request $req)

    {

    	$session = session('user_data');

    	if(empty($session)) {

    		return redirect('login');

    	}

    	if($req->type == "bin") {
    	     $checkTracking = TaskTrackingModel::select('*')->where([
                    ['user_id','=',$session->id],
                    ['end_time','=',NULL]
                    ])->orderBy('id','desc')->get();
                   
             if(count($checkTracking) > 0){
                        $res = ['status' => false,'message' => 'Seems like your tracker is on'];
        	    		return $res;
             }  
    	    $checkin = Checkin::where([
	    			['employee_id','=',$session->id],
		    		['date','=',date('Y-m-d')],
		    		['type','=',1]
	    		])->count();

    		if($checkin == 0) {
    			$res = ['status' => false,'message' => 'Please checkin first'];
	    		return $res;
    		}

	    	$check = Checkin::where([

		    		['employee_id','=',$session->id],

		    		['date','=',date('Y-m-d')],

		    		['type','=',2],

		    		['time_out','=',NULL]

	    		])->orderBy('id','DESC')->count();

	    	if($check == 1) {

	    		$res = [

	    			'status' => false,
	    			'message' => 'Please complete previous break'

	    		];

	    		return $res;

	    	}



	    	$add = new Checkin;

	    	$add->employee_id = $session->id;

	    	$add->type = 2;

	    	$add->time_in = date('H:i:s');

	    	$add->date = date('Y-m-d');

	    	$add->save();

            $add->date = dateformat($add->date);

	    	$res = [

	    		'status' => true,
	    		'message' => 'Break in successfully',
	    		'type' => 'in',
	    		'dr' => date('m/d/Y') .' ' . $add->time_in,
	    		'data' => $add

	    	];

	    	return $res;



	    } elseif($req->type == "bout") {

	    	$updateBreak = Checkin::where([

		    		['employee_id','=',$session->id],

		    		['date','=',date('Y-m-d')],

		    		['type','=',2],

		    		['time_out','=',NULL]

		    	])->update(['time_out'=>date('H:i:s')]);



	    	if($updateBreak) {

	    		$res = [

		    		'status' => true,
		    		'message' => 'Break over successfully',
		    		'type' => 'out',
		    		'time_out' => date('H:i:s') 

		    	];

		    	return $res;

	    	} else {

	    		$res = [

		    		'status' => false,

		    		'message' => 'Something went wrong'

		    	];

		    	return $res;

	    	}

	    }

    }
    
     public function addAttendanceManually(Request $request)

    {
    		if(isset($request->id) && !empty($request->id)){
    			$add = Checkin :: find($request->id);
    		}else{
    			$add = new Checkin;
    		}
    		
	    	$add->employee_id = $request->emp_id;

	    	$add->type = 1;

	    	$add->time_in = isset($request->checkin)?date('H:i:s',strtotime($request->checkin)):"";
	    	
	    	$add->time_out = isset($request->checkout)?date('H:i:s',strtotime($request->checkout)):"";
	    	
	    	$add->date = date('Y-m-d',strtotime($request->date));

	    	$add->save();

	    	  $break = Checkin::getBreakTime($add->date,$request->id);
	    	   $duration = getHourDuration(date('H:i:s',strtotime($request->checkin)),date('H:i',strtotime($request->checkout)));
                    $data = array(
                    'date' => $add->date,
                    'checkin' => date('H:i:s',strtotime($request->checkin)),
                    'checkout' => date('H:i:s',strtotime($request->checkout)),
                    'breaktime' => $break,
                    'duration' => $duration['duration'],
                    'remainTime' => $duration['remainTime']
                );
            	
	    	$status =  "true";
	    		$message = 'Data added successfully';
	    		$data = $data;

	    	
	    	return response()->json(compact('status','message','data'));
    }


}

