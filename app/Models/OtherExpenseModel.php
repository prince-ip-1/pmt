<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherExpenseModel extends Model
{
    use HasFactory;
    protected $table = 'other_expense';
   protected $fillable = ["id","description","payment_type","paid_by","invoice","category","amount"];
}