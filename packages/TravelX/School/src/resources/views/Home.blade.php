<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('vendor/school/images/logo.png') }}">
    <!-- تحميل ملف CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/school/css/style.css') }}">

    <!-- تحميل ملف JavaScript -->


    <title>School Package</title>
</head>

<body>
    <p class="text1">Hi</p>
    <h1>
        {{$school}}
    </h1>

    <script src="{{ asset('vendor/school/js/main.js') }}"></script>
</body>

</html>
