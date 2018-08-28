@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="Container">

<div class="container">
  <div class="col-md-12">
    <h1>Timesheet information: Edit</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('pel4.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>
<div class="container">


<div class="panel panel-primary">

    <div class="panel-heading">Timesheet: Edit</div>

    <div class="panel-body">

      {!! Form::model($pel4s, ['method'=>'PATCH', 'route' => ['pel4.update', 'update'], 'class' => 'form-horizontal']) !!}

      <table class="table table-hover table-striped">
          <thead>
            <tr>
                <th>Supervisee</th>
                <th>Project Number</th>
                <th>CTR Number</th>
                <th>Date</th>
                <th>Hour(s)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
          </thead>

          @foreach ($pel4s as $row)
            <tr>
              <td>{{ $row->create_by }}</td>
              <td>{{ $row->tel1Title }}</td>
              <td>{{ $row->pel2Title }}</td>
              <!-- <td>{{ $row->tsDate }}</td> -->
              <td>{{ Carbon\Carbon::parse($row->pel4Date )->format('d-M-y') }}</td>
              <td>{{ $row->pel4Hour }}</td>
              <td>{{ $row->pel4Status }}</td>
              <td>
                <select name="tsStatus[{{$row->id}}]" class="form-control input-md">
                      <option value="Approved" selected>Approve</option>
                      <option value="Rejected">Reject</option>
                  </select>
              </td>
              <td>{{ $row->tsStatusLog }}</td>
            </tr>
          @endforeach
        </table>

        <div class="form-group">
          <div class="col-sm-12">
            {!! Form::submit('Update', ['class' => 'btn btn-primary'] ) !!}
          </div>
        </div>

      {!! Form::close() !!}
  </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Timesheet data export</div>

    <div class="panel-body">

<form method="get" action="{{ action('pel4Controller@pel4ExportAllUser') }}" class="form-horizontal">

  {{ csrf_field() }}

  <div class="form-group">
    <div class="col-md-1 control-label">
      <label>From</label>
    </div>
    <div class='col-md-3'>
      <input type="date" class="form-control" id="dateFromExport" name="dateFromExport" value="{{ $dateFrom }}">
    </div>
    <div class="col-md-1 control-label">
      <label>To:</label>
    </div>
    <div class='col-md-3'>
      <input type="date" class="form-control" id="dateToExport" name="dateToExport" value="{{ $dateTo }}" >
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
      <button type="Submit" value="Submit" class="btn btn-primary">Timesheet export</button>
    </div>
  </div>

</form>
</div>


</div>
@endsection
