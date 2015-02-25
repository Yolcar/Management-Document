<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$document->name}}</title>

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
<div class="image">
    {{ HTML::image('images/logo.gif',null,['width'=>'93', 'height'=>'91', 'align'=>'left']) }}
    {{ HTML::image('images/logo.gif',null,['width'=>'93', 'height'=>'91', 'align'=>'right']) }}
    <div class="small text-center">
        <br><br><br>
        <p>INNACO - INDUSTRIA NACIONAL DE CONEXIONES, C.A.</p>
        <p>Fabricantes de Productos de Ferretería</p>
        <p>Caracas - Venezuela</p>
    </div>
</div>
<br>
<div class="form-group text-center"><!-- content -->
    <div class="form-group text-center">
        <h1 class="page-header">{{$document->name}}</h1>
    </div>
    <br>
    {{$document->body}}
    {{HTML::image($document->workflow->last()->user->sign)}}
    <p>{{$document->workflow->last()->user->full_name}}</p>
    <p>{{$document->workflow->last()->user->cedula}}</p>
    <p>{{$document->workflow->last()->stepdocument->group->name}}</p>
</div>
</body>
</html>