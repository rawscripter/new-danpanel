<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductRequestResource;
use App\Order;
use App\Product;
use App\ProductRequest;
use Illuminate\Http\Request;

class ProductRequestController extends Controller
{


    public function requests(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Requests';
        $query = ProductRequest::query();

        // all running orders
        if ($request->status == 'expired') {
            $query->where('type', 'expired');
        }
        // all complete orders
        if ($request->status == 'favourite') {
            $query->where('type', 'favourite');
        }

        // to filter
        if ($request['query']) {
            $query->where('custom_order_id', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }

        if ($request->orderBy) {
            $query->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $results = $query->paginate($request->limit ? $request->limit : 20);

        $res['total'] = $results->total();
        $res['requests'] = ProductRequestResource::collection($results);
        return response()->json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($slug, Request $request)
    {
        $product = Product::whereSlug($slug)->first();


        $request = ProductRequest::create(
            [
                'product_id' => $product->id,
                'name' => $request->name,
                'email' => $request->email,
                'cvr_number' => $request->cvr_number,
                'phone' => $request->phone,
                'note' => $request->note,
                'variations' => json_encode($request->selectedVariations),
                'type' => 'hent',
            ]
        );
        if ($request) {
            $res['status'] = 200;
            $res['message'] = 'Request Sent';

            MailController::sendProductRequestMail($request);
        } else {
            $res['status'] = 200;
            $res['message'] = 'Request Sent';
        }


        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRequest $productRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRequest $productRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRequest $productRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRequest $productRequest)
    {
        //
    }
}
