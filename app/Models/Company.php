<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company_details';
    protected $fillable = ["id","company_name","company_email","hr_email","address","mobile_no","website_url","upload_company","skype_url","linkedin_url","since_year","primary_logo","logo","favicon_logo"];
}
