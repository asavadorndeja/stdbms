@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>Human resource: Edit</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('hrl1.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::model($hrl1, ['method'=>'PATCH', 'route' => ['hrl1.update', $hrl1->name], 'class' => 'form-horizontal']) !!}

<div class="container">

  <div class="form-group">
    {!! Form::label('name', 'User name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('name', $hrl1->name, ['required', 'class' => $Col2, 'readonly']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Firstname', 'First name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Firstname', $hrl1->hrl1FirstName, ['required', 'class' => $Col2, 'placeholder' => 'First name']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Lastname', 'Last name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Lastname', $hrl1->hrl1LastName, ['required', 'class' => $Col2,'placeholder' => 'Last name']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Address', 'Address', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Address', $hrl1->hrl1Address, ['required', 'class' => $Col2,'placeholder' => 'Address']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Email', 'Email', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Email', $hrl1->hrl1Email, ['required', 'class' => $Col2,'placeholder' => 'Peronnal email']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Tel1', 'Telehone 1', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Tel1', $hrl1->hrl1Tel1, ['required', 'class' => $Col2,'placeholder' => 'Telephone number 1']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Tel2', 'Telehone 2', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1Tel2', $hrl1->hrl1Tel2, ['class' => $Col2,'placeholder' => 'Telephone number 2']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Thai ID', 'ID Card No.', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1ThaiID', $hrl1->hrl1ThaiID, ['required', 'class' => $Col2, 'placeholder' => 'Thai national card ID' ,'maxlength' => '13']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1EmeFirstname', 'Contact first name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeFirstname', $hrl1->hrl1EmeFirstName, ['required', 'class' => $Col2,'placeholder' => 'Emergency contact first name']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1EmeLastname', 'Contact last name', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeLastname', $hrl1->hrl1EmeLastName, ['required', 'class' => $Col2,'placeholder' => 'Emergency contact last name']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1EmeAddress', 'Contact address', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeAddress', $hrl1->hrl1EmeAddress, ['required', 'class' => $Col2, 'placeholder' => 'Emergency contact address']) !!}
    </div>
  </div>

  <!-- <div class="form-group">
    {!! Form::label('hrl1EmeEmail', 'Contact email', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeEmail', $hrl1->hrl1EmeEmail, ['required', 'class' => $Col2, 'placeholder' => 'Emergency contact email']) !!}
    </div>
  </div> -->

  <div class="form-group">
    {!! Form::label('hrl1EmeTel1', 'Cotact telehone 1', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeTel1', $hrl1->hrl1EmeTel1, ['class' => $Col2, 'placeholder' => 'Emergency contact telephone number 1']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1EmeTel2', 'Contact telehone 2', ['class' => $Col1]) !!}
    <div class='col-md-10'>
    {!! Form::Text('hrl1EmeTel2', $hrl1->hrl1EmeTel2, ['class' => $Col2, 'placeholder' => 'Emergency contacct telephone number 2']) !!}
    </div>
  </div>

  @if($userHR >=2)

  <div class="form-group">
    {!! Form::label('hrl1DateStart', 'Start working date:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      <input type="date" class="form-control" id="hrl1DateStart" name="hrl1DateStart" value="{{ $hrl1->hrl1DateStart }}" date-format="DD MMMM YYYY">
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1DateEnd', 'End working date:', ['class' => $Col1]) !!}
    <div class='col-md-10'>
      <input type="date" class="form-control" id="hrl1DateEnd" name="hrl1DateEnd" value="{{ $hrl1->hrl1DateEnd }}" date-format="DD MMMM YYYY">
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Role1', 'Employee role 1:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="hrl1Role1" id="hrl1Role1" class="form-control input-md">
            @foreach($hrRoles as $hrRole)
              <option value="{{ $hrRole }}" {{ $hrRole  === $hrl1->hrl1Role1? 'selected' : '' }}>{{ $hrRole }}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Role1', 'Employee role 2:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="hrl1Role2" id="hrl1Role2" class="form-control input-md">
            @foreach($hrRoles as $hrRole)
              <option value="{{ $hrRole }}" {{ $hrRole  === $hrl1->hrl1Role2? 'selected' : '' }}>{{ $hrRole }}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Discipline', 'Employee discipline:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="hrl1Discipline" id="hrl1Discipline" class="form-control input-md">
            @foreach($hrDisciplines as $hrDiscipline)
              <option value="{{ $hrDiscipline }}" {{ $hrDiscipline  === $hrl1->hrl1Discipline? 'selected' : '' }}>{{ $hrDiscipline }}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Category', 'Employee category:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        <select name="hrl1Category" id="hrl1Category" class="form-control input-md">
            @foreach($hrCategories as $hrCategory)
              <!-- <option value="{{ $hrCategory->id }}" {{ $hrCategory->id  === $hrl1->hrl1Category? 'selected' : '' }}>{{ $hrCategory->hrl1Category }}</option> -->
              <option value="{{ $hrCategory->hrl1Category }}" {{ $hrCategory->hrl1Category  === $hrl1->hrl1Category? 'selected' : '' }}>{{ $hrCategory->hrl1Category }}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Position', 'Employee position:', ['class' => $Col1]) !!}
    <div class="col-md-10">
      <select name="hrl1Position" id="hrl1Position" class="form-control input-md">
          @foreach($hrPositions as $hrPosition)
            <option value="{{ $hrPosition->hrl1Position }}" {{ $hrPosition->hrl1Position  === $hrl1->hrl1Position? 'selected' : '' }}>{{ $hrPosition->hrl1Position }}</option>
          @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Grade', 'Employee grade:', ['class' => $Col1]) !!}
    <div class="col-md-10">
        {!! Form::Text('hrl1Grade', null, ['maxlength' => '2', 'class' => $Col2, 'placeholder' => 'Employee grade', 'readonly']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('hrl1Supervisor', 'Employee supvervisor:', ['class' => $Col1]) !!}
    <div class="col-md-10">
      <select name="hrl1Supervisor" id="hrl1Supervisor" class="form-control input-md">
          @foreach($hrSupervisors as $hrSupverisor)
            <option value="{{ $hrSupverisor->name }}" {{ $hrSupverisor->name  === $hrl1->hrl1Supervisor? 'selected' : '' }}>{{ $hrSupverisor->name }}</option>
          @endforeach
        </select>
    </div>
  </div>

  @endif

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Update', ['class' => 'btn btn-primary btn-md'] ) !!}
    </div>
  </div>

</div>

{!! Form::close() !!}

@endsection

@section('script')

<script type="text/javascript">

  $('#hrl1Category').on('change', function(e){
      // console.log(e);
      var hrl1Category = e.target.value;
      console.log(hrl1Category);
      loadhrl1Position(hrl1Category);
  });

  function loadhrl1Position(hrl1Category){
    $.get("{{ url('api/StaffPosition') }}/"+hrl1Category, function(data){
        $('#hrl1Position').empty();
        console.log(data);
        $.each(data, function(index, subCatObj){
          $('#hrl1Position').append('<option value="'+subCatObj.hrl1Position+'">'+subCatObj.hrl1Position+'</option>');
        });
        console.log(hrl1Grade);
      });

    $('#hrl1Position').on('change', function(e){
        console.log(e);
        var hrl1Grade = e.target.value;
        $('#hrl1Grade').val(hrl1Grade);
        console.log(hrl1Grade);
      });

  }


</script>
@endsection
