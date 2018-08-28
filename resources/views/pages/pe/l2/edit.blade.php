@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>CTR: Edit</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('pel2.index', ['tel1Number'=>$tel1Number]) }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::model($pel2s, ['method'=>'PATCH', 'route' => ['pel2.update', $pel2s->id], 'class' => 'form-horizontal']) !!}

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
    {!! Form::Text('pel2Number', null, ['required', 'class' => $Col2, 'readonly']) !!}
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
      {!! Form::Text('pel2Budget', null, ['class' => $Col2, 'placeholder' => 'Budget hours']) !!}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Update', ['class' => 'btn btn-primary btn-md'] ) !!}
    </div>
  </div>

{!! Form::close() !!}


@endsection
