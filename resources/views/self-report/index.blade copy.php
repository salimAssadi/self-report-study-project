<!DOCTYPE html>
<html lang="{{ auth()->user()->lang == 'arabic' ? 'ar' : 'en' }}">

<head>
    <title>{{ $pageTitle }}</title>
    <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('self-report.partials.pdf-styles-advance')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet">
    @if (auth()->user()->lang == 'arabic')
        <style>
            body {
                font-family: 'Cairo', sans-serif;
                direction: rtl
            }
        </style>
    @endif


</head>

<body>


    @include('self-report.partials.header')

        <div class="cover-page">
           @if(isset($coverimgBase64))
                <img src="data:image/jpeg;base64,{{$coverimgBase64}}" alt="Cover Image" class="cover-img">
            @endif
        </div>
        <div class="cover-page">
            @if(isset($coverimg2Base64))
                <img src="data:image/jpeg;base64,{{$coverimg2Base64}}" alt="Cover Image" class="cover-img">
            @endif
        </div>
    {{-- @include('self-report.partials.footer') --}}

    {{-- <div style="page-break-before: always;"></div> --}}
    {{-- info --}}
    {{-- <main>
        @include('self-report.partials.info')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- report guidelines --}}
    <main>
        @include('self-report.partials.report_guidelines')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- executive summary --}}
    <main>
        @include('self-report.partials.executive_sammary')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- profile --}}
    <main>
        @include('self-report.partials.profile')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- statistics data --}}
    <main>
        @include('self-report.partials.statistics_data')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- kpis --}}
    <main>
        @include('self-report.partials.kpis')
    </main>
    <div style="page-break-before: always;"></div>

    standards --}}
    <main>
        @include('self-report.partials.standard')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- independent evaluations --}}
    <main>
        @include('self-report.partials.Independent_evaluations')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- executive recommendations --}}
    <main>
        @include('self-report.partials.recommendation_info')
    </main>
    <div style="page-break-before: always;"></div>

    {{-- attachments --}}
    <main>
        @include('self-report.partials.attachment')
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
