<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikes extends Model
{
    use HasFactory;

    public $table = 'user_likes';
    public $fillable = ['contest_id', 'user_id'];

}
