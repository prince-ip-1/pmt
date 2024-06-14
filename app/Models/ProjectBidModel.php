<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBidModel extends Model
{
    use HasFactory;
    protected $table = 'project_bid_type';
    protected $fillable = ["id","name","status"];
}
