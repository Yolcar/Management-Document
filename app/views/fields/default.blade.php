<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ $control }}
    @if( isset($error) )
        <div class="alert alert-danger">{{$error}}</div>
    @endif
</div>