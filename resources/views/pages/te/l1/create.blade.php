@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>Tender: Create</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('tel1.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::open(array('action'=>'tel1Controller@store','class' => 'form-horizontal')) !!}

<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading">Tender data edit</div>

      <div class="panel-body">


        <div class="form-group">
          {!! Form::label('tel1ID', 'Tender ID:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
          {!! Form::Text('tel1Number', $tel1Number, ['required', 'maxlength' => '6', 'class' => $Col2,]) !!}
          </div>

          {!! Form::label('tel1Title', 'Title:', ['class' => $Col1]) !!}
          <div class='col-md-6'>
            {!! Form::Text('tel1Title', null, ['required', 'class' => $Col2, 'placeholder' => 'Title']) !!}
          </div>
        </div>
  </div>
  </div>


    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Create', ['class' => 'btn btn-primary btn-md'] ) !!}
      </div>
    </div>


</div>

{!! Form::close() !!}

<hr>


@endsection
