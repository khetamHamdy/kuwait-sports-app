<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = ['image', 'link', 'status'];
    public $translatedAttributes = ['title', 'description'];

    public function scopeFilter($query, $params)
    {
        if ($params) {
            $query->where(function ($q) use ($params) {
                $q->whereTranslationLike('title', '%' . $params . '%');
            });
        }
        return $query;
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }
}
