<?php
return [
    'mode'                 => '',
    'format'               => 'A4',
    'default_font_size'    => '14',
    'default_font'         => 'arabic',
    'margin_left'          => 9,
    'margin_right'         => 9,
    'margin_top'           => 35,
    'margin_bottom'        => 10,
    'margin_header'        => 0,
    'margin_footer'        => 0,


    'orientation'          => 'P',
    'title'                => 'RCAT',
    'author'               => 'RCAT',
    'watermark'            => '',
    'show_watermark'       => true,
    'watermark_font'       => 'Arial',
    'display_mode'         => 'fullpage',
    'watermark_text_alpha' => 0.1,
    'custom_font_dir' => resource_path('fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'arabic' => [
            "R"  => "majalla.ttf",
            "B"  => "majallab.ttf",
            "I"  => "ariali.ttf",
            "BI" => "arialbi.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        'icons' => [
            "R" => "fa-regular-400.ttf",
            "B" => "fa-solid-900.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        // 'arabic' => [
        //     "R"=> "NotoNaskhArabic-Normal.ttf",
        //     "B"=>"NotoNaskhArabic-Bold.ttf",
        //     "I"=> "NotoNaskhArabic-Italic.ttf",
        //     "BI"=> "NotoNaskhArabic-BoldItalic.ttf",
        //     'useOTL' => 0xFF,
        //     'useKashida' => 75, // Try disabling Kashida support
        // ],
        // 'almarai' => [
        //     'R'  => 'Almarai-Normal.ttf',    // regular font
        //     'B'  => 'Almarai-Bold.ttf',       // optional: bold font
        //     'I'  => 'Almarai-Italic.ttf',     // optional: italic font
        //     'BI' => 'Almarai-BoldItalic.ttf', // optional: bold-italic font,
        //     'useOTL' => 0xFF,
        //     'useKashida' => 75,
        // ],


    ],
    'auto_language_detection'  => true,
    'temp_dir'               => base_path('temp'),
];
