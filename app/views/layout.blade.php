<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>{{Config::get('custom.system.app_name')}}</title>

	{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('css/datepicker3.css') }}
	{{ HTML::style('css/dashboard.css') }}
    {{ HTML::style('css/button.css') }}
    {{ HTML::style('css/sidebar.css') }}
    {{ HTML::style('css/font-awesome.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}

    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
	{{ HTML::script('js/jquery-2.1.3.min.js') }}
	{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
	{{ HTML::script('ckeditor/ckeditor.js') }}
	{{ HTML::script('js/bootstrap-datepicker.js') }}
	{{ HTML::script('js/locales/bootstrap-datepicker.es.js') }}
    {{ HTML::script('js/sidebar.js') }}

    <script>
        $(function (){
            $('[data-toggle="popover"]').popover({
                trigger: 'hover',
                'placement': 'top'
            });
        });
    </script>

	@yield('head')
</head>

<body>

@yield('navbar')
<!-- Begin page content -->
<div class="container-fluid">
    <div class="row">
        @yield('sidebar')
        <div class="main col-md-10 col-md-offset-2">
			@yield('body')
		</div>
	</div>
</div>
</body>
</html>
