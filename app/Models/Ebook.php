<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'file_path',
        'cover_image',
        'download_count',
        'view_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
