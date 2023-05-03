<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $table = "products_translations";
    protected $fillable = ['title', 'description'];
    public $timestamps = false;
}
