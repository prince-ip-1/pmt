<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasklogsModel extends Model
{
    use HasFactory;
    protected $table = 'task_logs';
    protected $fillable =["id","user_id","task_id","from_status","to_status"];
}
