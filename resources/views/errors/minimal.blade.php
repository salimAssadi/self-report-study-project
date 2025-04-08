<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') &dash; {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset(Storage::url('uploads/logo/favicon.png')) }}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css') }}" />


    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style-error-page.css') }}" id="main-style-link">
</head>

<body>
@yield('content')


</body>
</html>
