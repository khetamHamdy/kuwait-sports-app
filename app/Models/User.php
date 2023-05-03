<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, Request $request)
    {
        if ($request->first_name) {
            $query->where("first_name", 'LIKE', '%' . $request->first_name . '%');
        } else if ($request->email) {
            $query->where("email", 'LIKE', '%' . $request->email . '%');
        } else if ($request->mobile) {
            $query->where("mobile", $request->mobile);
        } else if ($request->status) {
            $query->where("status", $request->status);
        } else if ($request->id) {
            $query->where("id", "=", $request->id);
        }

        return $query;
    }

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }
}
