@extends('welcome')

@section('content')


{!! Form::open() !!}

@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

  <div class="input-group">
      <span class="input-group-label"><i class="fa fa-user"></i></span>
      {!! Form::text('username', null, ['class' => 'input-group-field', 'placeholder' => 'Username']) !!}
  </div>
  
  <div class="input-group">
    <span class="input-group-label"><i class="fa fa-lock"></i></span>
      {!! Form::password('password', ['class' => 'input-group-field', 'placeholder' => 'Password']) !!}
  </div>
  
  <div class="input-group-button">
          {!! Form::submit('Login', ['class' => 'button']) !!}
  </div>
  
{!! Form::close() !!}

@stop