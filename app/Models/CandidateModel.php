<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateModel extends Model
{
    use HasFactory;
    protected $table = 'candidate';
    protected $fillable = ["id","firstname","lastname","address","dob","state","city","experience","subject","education","application_date","desi_id","dept_id","mobile_no","email_id","skills","cv","current_employer","position","reason_for_leaving","current_ctc","expected_ctc","eduction_text","additional_notes","link","portal","other_years","duration"];
}
