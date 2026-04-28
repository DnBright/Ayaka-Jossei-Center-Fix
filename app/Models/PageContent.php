<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = ['page_name', 'section_name', 'content_data', 'is_visible', 'sort_order'];
    protected $casts = ['content_data' => 'array', 'is_visible' => 'boolean'];
}
