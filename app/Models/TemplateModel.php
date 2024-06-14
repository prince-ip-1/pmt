<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateModel extends Model
{
    use HasFactory;
    protected $table = 'custom_template';
    protected $fillable =["id","template_title","template_description","email_subject","status"];
         
}
