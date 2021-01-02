<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dog extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'dog_breed', 'dog_color', 'dog_sex', 'dog_birth_date', 'dog_farm_name', 'dog_buy_price', 'dog_sell_price', 'dog_image',
        'dog_owner', 'dog_status', 'install_status', 'microchip_id',
    ];
}
