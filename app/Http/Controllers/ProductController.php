<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Http\Resources\ProductResource;
use App\Like;
use App\Order;
use App\Product;
use App\ProductImage;
use App\ProductReminder;
use App\ProductRequest;
use App\ProductVariation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        $products = Product::query();
        $products->where('is_archive', 0);

        if (isset($request->status) && $request->status == 'shop') {
            $products->where('category_id', '=', 1);
        }
        if (isset($request->status) && $request->status == 'package') {
            $products->where('category_id', '=', 2);
        }

        if (isset($request->status) && $request->status == 'hent-tilbud') {
            $products->where('category_id', '=', 3);
        }


        if ($request['query']) {
            $products->where('name', 'like', '%' . $request['query'] . '%')
                ->orWhere('event_id', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }
        if ($request->orderBy) {
            $products->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $products = $products->paginate($request->limit ? $request->limit : 20);


        $res['total'] = $products->total();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function archiveProducts(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        $products = Product::query();
        $products->where('is_archive', 1);
        if ($request['query']) {
            $products->where('name', 'like', '%' . $request['query'] . '%')
                ->orWhere('event_id', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }
        if ($request->orderBy) {
            $products->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $products = $products->paginate($request->limit ? $request->limit : 20);


        $res['total'] = $products->total();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function productsForSite(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request['gender'] || $request['short'] || $request['minPrice'] || $request['maxPrice']) {
            $gender = $_GET['gender'];
            $short = $_GET['short'];
            $minPrice = $_GET['minPrice'] ?? '';
            $maxPrice = $_GET['maxPrice'] ?? '';
            $products = Product::query();
            $products->where('is_archive', 0);

            // to filter the gender
            if (strtolower($gender) != 'all') {
                $products->where('product_type', 'like', "%\"{$gender}\"%");
            }
            if (!empty($minPrice) && !empty($maxPrice)) {
                // to filter the price
                $products->whereBetween('offer_price', [$minPrice, $maxPrice]);
            }

            // to order the product
            if (strtolower($short) === 'new') {
                $products->orderByDesc('created_at');
            }

            if (strtolower($short) === 'popular') {
                $products->orderByDesc('total_clicks');
            }
            $products->where('is_archive', 0);
            $products = $products->paginate(600);
        } else if (isset($request['query']) && !empty($request['query'])) {
            $products = Product::where('is_archive', 0)->where('name', 'like', '%' . $request['query'] . '%')->orderBy('created_at', 'desc')->paginate(600);
        } else {
            $products = Product::where('is_archive', 0)->orderBy('created_at', 'desc')->paginate(600);
        }
        $res['products'] = ProductResource::collection($products);
        $res['lastPage'] = $res['products']->lastPage();
        return response()->json($res);
    }

    public function runningProducts(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request->hasCookie('product-channel')) {
            $selected_channel = strtolower($request->cookie('product-channel'));
        } else {
            $selected_channel = 'private';
        }
        //        return $selected_channel;
        $products = Product::where('is_archive', 0)
            ->where('product_channel', 'like', "%$selected_channel%")
            ->where('category_id', '=', 1)
            ->limit(12)
            ->orderBy('priority', 'asc')
            ->get();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function packageProducts(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        if ($request->hasCookie('product-channel')) {
            $selected_channel = strtolower($request->cookie('product-channel'));
        } else {
            $selected_channel = 'private';
        }
        $products = Product::where('is_archive', 0)
            ->where('product_channel', 'like', "%$selected_channel%")
            ->where('category_id', '=', 2)
            ->where('expire_date', '>', Carbon::now())
            ->limit(12)
            ->orderBy('priority', 'asc')
            ->get();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function requestProducts(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        if ($request->hasCookie('product-channel')) {
            $selected_channel = strtolower($request->cookie('product-channel'));
        } else {
            $selected_channel = 'private';
        }
        $products = Product::where('product_channel', 'like', "%$selected_channel%")
            ->where('category_id', '=', 3)
            ->limit(12)
            ->orderBy('priority', 'asc')
            ->get()
            ->where('is_archive', 0);
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function userFavouriteProductsForSite(Request $request)
    {

        $user = Auth::guard('api')->user();

        if ($user) {
            $res['status'] = 200;
            $res['message'] = 'All Categories';
            $products = $user->favouriteProducts;
            $res['products'] = ProductResource::collection($products);
            $res['lastPage'] = 1;
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }


        return response()->json($res);
    }

    public function userReminderProductsForSite(Request $request)
    {

        $user = Auth::guard('api')->user();

        if ($user) {
            $res['status'] = 200;
            $res['message'] = 'All Categories';
            $products = $user->reminderProducts;
            $res['products'] = ProductResource::collection($products);
            $res['lastPage'] = 1;
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }


        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $data = $this->convertRequestProductDataToArray($request);

        $data['event_id'] = $this->generateEventId(8);

        if ($request->product_image)
            $data['image'] = ImageController::uploadImage($request->product_image);
        $product = Product::create($data);
        // to upload product image
        if ($request->product_image) {
            $product->productImages()->create(
                [
                    'user_id' => auth()->user()->id,
                    'image' => $data['image'],
                ]
            );
        }

        if ($product) {
            $res['status'] = 200;
            $res['message'] = 'Product Created Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        if (!empty($product)) {
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return JsonResponse
     */
    public function showProductForSite($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!empty($product)) {
            // increment product click
            $product->increment('total_clicks');
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return JsonResponse
     */
    public function showRelatedForSite(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if ($request->hasCookie('product-channel')) {
            $selected_channel = strtolower($request->cookie('product-channel'));
        } else {
            $selected_channel = 'private';
        }


        $products = Product::inRandomOrder()
            ->where('sub_category_id', $product->subCategory->id)
            ->where('product_channel', 'like', "%$selected_channel%")
            ->where('id', '!=', $product->id)->limit(20)->get();
        if (!empty($products)) {
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['relatedProducts'] = ProductResource::collection($products);
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function userFavourites()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $res['status'] = 200;
            $res['totalFavourites'] = $user->favouriteProducts->count();
        } else {
            $res['status'] = 201;
        }

        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $this->validateRequest($request);

        $data = $this->convertRequestProductDataToArray($request);

        // to upload product image
        if ($request->product_image)
            $data['image'] = ImageController::uploadImage($request->product_image);


        if ($request->product_image) {
            $product->productImages()->create(
                [
                    'user_id' => auth()->user()->id,
                    'image' => $data['image'],
                ]
            );
        }


        if ($product->update($data)) {
            $res['status'] = 200;
            $res['message'] = 'Product Updated Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        if ($product) {
            // delete all orders
            Order::where('product_id', $product->id)->delete();
            // delete all product images
            ProductImage::where('product_id', $product->id)->delete();
            // delete all product reviews
            ProductReminder::where('product_id', $product->id)->delete();
            // delete all product requests
            ProductRequest::where('product_id', $product->id)->delete();
            // delete all product variants
            ProductVariation::where('product_id', $product->id)->delete();
            // delete product
            $product->delete();
            $res['status'] = 200;
            $res['message'] = 'Product Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }
    public function archive(Product $product)
    {
        if ($product) {
            $product->is_archive = 1;
            $product->save();
            $res['status'] = 200;
            $res['message'] = 'Product Archived Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function restore(Product $product)
    {
        if ($product) {
            $product->is_archive = 0;
            $product->save();
            $res['status'] = 200;
            $res['message'] = 'Product Restored Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function deleteProductImage($image)
    {
        $productImage = ProductImage::find($image);
        if ($productImage) {
            $productImage->delete();
            $res['status'] = 200;
            $res['message'] = 'Product Image Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Image Found';
        }
        return response()->json($res);
    }

    public function uploadProductImages(Product $product, Request $request)
    {
        if ($request->hasFile('file')) {
            $image = ImageController::uploadImage($request->file);
            $product->productImages()->create(
                [
                    'image' => $image,
                    'user_id' => auth()->user()->id
                ]
            );
        }
    }

    public function uploadPackageProductSliderImages(Product $product, Request $request)
    {
        if ($request->hasFile('file')) {
            $image = ImageController::uploadImage($request->file);
            $product->productImages()->create(
                [
                    'image' => $image,
                    'user_id' => auth()->user()->id,
                    'type' => 'slide_image'
                ]
            );
        }
    }

    public function addToLike($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $user = Auth::guard('api')->user();
        if ($user) {
            if (!empty($product)) {
                if (!$product->isAuthUserLikedPost()) {
                    $res['status'] = 200;
                    $res['message'] = 'Product added to favourite list.';
                    $product->total_likes = $product->total_likes + 1;
                    $product->save();
                    Like::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id
                    ]);
                    $res['product'] = (new ProductResource($product));
                } else {
                    $res['status'] = 201;
                    $res['message'] = 'No Product Found';
                }
            } else {
                $res['status'] = 201;
                $res['message'] = 'No Product Found';
            }
        } else {

            $expiresAt = Carbon::now()->addCentury();
            Cache::put('liked-product-' . $product->id, true, $expiresAt);

            Like::create([
                'session_id' => session()->getId(),
                'product_id' => $product->id
            ]);
            $res['product'] = (new ProductResource($product));

            $res['status'] = 200;
            $res['message'] = 'Product added to favourite list.';
        }

        return response()->json($res);
    }

    public function maxProductPrice()
    {
        $res['max'] = Product::max('offer_price');
        return response()->json($res);
    }

    public function addToFavourite($slug)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $product = Product::where('slug', $slug)->first();
            if (!empty($product)) {
                if (!$product->isAuthUserFavouritePost()) {
                    $res['status'] = 200;
                    $res['message'] = 'Product added to favourite list.';
                    $product->total_favourites = $product->total_favourites + 1;
                    $product->save();
                    Favourite::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id
                    ]);
                    $res['product'] = (new ProductResource($product));
                }
            } else {
                $res['status'] = 201;
                $res['message'] = 'No Product Found';
            }
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }
        return response()->json($res);
    }

    public function removeFromFavourite($slug)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $product = Product::where('slug', $slug)->first();
            if (!empty($product)) {
                if ($product->isAuthUserFavouritePost()) {
                    $res['status'] = 200;
                    $res['message'] = 'Product removed to favourite list.';
                    $product->total_favourites = $product->total_favourites - 1;
                    $product->save();
                    Favourite::where('user_id', $user->id)->where('product_id', $product->id)->delete();
                    $res['product'] = (new ProductResource($product));
                } else {
                    $res['status'] = 201;
                    $res['message'] = 'Not Liked Yet';
                }
            } else {
                $res['status'] = 201;
                $res['message'] = 'No Category Found';
            }
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }
        return response()->json($res);
    }

    public function convertRequestProductDataToArray($request)
    {
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['short_des'] = $request->short_des;
        $data['full_des'] = $request->full_des;
        $data['product_channel'] = $request->product_channel;
        $data['order_note'] = $request->order_note;
        $data['category_id'] = $request->category_id;
        $data['sub_category_id'] = $request->sub_category_id;
        $data['market_price'] = $request->market_price;
        $data['offer_price'] = $request->offer_price;
        $data['is_offer_expirable'] = $request->is_offer_expirable;
        $data['product_type'] = json_encode($request->product_type);
        $data['user_id'] = auth()->user()->id;
        $data['expire_date'] = Carbon::parse($request->expire_date)->format('Y-m-d H:s:i');
        $data['offer_start_date'] = Carbon::parse($request->offer_start_date)->format('Y-m-d H:s:i');

        return $data;
    }

    public function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'short_des' => 'required',
            'category_id' => 'required',
            'market_price' => 'required',
            'offer_price' => 'required',
            'product_type' => 'required'
        ]);
    }

    public function generateEventId($length = 20)
    {
        $characters = '0123456789_ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
