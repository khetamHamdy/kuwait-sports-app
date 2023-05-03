<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $table = "settings";
    protected $fillable = ['fav_icon', 'mobile', 'facebook', 'twitter', 'instagram', 'youTube'
        , 'primaryLogo', 'secondaryLogo', 'count_total_client', 'count_project_complete', 'count_active_employee',
        'count_avg_rating', 'service_image1', 'service_image2', 'service_image3', 'product_id', 'email', 'image_web_all'];

    public $translatedAttributes = ['text_ourLogo', 'text_socialMedia', 'text_footer', 'about_description1', 'provide_description1',
        'service_title1', 'service_title2', 'service_title3', 'service_description1', 'service_description2', 'privacyPolicy_text', 'terms_condition',
        'service_description3',
    ];

    protected $with = "product";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
