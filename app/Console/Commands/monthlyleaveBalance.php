<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\EmployeeModel;
use App\Models\EmpLeaveModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class monthlyleaveBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leavebalance:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Employee leave balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = EmployeeModel::select('id',DB::raw("CONCAT(first_name,' ',last_name) as full_name"),'term','bond_duration','bond_start','bond_end','deduction_amt','leave_balance','currentCTC','join_date')->where('user_type','user')->where('currentCTC','!=',NULL)->where('status',1)->get();

        $month = Carbon::now()->subMonth();
        $m = date('m',strtotime($month));
        $y = date('Y',strtotime($month));
        foreach($employees as $val)
        {
            $taken_leave = EmpLeaveModel::where('emp_id',$val->id)->where('status',1)
                           ->where(function ($query) use ($m) {
                                $query->whereMonth('start_date',$m)->orWhereMonth('end_date',$m);
                           })
                           ->where(function ($query) use ($y) {
                                $query->whereYear('start_date',$y)->orWhereYear('end_date',$y);
                           })->get();
            // $taken_leave = EmpLeaveModel::where('emp_id',$val->id)->whereMonth('start_date',$m)->whereYear('start_date',$y)->where('status',1)->get();
            //EmpLeaveModel::where('emp_id',$val->id)->whereMonth('start_date',$m)->where('status',1)->get();
            $cMonLeave = 0;
            if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $floatVal = floatval($c->leavetype);
                    if($floatVal && intval($floatVal) != $floatVal) {
                        $cMonLeave = $cMonLeave +  $c->leavetype;
                    }
                    else if($c->end_date != NULL && $c->start_date != $c->end_date) {

                        $period = CarbonPeriod::create($c->start_date, $c->end_date)->toArray();
                        $arr = [];

                        foreach ($period as $pr) {
                            array_push($arr, $pr->format('Y-m-d'));
                        }
                        
                        foreach($arr as $a) {
                            $w = Carbon::parse($a);
                            if(date('m',strtotime($a)) == $m && !$w->isWeekend()) {
                                $cMonLeave = $cMonLeave + 1;
                            }
                        }
                    } else {
                        $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                        $cMonLeave = $cMonLeave + $leave;
                    }
                }
            }
            
            $leave_bal = 0;
            $a = 0;
            if($cMonLeave > 0) {
                if($val->leave_balance > 0) {
                    $leave_bal = (float) $val->leave_balance;
                    $a = abs($val->leave_balance - $cMonLeave);
                } else {
                    $a = $cMonLeave;
                }
            }else{
                $leave_bal = (float) $val->leave_balance;
            }
            
            /*if(!empty($taken_leave)) {
                foreach($taken_leave as $c) {
                    $leave = $c->leavetype == 11 ? $c->leave_days_others : $c->leavetype;
                    $cMonLeave = $cMonLeave + $leave;
                }
            }

            $leave_bal = 0;
            $a = 0;
            if($cMonLeave > 0) {
                if($val->leave_balance > 0) {
                    $leave_bal = (float) $val->leave_balance;
                    $a = abs($val->leave_balance - $cMonLeave);
                } else {
                    $a = $cMonLeave;
                }
            }else{
                $leave_bal = (float) $val->leave_balance;
            }*/

            $calculateLB = $leave_bal - $cMonLeave;

            $currentLB = $calculateLB < 0 ? 0 : $calculateLB;

            $uLeaveBalance = EmployeeModel::where('id',$val->id)->update(['leave_balance'=>$currentLB+1]);

            $array = array('name' => $val->full_name,'empid' => $val->id,'previous_leaveBalance'=>$val->leave_balance, 'leavebalance'=>$currentLB+1);

            DB::table('test')->insert($array);

        }
    }
}