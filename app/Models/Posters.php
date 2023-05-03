<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posters extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'link', 'status', 'type'];

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }
}
