<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Microchip extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'microchip_no', 'microchip_buy_price', 'microchip_sell_price', 'microchip_owner', 'microchip_status', 'install_status', 'dog_id',
    ];
}
