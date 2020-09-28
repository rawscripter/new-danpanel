=<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="shortcut icon" type="image/png" href="{{asset('assets/site/assets/images/logo-sign.png')}}"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Din Ordrer Confirmation Fra DanPanel</title>

    <style type="text/css">
            #outlook a {padding:0;}
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; font-family: Helvetica, arial, sans-serif;}
            .ExternalClass {width:100%;}
            .ExternalClass, .ExternalClass p,.ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
            .backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            .main-temp table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-family: Helvetica, arial, sans-serif;}
            .main-temp table td {border-collapse: collapse;}
        </style>
</head>

<body>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp"
        style="background-color: #d5d5d5;">
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
                                                            src="https://danpanel.dk/assets/site/assets/images/logo-black.png"
                                                            alt="DanPanel Aps" /></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Farverland 6
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    2600, Glostrup
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Phone: 32 22 32 03 | Email: hej@danpanel.dk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                    <strong>Order Number:</strong> {{$order->customer_order_id}} | <strong>Order Date:</strong>
                                                    {{$order->created_at->format('d-m-y')}}
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
                                                    Delivery Adderss
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Billing Address
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order->order_shipping_infos->name}}
                                                    
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order->user_infos->name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order->order_shipping_infos->address}}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order->user_infos->address}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order->order_shipping_infos->zip_code}}, {{$order->order_shipping_infos->city}}
                                                    
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order->user_infos->zip_code}}, {{$order->user_infos->city}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order->order_shipping_infos->phone}},<br> {{$order->order_shipping_infos->email}}<br>Shipping Method: {{ucwords(str_replace('_', ' ', $order->order_shipping_infos->shipping_method_type))}}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order->user_infos->phone}},<br> {{$order->user_infos->email}} 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End address Section -->

                            <!-- Start product Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                        <tbody>
                                            @foreach($order->products as $product)
                                            <tr>
                                                <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                    <img style="height: 80px;" src="{{$product->image}}"
                                                        alt="Product Image" />
                                                </td>
                                                <td colspan="2"
                                                    style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    {{$product->name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                    {{$product->pivot->quantity}}
                                                </td>
                                                <td style="width: 130px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                <?php 
                                                    $variations = $product->product_variation->name
                                                ?>
                                                    Color: White & Blue
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                    Kr 1.23 Per Unit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                    Size: XL
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                    <b style="color: #666666;">Kr 1,234.50</b> Total
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                        <tbody>
                                            <tr>
                                                <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                    <img style="height: 80px;" src="images/product-2.jpg"
                                                        alt="Product Image" />
                                                </td>
                                                <td colspan="2"
                                                    style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Aliquam posuere ultrices mi ut rutrum
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                    Quantity: 100
                                                </td>
                                                <td style="width: 130px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                    Color: White & Blue
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                    Kr 1.23 Per Unit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                    Size: XL
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                    <b style="color: #666666;">Kr 1,234.50</b> Total
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                        <tbody>
                                            <tr>
                                                <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                    <img style="height: 80px;" src="images/product-3.jpg"
                                                        alt="Product Image" />
                                                </td>
                                                <td colspan="2"
                                                    style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Phasellus vitae pharetra arcu
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                    Quantity: 100
                                                </td>
                                                <td style="width: 130px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                    Color: White & Blue
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                    Kr 1.23 Per Unit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                    Size: XL
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                    <b style="color: #666666;">Kr 1,234.50</b> Total
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
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
                                                    Kr 1,234.50
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;">
                                                    Shipping Fee:
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">
                                                    Kr 10.20
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                    Order Total
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
                                                    Kr 1,234.50
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                    Payment Term:
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                    100%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    Deposit Amount
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right; padding-bottom: 10px;">
                                                    Kr 1,234.50
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End calculation Section -->

                            <!-- Start payment method Section -->
                            <tr>
                                <!-- <td style="padding: 0 10px;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Payment Method (Bank Transfer)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Bank Name:
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Account Name:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Bank Address:
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Account Number:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    Bank Code:
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    SWIFT Code:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"
                                                    style="width: 100%; text-align: center; font-style: italic; font-size: 13px; font-weight: 600; color: #666666; padding: 15px 0; border-top: 1px solid #eeeeee;">
                                                    <b style="font-size: 14px;">Note:</b> Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td> -->
                            </tr>
                            <!-- End payment method Section -->
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>



<h1 style="text-align: center">DanPanel</h1>
<br>
<h1 style="text-align: center">Tak for din henvendelse! </h1>
<h4 style="text-align: center">DanPanel agerer som formidler og sørger for kontakten mellem samarbejdspartneren og dig.
    Når din forespørgsel er gennemgået og behandlet af samarbejdspartneren oplyser vi navn på denne, det uforpligtende
    tilbud, og du får mulighed for at godkende eller afslå tilbuddet.
</h4>
<h4 style="text-align: center">Du vil modtage notifikationer om, hvilket stadie din bestilling befinder sig på. Du kan
    følge med i forløbet ved at logge ind på din profil på danpanel.dk. Her har du også mulighed for direkte at kontakte
    os på chatten under ”Profil” ”Beskeder”.
    
</h4>
    <h1 style="text-align: left">Formular detaljer</h1>
    <h4>Order ID: {{$order->id}}</h4>       
    <h4>Product Navn: {{$order->name}}</h4>   
    <h4>Pris: {{$order->total_price}}</h4>           

    <br>
<br>
<div>
    <p class="text-left" style="text-align: left">Med venlig hilsen</p>
    <p class="text-left" style="text-align: left">DanPanel Aps</p>
</div>
</body>

</html>
