<!DOCTYPE html>
<html lang="{{ auth()->user()->lang == 'arabic' ? 'ar' : 'en' }}">
    @php
    $settings = settings();
@endphp
<head>
    <title>{{ $pageTitle }}</title>
    <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('self-report.partials.pdf-styles-advance')
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Majalla:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet">
    @if (auth()->user()->lang == 'arabic')
        <style>
            body {
                font-family: 'Majalla', sans-serif;
                direction: rtl
            }
        </style>
    @endif


</head>

<body>


    @include('self-report.partials.header')

    <div>
        <div style="background-color: #4C3D8E; padding: 20px; border-radius: 10px; height: 297mm; width: 100%; margin: auto; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            @if(isset($logoBase64))
                <img src="data:image/png;base64,{{$logoBase64}}" alt="Logo" style="width: 120px; height: auto; margin-top: 270px;margin-right: 275px;">
            @endif
            <div style="text-align: center;">
                <h1 style="margin: 30px 0;  color: #ffffff; font-size: 32px; font-weight: bold;">تقرير الدراسة الذاتية</h1>
                <h2 style="margin: 30px 0; color: #ffffff; font-size: 26px;">لمعهد الدراسات الفنية للقوات الجوية</h2>
                <h3 style="margin: 30px 0; color: #ffffff; font-size: 22px;">مايو ٢٠٢٥ م</h3>
            </div>
        </div>
    </div>
    <div class="cover-page">
        @if(isset($coverimg2Base64))
            <img src="data:image/jpeg;base64,{{$coverimg2Base64}}" alt="Cover Image" class="cover-img">
        @endif
    </div>
    @include('self-report.partials.footer')

    <main>
        @include('self-report.partials.report_start')
    </main>
    <div style="page-break-before: always;"></div>
    <main>
        @include('self-report.partials.standard')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- independent evaluations --}}
    <main>
        @include('self-report.partials.report_end')
    </main>





















    @include('self-report.partials.footer')

    @if (auth()->user()->lang != 'arabic')
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    @endif

</body>

</html>
