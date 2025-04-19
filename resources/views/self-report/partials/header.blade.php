@php
// $imagePath = public_path('assets/images/headerv2.jpg');
// if (file_exists($imagePath)) {
//     $imageData = file_get_contents($imagePath);
//     $base64 = base64_encode($imageData);
// }
@endphp
<htmlpageheader name="page-header">
<header style="font-weight: bold !important; text-align: center;">
    <img src="data:image/jpeg;base64,{{$base64}}" alt="Header Image" style="width: 100%;">
</header>
</htmlpageheader>