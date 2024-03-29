<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_variation' => optional($this->variations)->load('options'),
            'product_type' => json_decode($this->product_type, true),
            'thumbImage' => $this->thumbImage(),
            'featureImage' => $this->featureImage(),
            'fullImage' => $this->mainImage(),
            'productImages' => ProductImageResource::collection($this->productImages),
            'productSlideImages' => ProductImageResource::collection($this->productSlideImages),
            'total_favourites' => $this->favourites->count(),
            'total_likes' => $this->likes->count(),
            'isLikedByCurrentUser' => $this->isAuthUserLikedPost($this->id),
            'isFavouriteByCurrentUser' => $this->isAuthUserFavouritePost(),
            'short_des' => $this->short_des,
            'full_des' => $this->full_des,
            'order_note' => $this->order_note,
            'category' => $this->category->name,
            'categoryData' => $this->category,
            'subCategory' => optional($this->subCategory)->name,
            'subCategoryData' => $this->subCategory,
            'market_price' => $this->market_price,
            'save_price' => $this->market_price - $this->offer_price,
            'current_price' => $this->current_price,
            'total_clicks' => $this->total_clicks,
            'product_channel' => $this->product_channel,
            'saving_percentage' => $this->savingPercentage(),
            'is_request_product' => $this->isRequestProduct(),
            'is_package_product' => $this->isPackageProduct(),
            'offer_price' => $this->offer_price,
            'is_offer_expirable' => $this->is_offer_expirable,
            'totalOrders' => $this->orders->count(),
            'user' => $this->user->name,
            'expire_date' => Carbon::parse($this->expire_date)->format('d F Y H:i:s'),
            'expire_date_timestamp' => Carbon::parse($this->expire_date)->format('Y-m-d\TH:i'),
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}
