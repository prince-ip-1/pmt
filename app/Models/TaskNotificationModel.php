<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNotificationModel extends Model
{
    use HasFactory;
    protected $table = 'task_notification';
    protected $fillable =["task_id","employee_id","status"];
}
