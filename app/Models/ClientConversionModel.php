<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientConversionModel extends Model
{
    use HasFactory;
    protected $table = 'client_conversion';
    protected $fillable = ["id","client_id","comments"];


}
