<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestAdminLikes extends Model
{
    use HasFactory;

    public $table = 'contest_admin_likes';
    public $fillable = ['contest_id', 'user_id'];

}
