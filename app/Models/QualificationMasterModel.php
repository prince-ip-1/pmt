<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationMasterModel extends Model
{
    use HasFactory;
    protected $table = 'qualification_master';
    protected $fillable =["id","name"];
}
