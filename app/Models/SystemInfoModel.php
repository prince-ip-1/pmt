<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInfoModel extends Model
{
    use HasFactory;

     protected $table = 'system_information';
    protected $fillable = ["id","emp_id","platform","system_name","system_model","ram","storage","price","purchase_date","device","purchase_from"];
    public static function getsum($type="")
    {  
        if($type){
            return SystemInfoModel::where('platform','=',$type)->sum('price');

        }else{
            return SystemInfoModel::sum('price');
        }
    }
    public static function getcount($type)
    {
        if($type)
        {
            return SystemInfoModel::where('platform','=',$type)->count();
        }
        else{
            return SystemInfoModel::count();
        }
    }
}
