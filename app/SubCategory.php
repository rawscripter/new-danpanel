<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'icon',
        'name',
        'slug',
        'priority',
        'channel',
        'is_archive'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
