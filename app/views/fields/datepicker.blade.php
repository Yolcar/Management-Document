{{ Form::label($name, $label) }}
<div class="form-group input-group date">
    {{ $control }}<span class="glyphicon glyphicon-calendar input-group-addon"></span>
    @if( isset($error) )
        <div class="alert alert-danger">{{$error}}</div>
    @endif
</div>

