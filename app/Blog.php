<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'sub_category_id',
        'sub_category_id',
        'title',
        'slug',
        'image',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
            $model->status = 1;
            $model->clicks = 0;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }


    public function showBlogImage()
    {
        return '/blog/images/' . $this->image;
    }
}
