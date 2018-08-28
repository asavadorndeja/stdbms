@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>User: Edit</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('user.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::model($user, ['method'=>'PATCH', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal']) !!}

<div class="container">

  <div class="form-group">
    {!! Form::label('name', 'User name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('name', $user->name, ['required', 'class' => $Col2, 'readonly']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('email', 'Email', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('email', $user->email, ['required', 'class' => $Col2, 'readonly']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('password', 'Password', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('password', $user->password, ['required', 'class' => $Col2]) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userAD', 'User admin level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userAD" id="userAD" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userAD? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userTE', 'User tender level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userTE" id="userTE" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userTE? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userPE', 'User project level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userPE" id="userPE" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userPE? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userOU', 'User outsource level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userOU" id="userOU" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userOU? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userDC', 'User document control level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userDC" id="userDC" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userDC? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userHS', 'User safety level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userHS" id="userHS" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userHS? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userHR', 'User human resource level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userHR" id="userHR" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userHR? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userMM', 'User management level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userMM" id="userMM" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userMM? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('userQA', 'User quality level:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="userQA" id="userQA" class="form-control input-md">
            @foreach($levelRange as $row)
              <option value="{{$row}}" {{ $row === $user->userQA? 'selected' : '' }}>{{$row}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Update', ['class' => 'btn btn-primary btn-md'] ) !!}
    </div>
  </div>

</div>
{!! Form::close() !!}

@endsection
