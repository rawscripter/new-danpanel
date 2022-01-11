<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'show_at_top_menu',
        'show_at_bottom_menu'
    ];
}
