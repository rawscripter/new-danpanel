<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderPaymentResource;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderPayment;
use App\OrderProducts;
use App\OrderShippingInfo;
use App\Product;
use App\TemporaryOrder;
use Illuminate\Http\Request;
use Kameli\Quickpay\Quickpay;

class PaymentController extends Controller
{
    public static function createPaymentLink(Order $order): \Illuminate\Http\JsonResponse
    {

        try {
            $custom_order_id = $order->custom_order_id;
            $amount = $order->total_price * 100;
            // api keys
            $api_key = 'b10332bcedbd2443d6153aeeae2ec9d2f5879e32008f5171a34b3adaa6cb8400';
            $private_key = 'bfb7f83823164bd632a8c80c5dcf65037962cf218215f0327b74b03a74a3b212';
            $client = new Quickpay($api_key, $private_key);
            $payment = $client->payments()->create(
                [
                    'currency' => 'DKK',
                    'order_id' => $custom_order_id,
                ]
            );
            $link = $client->payments()->link($payment->getId(), [
                'amount' => $amount,
                'continue_url' => env('APP_URL') . '/payment/success?payment_id=' . $payment->getId(),
                'callback_url' => env('APP_URL') . '/payment/success?payment_id=' . $payment->getId(),
                'cancel_url' => env('APP_URL') . '/final/checkout',
            ]);
            $res['status'] = 'success';
            $res['link'] = $link->getUrl();
            return response()->json($res);

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            return response()->json($res);
        }
    }

    public function charge(Request $request)
    {
        $api_key = 'b10332bcedbd2443d6153aeeae2ec9d2f5879e32008f5171a34b3adaa6cb8400';
        $private_key = 'bfb7f83823164bd632a8c80c5dcf65037962cf218215f0327b74b03a74a3b212';

        $client = new Quickpay($api_key, $private_key);

        $payment_id = $request->input('payment_id');

        try {
            $payment = $client->payments()->get($payment_id);
            $client->payments()->captureAmount($payment_id, $payment->amount());
            // mark order as paid
            self::markOrderAsPaid($payment->order_id, $payment->getId());
            return redirect('/order/payment?status=success&order=' . $payment->order_id . '&type=1');
        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            return response()->json($res);
        }
    }

    public static function markOrderAsPaid($orderID, $paymentID,)
    {

        // payment complete
        $order = Order::where('custom_order_id', $orderID)->first();
        // set order full payment paid as true
        $order->is_full_price_paid = 1;
        $order->order_status = 1;
        $type = 1;
        //save order payment info
        $order->save();
        //save order payment info
        OrderPayment::create([
            'order_id' => $order->id,
            'paymentId' => $paymentID,
            'type' => $type,
            'status' => 'paid',
            'amount' => $order->total_price,
        ]);
        MailController::sendMailToUserAtOrderPayment($order);

    }
}
