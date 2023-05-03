<?php

namespace App\Models;

use AliBayat\LaravelLikeable\Likeable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestUser extends Model
{
    use HasFactory;

    public $with = ['user', 'contest', 'users'];
    public $fillable = ['user_id', 'image', 'description', 'status', 'contest_id', 'winner', 'count_like'];
    protected $appends = ['is_favourite'];

    public function scopeFilter($query, $params)
    {
        if ($params) {
            $query->where('status', '=', $params);
        }
        return $query;
    }

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_likes', 'contest_id', 'user_id', 'id', 'id');
    }


    public function getIsFavouriteAttribute()
    {
        if (auth('web')->check()) {
            $favourite = UserLikes::where(['user_id' => auth('web')->user()->id, 'contest_id' => $this->id])->first();
            if ($favourite) {
                return 1;
            }
            return 0;
        }
    }
}
