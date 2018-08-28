@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>User: Create</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('user.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::open(array('action'=>'userController@store','class' => 'form-horizontal')) !!}

<div class="container">

  <div class="form-group">
    {!! Form::label('name', 'User name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      {!! Form::Text('name', null, ['required', 'maxlength' => '6', 'class' => $Col2, 'placeholder' => 'User name']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('email', 'Email', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <input id="email" type="email" class="form-control" name="email" placeholder="Email">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

  </div>

  <div class="form-group">
    {!! Form::label('password', 'Password', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Create', ['class' => 'btn btn-primary btn-md'] ) !!}
    </div>
  </div>

</div>
{!! Form::close() !!}

@endsection
