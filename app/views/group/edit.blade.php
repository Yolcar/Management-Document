@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <h1 class="page-header">Editar Grupo</h1>
                <div class="col-md-8">
                    {{ Form::model($group,['route' => ['group.update',$group->id], 'method' => 'PUT', 'role' => 'form']) }}

                    {{Field::input('text','name',null)}}

                    <p>
                        <input type="submit" value="Guardar" class="btn btn-custom-edit">
                    </p>
                    {{-- successful message --}}
                    <?php $message = Session::get('message'); ?>
                    @if( isset($message) )
                        <div class="alert alert-success">{{$message}}</div>
                    @endif

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
