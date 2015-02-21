@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    <style>
        .welcome {
            position: absolute;
            top: 180%;
            margin-top: -100px;
        }

        a, a:visited {
            text-decoration:none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 0 0;
        }
    </style>
@endsection
@section('body')
	<h1 class="page-header">BIENVENIDO</h1>

	<div class="table-responsive">
        <div class="welcome">
            {{ HTML::image('images/innaco.png',null,['width'=>'95%']) }}
        </div>
	</div>
@endsection