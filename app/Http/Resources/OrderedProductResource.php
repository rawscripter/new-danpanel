<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderedProductResource extends JsonResource
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
            'name' => $this->name,
            'event_id' => $this->event_id,
            'slug' => $this->slug,
            'thumbImage' => $this->thumbImage(),
            'featureImage' => $this->featureImage(),
            'selected_variation' => !empty($this['pivot']['variations']) ? $this->orderVariations($this['pivot']['variations']) : [],// $this->variations ? json_decode($this->variations, true) : [],
            'quantity' => $this['pivot']['quantity'],
            'total' => $this['pivot']['total_price'],
            'fullImage' => $this->mainImage(),
            'short_des' => $this->short_des,
            'full_des' => $this->full_des,
            'order_note' => $this->order_note,
            'market_price' => $this->market_price,
            'product_channel' => $this->product_channel,
            'offer_price' => $this->offer_price,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}
