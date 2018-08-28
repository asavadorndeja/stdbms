@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>CTR: Create</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary" href="{{ route('pel1.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::open(['action' => ['pel2Controller@store'], 'class' => 'form-horizontal']) !!}

<div class="container">

  <div class="form-group">
    {!! Form::label('Project Number', 'Project Number', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('tel1Number', $tel1Number, ['required', 'class' => $Col2, 'readonly']) !!}
    </div>
  </div>


  <div class="form-group">
    {!! Form::label('CTR Number', 'CTR Number:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      {!! Form::Text('pel2Number', null, ['required', 'class' => $Col2, 'placeholder' => 'CTR ID']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('pel2Title', 'Title:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      {!! Form::Text('pel2Title', null, ['required', 'class' => $Col2, 'placeholder' => 'Title']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('pel2Description', 'Description:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      {!! Form::Text('pel2Description', null, ['class' => $Col2, 'placeholder' => 'Description']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('pel2Budget', 'Budget hour:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      {!! Form::Text('pel2Budget', 0, ['required', 'class' => $Col2, 'placeholder' => 'Budget hours']) !!}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-md'] ) !!}
    </div>
  </div>

</div>

{!! Form::close() !!}


@endsection
