<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable =["firstname","lastname","gender","email","contact_no","country","company_name","company_address","company_website"];
    
    public static function getsum($id="")
    {  
        if($id){
            return ClientModel::select('clients.id','clients.project_cost','project.client_id')
        ->leftjoin('project','project.client_id','=','clients.id')
        ->where('clients.id','=',$id)->sum('clients.project_cost');

        }else{
            return ClientModel::sum('clients.project_cost');
        }
    }
}
