{{-- First Cover Page --}}
<div >
    <div style="text-align: center;">
       @if(isset($coverimgBase64))
            <img src="data:image/jpeg;base64,{{$coverimgBase64}}" alt="Cover Image" style="width: 100%; margin: 0 auto;">
        @endif
    </div>
</div>

{{-- Second Cover Page --}}
{{-- <div style="page-break-after: always;"> --}}
    <div style="text-align:center;">
        @if(isset($coverimgBase64))
            <img src="data:image/jpeg;base64,{{$coverimgBase64}}" alt="Cover Image" class="cover-img ">
        @endif
    </div>
</div>
