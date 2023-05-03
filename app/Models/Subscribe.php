<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Subscribe extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'status', 'sender_name'];

    public function scopeFilter($query, Request $request)
    {
        if ($request->email || $request->sender_name || $request->status) {
            $query->where('email', '=', $request->email)
                ->orWhere('sender_name', 'LIKE', '%' . $request->sender_name . '%')
                ->orWhere('status', '=', $request->status);
        }

        return $query;
    }

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }
}
