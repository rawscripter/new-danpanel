<?php

namespace App;

use App\Http\Resources\OrderVariationResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class Product extends Model
{
    protected $guarded = [];
    /**
     * @var float|int|mixed
     */
    private $current_price;
    /**
     * @var mixed
     */
    private $minus_price_user_price;
    /**
     * @var mixed
     */
    private $last_price;
    /**
     * @var mixed
     */
    private $offer_price;
    /**
     * @var mixed
     */
    private $market_price;
    /**
     * @var mixed
     */
    private $join_price;

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function thumbImage()
    {
        return env('APP_URL') . '/' . 'images/product/thumb/' . $this->image;
    }

    public function featureImage()
    {
        return env('APP_URL') . '/' . 'images/product/feature/' . $this->image;
    }

    public function mainImage()
    {
        return env('APP_URL') . '/' . 'images/product/' . $this->image;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class)->where('type', null);
    }

    public function productSlideImages()
    {
        return $this->hasMany(ProductImage::class)->where('type', 'slide_image');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reminders()
    {
        return $this->hasMany(ProductReminder::class);
    }

    public function requests()
    {
        return $this->hasMany(ProductRequest::class);
    }


    public function orderVariations($variations)
    {
        $variations = json_decode($variations, true);
        return OrderVariationResource::collection($variations);
    }

    public function isRequestProduct()
    {
        return $this->category->id === 3;
    }

    public function isPackageProduct()
    {
        return $this->category->id === 2;
    }

    public function savingPercentage()
    {
        if (!$this->market_price) return 0;
        if (!$this->offer_price) return 0;
        return ceil(100 - (($this->offer_price / $this->market_price) * 100));
    }

    public function paymentPercentage()
    {
        if ($this->join_price > 0) {
            return ceil((($this->join_price / $this->offer_price) * 100));
        } else {
            return 0;
        }

    }

    public function isAuthUserLikedPost($id = null)
    {


        if (Auth::guard('api')->user()) {
            $userID = Auth::guard('api')->user()->id;
            $like = $this->likes()->where('user_id', $userID)->get();
            if ($like->isEmpty()) {
                return false;
            }
            return true;
        } else {
            return Cache::has('liked-product-' . $id);
        }

    }

    public function isAuthUserFavouritePost()
    {
        if (Auth::guard('api')->user()) {
            $userID = Auth::guard('api')->user()->id;
            $like = $this->favourites()->where('user_id', $userID)->get();
            if ($like->isEmpty()) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function reduceProductPriceOnUserOrder($quantity = 1)
    {
        if ($this->current_price > $this->last_price) {
            if ($this->minus_price_user_price > 0) {
                $needToReduce = $this->minus_price_user_price * $quantity;
                $this->current_price = $this->current_price - $needToReduce;
                $this->save();
            }
        }
    }
}
