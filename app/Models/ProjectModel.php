<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $fillable =["id","project_name","project_description","project_client","start_date","end_date","duration","member","status","color","project_manage","technology","jobstatus","emp_id","image","project_type","hour_rate","project_amount"];
}
