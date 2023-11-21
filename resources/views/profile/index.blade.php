<!DOCTYPE html>
<html lang="fa" dir="rtl">

<!- https://t.me/sabzrea ->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('asset-profile/assets/css/bootstrap.rtl.css')}}">
    <link rel="stylesheet" href="{{asset('asset-profile/assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset-profile/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset-profile/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset-profile/assets/css/style.css')}}">
    <title>پروفایل </title>
</head>
<body>

<!-- end main menu -->

<main><!-- start main -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            @include('profile.side')
            <div class="col-lg-9">
            @yield('content')<!-- end personal info edit box -->
            </div>
        </div>
    </div>
    </div>
</main><!-- end main -->

<script src="{{asset('asset-profile/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('asset-profile/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('asset-profile/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('asset-profile/assets/js/jquery.simple.timer.js')}}"></script>
<script src="{{asset('asset-profile/assets/js/script.js')}}"></script>
</body>

<!- https://t.me/sabzrea ->
</html>
