<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $appends = ['is_favourite'];
    public $fillable = ['image', 'status', 'video', 'close_contest', 'open_contest', 'closed_contest'];
    public $translatedAttributes = ['description', 'title'];

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

//
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'contest_users',
            'contest_id',
            'user_id',
            'id',
            'id'
        )->withPivot(['user_id', 'contest_id', 'count_like']);
    }

    public function contestAdminlikes()
    {
        return $this->hasMany(ContestAdminLikes::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'contest_admin_likes')->withPivot('contest_id', 'user_id');
    }

    public function getIsFavouriteAttribute()
    {
//        if (auth('api')->check()) {
//            $favourite= Favorite::where(['user_id'=>auth('api')->user()->id ,'product_id'=>$this->id])->first();
//            if($favourite){
//                return 1;
//            }
//            return 0;
//        }
        if (auth('web')->check()) {
            $favourite = ContestAdminLikes::where(['user_id' => auth('web')->user()->id, 'contest_id' => $this->id])->first();
            if ($favourite) {
                return 1;
            }
            return 0;
        }
    }
}
