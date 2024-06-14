<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceNewModel extends Model
{
    use HasFactory;
    protected $table = 'attendance_new';
    protected $fillable =["id","emp_id","present_date"];
}
