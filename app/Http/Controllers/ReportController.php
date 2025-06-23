<?php
namespace App\Http\Controllers;
use App\Models\Standard;

use Illuminate\Support\Facades\Storage;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class ReportController extends Controller
{
    public function index()
    {
        $imagePath = public_path('assets/images/headerv2.jpg');
        $coverimg = public_path('assets/images/coverimg1.jpg');
        $watermarkImage  = public_path('assets/images/coverimg1.jpg');
        $coverimg2 = public_path('assets/images/coverimg2.jpg');
        $logo = public_path('assets/images/logo.png');

        if($logo){
            $logoBase64 = base64_encode(file_get_contents($logo));
        }
        if (file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            $base64 = base64_encode($imageData);
        }
        if (file_exists($coverimg)) {
            $coverimgData = file_get_contents($coverimg);
            $coverimgBase64 = base64_encode($coverimgData);
        }
        if (file_exists($coverimg2)) {
            $coverimg2Data = file_get_contents($coverimg2);
            $coverimg2Base64 = base64_encode($coverimg2Data);
        }

        $watermarkBase64 = file_exists($watermarkImage) ? base64_encode(file_get_contents($watermarkImage)) : null;

        $standards = Standard::where('parent_id', null)->with(['children','criteria'])->orderBy('sequence', 'asc')->get();

        $pageTitle = "التقرير الذاتي";
        $pdf = LaravelMpdf::loadView('self-report.index', compact('standards', 'pageTitle', 'base64', 'coverimgBase64', 'coverimg2Base64', 'logoBase64'));

        if ($watermarkBase64) {
            $style = "
            <style>
                @page {
                    background: url('data:image/png;base64,{$watermarkBase64}') no-repeat center center;
                    background-size: cover;
                    margin: 0;
                }
                body {
                    margin: 20mm;
                }
            </style>";
            $pdf->getMpdf()->WriteHTML($style, \Mpdf\HTMLParserMode::HEADER_CSS);
        }
        // return view('self-report.index', compact('standards', 'pageTitle'));
        // $pdf->getMpdf()->SetWatermarkImage( $coverimg, 0.2, '', [140, 100]); // المسار، الشفافية، position, الحجم
        // $pdf->getMpdf()->showWatermarkImage = true;
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="self-report.pdf"'
        ]);
    }
}