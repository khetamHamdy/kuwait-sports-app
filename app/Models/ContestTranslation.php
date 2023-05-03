<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestTranslation extends Model
{
    use HasFactory;

    public $fillable = ['description','title'];
    public $timestamps = false;

}
