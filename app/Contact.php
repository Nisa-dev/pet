<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name', 'contact_address', 'contact_tel_no',
         'contact_google_map_link', 'contact_facebook', 'contact_facebook_link','contact_line_qr', 'contact_logo'
    ];
}
