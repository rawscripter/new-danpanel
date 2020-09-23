<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderProducts;
use App\OrderShippingInfo;
use App\Product;
use App\Subscriber;
use App\TemporaryOrder;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        $orders = Order::query();
        $orders->where('is_full_price_paid', 1);

        // only product orders
        if (isset($request->product)) {
            $orders->where('product_id', $request->product);
        }

        // only product orders
        if (isset($request->customer)) {
            $orders->where('user_id', $request->customer);
        }

        // all running orders
        if ($request->status == 'running') {
            $orders->where('order_status', 0);
        }
        // all complete orders
        if ($request->status == 'complete') {
            $orders->where('order_status', 1);
        }
        // all complete orders
        if ($request->status == 'canceled') {
            $orders->where('is_canceled', 1);
        } else {
            $orders->where('is_canceled', 0);
        }

        // to filter
        if ($request['query']) {
            $orders->where('custom_order_id', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }

        if ($request->orderBy) {
            $orders->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orders = $orders->paginate($request->limit ? $request->limit : 20);

        $res['total'] = $orders->total();
        $res['orders'] = OrderResource::collection($orders);
        return response()->json($res);
    }

    function createTempUser($request)
    {
        $shippingInfo = $request->shipping_info;

        $user = User::where('email', $shippingInfo['email'])->first();

        if (!empty($user)) return $user;
        $user = User::create([
            'name' => $shippingInfo['name'],
            'email' => $shippingInfo['email'],
        ]);
        UserInfo::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'address' => $user->address,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
        ]);
        return $user;
    }


    function createOrder($request, $user)
    {
        $orderDetails = $request->orderDetails;
        $products = $request->products;

        $totalOrder = Order::all()->count();
        $serialNum = !empty($totalOrder) ? $totalOrder + 1 : 1;
        $newCustomerId = 'D-000' . +$serialNum;

        $order = Order::create(
            [
                'custom_order_id' => $newCustomerId,
                'user_id' => $user->id,
                'total_price' => $orderDetails['total'],
                'shipping_cost' => $orderDetails['shipping_cost'],
            ]
        );
        //TODO: store order products

        foreach ($products as $product) {
            $variations = !empty($product['variations']) ? json_encode($product['variations']) : '';
            $products = OrderProducts::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'unit_price' => $product['offer_price'],
                'total_price' => $product['totalPrice'],
                'variations' => $variations,
            ]);
        }

        // update order shipping info
        $this->updateShippingInfo($order, $request);


        return $order;
    }

    public function createNewOrder(Request $request)
    {
        // if user is not logged in then create a new user
        if (Auth::guard('api')->user()) {
            $user = Auth::guard('api')->user();
        } else {
            $user = $this->createTempUser($request);
        }

        $order = $this->createOrder($request, $user);

        $paymentID = PaymentController::createPaymentId($order);
        $paymentData = json_decode($paymentID, true);
        $order->payment_id = $paymentData['paymentId'] ?? '';
        $order->save();

        echo $paymentID;

    }

    public function customerOrders(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($request->status == 'canceled') {
            $orders = $user->canceledOrders;
        } else {
            $orders = $user->orders;

        }
        $res['status'] = 200;
        $res['message'] = 'User Order Fetched Successfully.';
        $res['orders'] = OrderResource::collection($orders);

        return response()->json($res);
    }

    public function orderDetails($orderId)
    {
        $order = Order::where('custom_order_id', $orderId)->first();
        if ($order) {
            $res['status'] = 200;
            $res['message'] = 'Betaling vellykket';
            $res['payment']['isPaid'] = true;
            $res['order'] = new OrderResource($order);
        } else {
            $res['status'] = 201;
            $res['payment']['isPaid'] = false;
            $res['message'] = 'Ingen registrering fundet.';
        }
        return response()->json($res);
    }


    public function updateShippingInfo(Order $order, Request $request)
    {
        $shipping_info = $request->shipping_info;
        $shipping_method = $request->shipping_method_details;
        $info = OrderShippingInfo::create([
            'order_id' => $order->id,
            'name' => $shipping_info['name'] ?? '',
            'email' => $shipping_info['email'],
            'address' => $shipping_info['address'] ?? '',
            'city' => $shipping_info['city'] ?? '',
            'zip_code' => $shipping_info['zip_code'] ?? '',
            'phone' => $shipping_info['phone'] ?? '',
            'company_name' => $shipping_info['company_name'] ?? '',
            'cvr_number' => $shipping_info['cvr_number'] ?? '',
            'ean_number' => $shipping_info['ean_number'] ?? '',
            'note' => $shipping_info['note'] ?? '',
            'shipping_method_type' => $request->shipping_method_type,
            'shipping_method_details' => json_encode($shipping_method),
        ]);

        if ($info) {
            $res['status'] = 200;
            $res['message'] = 'Update Successful';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Record Found.';
        }
        return $res;
    }

    public function resendPaymentOrderMail(Order $order)
    {
        $mail = MailController::paymentReminderBeforeDeadline($order);
        if ($mail) {
            $res['status'] = 200;
            $res['message'] = 'Påmindelse mail sendt.';
        } else {
            $res['status'] = 201;
        }
        return response()->json($res);
    }
}
