<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentModel extends Model
{
    use HasFactory;
    protected $table = 'attachments';
    protected $fillable =["project_id","attachment"];
}
