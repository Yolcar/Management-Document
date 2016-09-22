<?php

return [


    'pdf' => [
        'enabled' => true,
         //Linux
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'),
        //Windows
        //'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"',
        'options' => [
            'page-size'        => 'letter',
            'margin-top'       => '10',
            'margin-bottom'    => '30',
            'margin-left'      => '20',
            'margin-right'     => '20',
            'header-font-size' => '8',
            'header-right'     => 'Pagina [page] de [toPage]',
            'header-left'      => '[title] - [date] - [time]',
        ],
    ],
    'image' => [
        'enabled' => true,
        'binary'  => base_path('vendor/h4cc/wkhtmltoimage-i386/bin/wkhtmltoimage-i386'),
        'options' => [],
    ],


];
