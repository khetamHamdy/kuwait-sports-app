<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'mobile', 'messages'];

    public function scopeFilter($query, Request $request)
    {
        if ($request->name) {
            $query->where("name", 'LIKE', '%' . $request->name . '%');
        } else if ($request->email) {
            $query->where("email", 'LIKE', '%' . $request->email . '%');
        }
        return $query;
    }
}
