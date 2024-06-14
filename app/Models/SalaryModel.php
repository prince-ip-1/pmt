<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryModel extends Model
{
    use HasFactory;
    protected $table = 'salary';
    protected $fillable = ["id","emp_id","date","month_days","working_days","lwp","pl","cl","present_days","basic_salary","professional_tax","security_deduction","medical_allowance","other_allowance","leave_travel_allowance","pf"];
}
