<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpLeaveModel extends Model
{
    use HasFactory;
     protected $table = 'leave_details';
    protected $fillable = ["id","title","start_date","end_date","emp_id","current_date","reason","status","replyreason"];

    
}
