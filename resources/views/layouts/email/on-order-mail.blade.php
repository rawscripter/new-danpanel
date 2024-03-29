<!DOCTYPE html>
<html lang="en">
<?php
// order info variable = $order
// order user info = $order->user
// order Shipping info = $order->shippingInfo
// order products = $oder->products //will return collection of products
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Din Ordrer Confirmation Fra DanPanel</title>

    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: Helvetica, arial, sans-serif;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        .main-temp table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            font-family: Helvetica, arial, sans-serif;
        }

        .main-temp table td {
            border-collapse: collapse;
        }

    </style>
</head>

<body>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp"
        style="background-color: #d5d5d5; margin: 10px auto;">
        <tbody>
            <tr>
                <td>
                    <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth"
                        style="background-color: #ffffff;">
                        <tbody>
                            <!-- Start header Section -->
                            <tr>
                                <td style="padding-top: 30px;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #eeeeee; text-align: center;">
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <a href="https://danpanel.dk"><img
                                                            src="http://danpanel.dk/frontend/assets/img/site.png"
                                                            alt="DanPanel Aps" /></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Telegade 1,
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    2630, Taastrup
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Telefon: 32 22 32 03 | Email: hej@danpanel.dk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                    <strong>Ordrenummer:</strong> {{ $order->custom_order_id }} |
                                                    <strong>Bestil Dato:</strong>
                                                    {{ $order->created_at->format('d-F-Y') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End header Section -->

                            <!-- Start address Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Leveringsadresse
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Betalingsadresse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{ $order->shippingInfo->name }}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{ $order->user->info->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{ $order->shippingInfo->address }},
                                                    {{ $order->shippingInfo->city }}

                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{ $order->user->info->address }},
                                                    {{ $order->user->info->city }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{ $order->shippingInfo->phone }} <br>
                                                    {{ $order->shippingInfo->email }}<br>
                                                    Fragtmetode:
                                                    {{ ucwords(str_replace('_', ' ', $order->shippingInfo->shipping_method_type)) }}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{ $order->user->phone }} <br>
                                                    {{ $order->user->email }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End address Section -->

                            <!-- Start product Section -->
                            @if ($order->products->count() > 0)
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td style="padding-top: 0;">
                                            <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                                class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="4"
                                                            style="padding-right: 10px; padding-bottom: 10px;">
                                                            <img style="height: 80px;"
                                                                src="{{ $product->thumbImage() }}"
                                                                alt="Product Image" />
                                                        </td>
                                                        <td colspan="2"
                                                            style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                            {{ $product->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                            Antal: {{ $product->pivot->quantity }}
                                                        </td>
                                                        <td style="width: 130px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                            <?php

                                                            if (!empty($product->pivot->variations)) {
                                                                $variations = $product->orderVariations($product->pivot->variations);
                                                                foreach ($variations as $v) {
                                                                    $option = \App\ProductVariationOption::find($v['optionID']);
                                                                    $variation = \App\ProductVariation::find($v['variationID']);
                                                                    $price = $option->price ?? 0;
                                                                    echo "{$variation->name}: {$option->name} +{$price} kr <br>";
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td
                                                            style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                            Kr {{ $product->pivot->unit_price }} Pr. enhed
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                        </td>
                                                        <td
                                                            style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                            <b style="color: #666666;">Kr
                                                                {{ $product->pivot->total_price }}</b> Total
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <!-- End product Section -->

                            <!-- Start calculation Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #bbbbbb; margin-top: -5px;">
                                        <tbody>
                                            <tr>
                                                <td rowspan="5" style="width: 55%;"></td>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Sub-Total:
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; width: 130px; text-align: right;">
                                                    Kr {{ $order->total_price }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;">
                                                    Forsendelse Gebyr:
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">
                                                    Kr
                                                    {{ $order->shipping_cost == null ? 0 : $order->shipping_cost }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                    Total beløb
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
                                                    Kr {{ $order->total_price }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                    Betaling Term:
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                    100%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    Betalt beløb:
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right; padding-bottom: 10px;">
                                                    Kr {{ $order->total_price }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
