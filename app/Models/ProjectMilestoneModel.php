<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestoneModel extends Model
{
    use HasFactory;
     protected $table = 'projectmilestone';
    protected $fillable =["id","projectid","title","start_date","status","end_date","notify"];
}
