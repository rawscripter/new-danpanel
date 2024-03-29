<!DOCTYPE html>
<html lang="en">
<?php
// order info variable = $order
// order user info = $order->user
// order Shipping info = $order->shippingInfo
// order products = $oder->products //will return collection of products
?>
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

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
            /* margin: 0;
            padding: 0; */
            line-height: .2rem;
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

    <div class="container ">
        <div class="row text-center" style="margin-top:4rem">
            <div class="col-md-12">Order# </div>
        </div>
        <div class="row" style="margin-bottom:3rem">
            <div class="col-md-12 text-left">
                <p><strong>Kundeoplysninger</strong></p>
                <hr>
                <p>Name:</p>
                <p>Address:</p>
                <p>Post, City:</p>
                <p>Telephone:</p>
                <p>Email:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-5"><a style="" class="" href="https://danpanel.dk"><img
                        src="http://danpanel.dk/frontend/assets/img/site.png" alt="DanPanel Aps" /></a>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row" style="margin-top:3rem">
            <div class="col-md-12 text-right">
                <p>Ordernumber:</p>
                <p>Orderdate:</p>
                <p>OrderStatus:</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 align-left">
                <p>Tak fordi du handlede hos os. Vi har her vedlagt din ordreseddel. </p>
                <p>Vi ønsker dig rigtig god fornøjelse med dit køb og vi glæder os til at se dig som kunde ved os igen.
                </p>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">
                <p><strong>DanPanel Aps</strong>-Marielundvej 20, <br />
                    2730 Herlev, -Denmark</p>
                <p>Telefonnr.: 32223203 - info@danpanel.dk - webshop.danpanel.dk </p>
                <p>CVR-nummer: 38362925</p>
            </div>
        </div>
    </div>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp"
        style="background-color: #d5d5d5;">
        <tbody>
            <tr>
                <td>
                    <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth"
                        style="background-color: #ffffff; margin: 10px auto;">
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
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">

                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End address Section -->

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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;">
                                                    Forsendelse Gebyr:
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                    Total beløb
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
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
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End calculation Section -->

                            <!-- Start payment method Section -->
                            <!-- {{-- <tr> --}}
                {{-- <td style="padding: 0 10px;"> --}}
                {{-- <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" --}}
                {{-- class="devicewidthinner"> --}}
                {{-- <tbody> --}}
                {{-- <tr> --}}
                {{-- <td colspan="2" --}}
                {{-- style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;"> --}}
                {{-- Payment Method (Bank Transfer) --}}
                {{-- </td> --}}
                {{-- </tr> --}}
                {{-- <tr> --}}
                {{-- <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;"> --}}
                {{-- Bank Name: --}}
                {{-- </td> --}}
                {{-- <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;"> --}}
                {{-- Account Name: --}}
                {{-- </td> --}}
                {{-- </tr> --}}
                {{-- <tr> --}}
                {{-- <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;"> --}}
                {{-- Bank Address: --}}
                {{-- </td> --}}
                {{-- <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;"> --}}
                {{-- Account Number: --}}
                {{-- </td> --}}
                {{-- </tr> --}}
                {{-- <tr> --}}
                {{-- <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;"> --}}
                {{-- Bank Code: --}}
                {{-- </td> --}}
                {{-- <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;"> --}}
                {{-- SWIFT Code: --}}
                {{-- </td> --}}
                {{-- </tr> --}}
                {{-- <tr> --}}
                {{-- <td colspan="2" --}}
                {{-- style="width: 100%; text-align: center; font-style: italic; font-size: 13px; font-weight: 600; color: #666666; padding: 15px 0; border-top: 1px solid #eeeeee;"> --}}
                {{-- <b style="font-size: 14px;">Note:</b> Lorem ipsum dolor sit amet, consectetur --}}
                {{-- adipiscing elit --}}
                {{-- </td> --}}
                {{-- </tr> --}} -->
                        </tbody>
                    </table>
                </td>
                <!-- End payment method Section -->
            </tr>
        </tbody>
    </table>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
