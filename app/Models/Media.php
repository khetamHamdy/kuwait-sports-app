<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public $fillable = ['image', 'status', 'video'];

    public $table = 'media';

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
