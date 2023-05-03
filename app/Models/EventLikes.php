<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLikes extends Model
{
    use HasFactory;

    public $table = 'event_likes';
    public $fillable = ['event_id', 'user_id'];

}
