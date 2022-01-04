<?php

namespace App\Http\Resources;

use App\OrderShippingInfo;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'custom_order_id' => $this->custom_order_id,
            'products' => OrderedProductResource::collection($this->products),
            'total_price' => $this->total_price,
            'shipping_cost' => $this->shipping_cost,
            'customer' => (new CustomerResource($this->user)),
            'shipping_info' => (new OrderShippingInfoResource($this->shippingInfo)),
            'is_full_price_paid' => $this->is_full_price_paid ? true : false,
            'order_status' => $this->order_status ? true : false,
            'is_canceled' => $this->is_canceled ? true : false,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}
