<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        // remote html tags from string
        $content = strip_tags($this->description);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'short_des' => Str::limit($content, 100, '...'),
            'created_at' => $this->created_at->format('d F Y')
        ];
    }
}
