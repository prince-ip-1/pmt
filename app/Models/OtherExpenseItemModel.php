<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherExpenseItemModel extends Model
{
    use HasFactory;
    protected $table = 'other_expense_item';
    protected $fillable = ["id","item_name","rate","quantity","amount"];
}
