@extends('layout')
@extends('sidebar')
@extends('navbar')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1 class="page-header">Actualizar datos</h1>
                <div class="col-md-10">
                    {{Form::model($user,['route' => ['user.updateProfile',$user->id], 'method' => 'PUT', 'role' => 'form'])}}
                    {{Field::input('text','full_name',null)}}
                    {{Field::input('text','email',null)}}
                    {{Field::input('text','password',"")}}
                    {{Field::input('text','password_confirmation',"",['placeholder' => 'Repita la contraseña'])}}

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
            <div class="col-md-5">
                <h1 class="page-header">Grupos:</h1>
                <div class="col-md-10">
                    @if( !$user->groups->isEmpty() )
                        <div class="alert alert-info">Tiene {{$user->groups->count()}} asociado(s)</div>
                        <ul class="list-group">
                            @foreach($user->groups as $group)
                                <li class="list-group-item">{{$group->name}}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-danger">No tiene ningun grupo asignado</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
