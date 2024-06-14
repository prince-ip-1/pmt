<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\SalaryModel;
use PDF;
use Mail;

class Send extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send salary slip pdf on mail';

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
        $id = $this->argument('id');

        $date = explode('-',$id);
        
        $salary = SalaryModel::select('salary.*','salary.id as sid','employee.id as empId','employee.email','d.department_name','de.designation_name','b.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) as full_name"),'employee.first_name','employee.join_date')
        ->whereMonth('date',$date[1])
        ->whereYear('date',$date[0])
        ->leftJoin('employee','salary.emp_id','=','employee.id')
        ->leftJoin('department as d','employee.department_id','=','d.id')
        ->leftJoin('designation as de','employee.designation_id','=','de.id')
        ->leftJoin('employee_bank_detail as b','employee.id','=','b.employee_id')
        ->get();
        
        foreach($salary as $val)
        {
            $data['salary'] = $val;
            
            $m['pdfname'] = $val->first_name.'_'.date('F-Y',strtotime($val->date)).'.pdf';

            $m['email'] = $val->email;
            $m['name'] = $val->full_name;
            $m['month'] = date('F-Y',strtotime($val->date));
            $m['subject'] = 'Salary Slip - '.date('F`Y',strtotime($val->date));
            
            $pdf = PDF::loadView('admin.salary.salaryslippdf',compact('data'));
            
            $filename = $m['pdfname'];
            $destinationPath = public_path('/pdf/');
            $file = $pdf->output();
            file_put_contents($destinationPath.'salary.pdf',$file);
            
            $path = $destinationPath;
            $file = $path . "/salary.pdf";
            
            $updateStatus = SalaryModel::whereMonth('date',$date[1])->whereYear('date',$date[0])->where('id',$val->sid)->update(['status'=>1]);
            
            Mail::send('mail.salary_slip', compact('m'), function($message) use ($m, $file) {
             $message->to($m['email'], $m['name'])
                     ->subject($m['subject']);
             $message->attach($file,[
               'as' => $m['pdfname'],
               'mime' => 'application/pdf',
            ]);
             $message->from('xyz@gmail.com','Bluepixel');
          });
          
        }
        
        DB::table('cron_data')->insert(['cron_name'=>'SendSalaryslip','table_name'=>'salary','data_id'=>'0','information'=>'Sent']);
    }
}
