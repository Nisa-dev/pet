<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'home_welcome_text', 'home_background_image', 'home_google_map_embed',
    ];
}
