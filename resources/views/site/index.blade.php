<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8"/>
    <title>DanPanel</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('frontend/assets/css/default.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
</head>
<body>
<div id="app">
    <app-site-home></app-site-home>
</div>
</body>

<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="{{asset('frontend/assets/js/Popper.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('frontend/assets/js/zoom-image.js')}}"></script>
<script src="{{asset('frontend/assets/js/product_view_main.js')}}"></script>
<script src="{{asset('frontend/assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

<script src="{{asset('js/zoom.js')}}"></script>
<script src="https://checkout.dibspayment.eu/v1/checkout.js?v=1"></script>
<!-- <script src="https://test.checkout.dibspayment.eu/v1/checkout.js?v=1"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
<!-- <script !src="">
    new WOW().init();

</script>
<script>
      $(".cookie-close-x ").on('click', function () {
          $(".cookie").hide();
      });
</script> -->
<!-- Google Tag Manager -->
    <!--<script>(function (w, d, s, l, i) {-->
    <!--        w[l] = w[l] || [];-->
    <!--        w[l].push({-->
    <!--            'gtm.start':-->
    <!--                new Date().getTime(), event: 'gtm.js'-->
    <!--        });-->
    <!--        var f = d.getElementsByTagName(s)[0],-->
    <!--            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';-->
    <!--        j.async = true;-->
    <!--        j.src =-->
    <!--            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;-->
    <!--        f.parentNode.insertBefore(j, f);-->
    <!--    })(window, document, 'script', 'dataLayer', 'GTM-NS5XPCZ');</script>-->
    <!-- End Google Tag Manager -->


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150067692-1"></script>-->
    <!--<script>-->
    <!--    window.dataLayer = window.dataLayer || [];-->

    <!--    function gtag() {-->
    <!--        dataLayer.push(arguments);-->
    <!--    }-->

    <!--    gtag('js', new Date());-->

    <!--    gtag('config', 'UA-150067692-1');-->
    <!--</script>-->

<!-- Start e-maerket widget -->
<!-- <script type="text/javascript" src="https://widget.emaerket.dk/js/285e6787598729651bd255fd54d23fec" async></script> -->
<!-- // end e-maerket widget -->
   

</html>
