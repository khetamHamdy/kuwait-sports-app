<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Event extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $appends = ['is_favourite'];
    protected $fillable = ['image', 'video', 'type', 'link', 'status'];
    public $translatedAttributes = ['title', 'description'];

    public function scopeFilter($query, Request $request)
    {
        if ($request->type) {
            $query->where('type', '=', $request->type);
        }

        if ($request->title) {
            $params = $request->title;
            $query->where(function ($q) use ($params) {
                $q->whereTranslationLike('title', '%' . $params . '%');
            });
        }
        return $query;
    }

    public
    function scopeSearch($query, $params)
    {
        if ($params) {
            $query->where(function ($q) use ($params) {
                $q->whereTranslationLike('title', '%' . $params . '%');
            });
        }
        return $query;
    }


    public
    function eventImages()
    {
        return $this->hasMany(EventImage::class, 'event_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_likes');
    }
    /**
     * The "booted" method of the model.
     *x
     * @return void
     */

//    static function booted()
//    {
//        static::addGlobalScope('active', function (Builder $builder) {
//            $builder->where('status', '=', 'active');
//        });
//    }
    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }

    public function getIsFavouriteAttribute()
    {
        if (auth('web')->check()) {
            $favourite = EventLikes::where(['user_id' => auth('web')->user()->id, 'event_id' => $this->id])->first();
            if ($favourite) {
                return 1;
            }
            return 0;
        }
    }
}
