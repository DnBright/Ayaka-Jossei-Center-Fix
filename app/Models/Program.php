<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'featured_image',
        'curriculum',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'curriculum' => 'array',
        'is_active' => 'boolean',
    ];
}
