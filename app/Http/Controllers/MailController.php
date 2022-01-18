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
    public static function sendMailToAdminOnNewUserRegister($user): bool
    {
        $sendToMail = $user->email;
        $mail = Mail::to([$sendToMail, 'hej@danpanel.dk'])->send(new UserCreateAccountMail($user));
        return (bool)$mail;
    }


    public static function sendMailToUserAtOrderPayment($order): bool
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to([$sendToMail, 'hej@danpanel.dk'])->send(new ProductOrderMail($order));
        return (bool)$mail;
    }

    public static function sendMailToUserAtOrderSecondPayment($order): bool
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new OrderSecondPaymentMail($order));
        return (bool)$mail;
    }

    public static function paymentReminderBeforeDeadline($order): bool
    {
        $sendToMail = $order->user->email;

        try {
            Mail::to($sendToMail)->send(new PaymentReminderMailBeforeExpire($order));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductReminderMail($reminder): bool
    {
        $sendToMail = $reminder->email;

        try {
            Mail::to($sendToMail)->send(new ProductReminderMail($reminder));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductRequestReminderMail($request): bool
    {
        $sendToMail = $request->email;

        try {
            Mail::to($sendToMail)->send(new ProductRequestReminderMail($request));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public static function sendProductRequestMail($request): bool
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
