<?php

namespace App\Http\Controllers;

use App\Mail\ProductOrderMail;
use App\Mail\OrderSecondPaymentMail;
use App\Mail\PaymentReminderMailBeforeExpire;
use App\Mail\ProductReminderMail;
use App\Mail\ProductRequestMail;
use App\Mail\ProductRequestReminderMail;
use App\Mail\UserCreateAccountMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendMailToAdminOnNewUserRegister($user)
    {
        $sendToMail = $user->email;
        $mail = Mail::to([$sendToMail, 'hej@danpanel.dk'])->send(new UserCreateAccountMail($user));
        return $mail ? true : false;
    }


    public static function sendMailToUserAtOrderPayment($order)
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new ProductOrderMail($order));
        return $mail ? true : false;
    }

    public static function sendMailToUserAtOrderSecondPayment($order)
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new OrderSecondPaymentMail($order));
        return $mail ? true : false;
    }

    public static function paymentReminderBeforeDeadline($order)
    {
        $sendToMail = $order->user->email;

        try {
            Mail::to($sendToMail)->send(new PaymentReminderMailBeforeExpire($order));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductReminderMail($reminder)
    {
        $sendToMail = $reminder->email;

        try {
            Mail::to($sendToMail)->send(new ProductReminderMail($reminder));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductRequestReminderMail($request)
    {
        $sendToMail = $request->email;

        try {
            Mail::to($sendToMail)->send(new ProductRequestReminderMail($request));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductRequestMail($request)
    {
        $sendToMail = 'hej@danpanel.dk';

        try {
            Mail::to($sendToMail)->send(new ProductRequestMail($request));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
