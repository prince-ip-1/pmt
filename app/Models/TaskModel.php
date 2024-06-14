<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable =["id","project_id","task_title","task_project_id","is_delete","task_description","assign_to","duration","start_date","end_date","priority","report_to","assign_to_qa","is_notify","status"];
}
