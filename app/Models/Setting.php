<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name', 'site_tagline', 'site_description',
        'instagram_url', 'facebook_url',
    ];
}
