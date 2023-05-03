<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['text_ourLogo', 'text_socialMedia', 'text_footer', 'about_description1', 'provide_description1',
        'service_title1', 'service_title2', 'service_title3', 'service_description1', 'service_description2',
        'service_description3', 'privacyPolicy_text', 'terms_condition',
    ];
}
