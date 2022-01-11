<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'link' => url('/page/' . $this->slug),
            'image' => $this->image ?? '',
            'content' => $this->content,
            'content' => $this->content,
            'show_at_top_menu' => $this->show_at_top_menu,
            'show_at_bottom_menu' => $this->show_at_bottom_menu,
            'created_at' => $this->created_at->format('d F Y')
        ];
    }
}
