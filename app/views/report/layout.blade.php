<!DOCTYPE html>
<html class="html">
<head>

    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="generator" content="7.4.30.244"/>
    <title>Reporte Documentos</title>
    <!-- CSS -->
    {{ HTML::style('css/site_global.css') }}
    {{ HTML::style('css/index.css') }}
    {{ HTML::style('style_report/bootstrap.min.css') }}
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    {{ HTML::script('js/jquery-2.1.3.min.js') }}
    {{ HTML::script('style_report/wkhtmltopdf.tablesplit.js') }}
    {{ HTML::style('style_report/style.css') }}
</head>
<body>
    <div class="clearfix colelem" id="pu77"><!-- group -->
        <div class="clip_frame grpelem" id="u77"><!-- image -->
            {{ HTML::image('images/logo.gif',null,['width'=>"93", 'height'=>"91"]) }}
        </div>
        <div class="clearfix grpelem" id="u69-8"><!-- content -->
            <p id="u69-2">INNACO &#45; INDUSTRIA NACIONAL DE CONEXIONES, C.A.</p>
            <p id="u69-4">Fabricantes de Productos de Ferretería</p>
            <p id="u69-6">Barquisimto – Venezuela</p>
        </div>
        <div class="clip_frame grpelem" id="u83"><!-- image -->
            {{ HTML::image('images/logo.gif',null,['width'=>"93", 'height'=>"91"]) }}
        </div>
    </div>
    <div class="clearfix colelem" id="u88-3"><!-- content -->
        @yield('body')
    </div>
</body>
</html>
