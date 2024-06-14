<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationListModel extends Model
{
    use HasFactory;
    protected $table = 'notification_list';
    protected $fillable =["id","sender_id","receiver_id","notification_type_id","read_status"];
}
