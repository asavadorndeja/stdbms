@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Timesheet: index</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="{{ route('pel4.index') }}">Back</a>
          <!-- <a class="btn btn-primary" href="{{ route('pel4.create') }}">Create</a>
          @if ($userPE>1)

            <a class="btn btn-primary" href="{{ route('pel4.edit', ['id'=>$userName]) }}">Edit</a>
            <a class="btn btn-primary" href="/pel4IndexDelete">Delete</a>

          @endif -->

        </div>

        <!-- <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/pel4ExportUser/{{ $dateFrom }}">Report</a>
        </div> -->

      </div>
    </div>
  </div>

<hr>

</div>


<div class="container">

  <div class="panel panel-primary">
      <div class="panel-heading">Timesheet data selection</div>

      <div class="panel-body">

  <form method="get" action="{{ action('pel4Controller@indexDelete') }}" class="form-horizontal">

    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-md-1 control-label">
        <label>From</label>
      </div>
      <div class='col-md-3'>
        <input type="date" class="form-control" id="dateFrom" name="dateFrom" value="{{ $dateFrom }}" date-format="DD MMMM YYYY">
      </div>
      <div class="col-md-1 control-label">
        <label>To:</label>
      </div>
      <div class='col-md-3'>
        <input type="date" class="form-control" id="dateTo" name="dateTo" value="{{ $dateTo }}" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <button type="Submit" value="Submit" class="btn btn-primary">Refresh</button>
      </div>
    </div>

  </form>
</div>

</div>
</div>

<div class="container">
  <div class="panel panel-primary">

      <div class="panel-heading">Timesheet data</div>

      <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
              <tr>
                  <th>id</th>
                  <th>Project number</th>
                  <th>CTR number</th>
                  <th>Date</th>
                  <th>Hour(s)</th>
                  <th>Status</th>
                  <th>Create by</th>
                  <th>Approve by</th>
                  <th>Delete</th>
                  <!-- <th>Create by</th>
                  <th>Approve by</th> -->
              </tr>
            </thead>

            @foreach ($pel4s as $row)
              <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->tel1Number }}</td>
                <td>{{ $row->pel2Number }}</td>
                <!-- <td>{{ $row->tsDate }}</td> -->
                <td>{{ Carbon\Carbon::parse($row->pel4Date )->format('d-M-y') }}</td>
                <td>{{ $row->pel4Hour }}</td>
                <td>{{ $row->pel4Status }}</td>
                <td>{{ $row->create_by }}</td>
                <td>{{ $row->approve_by }}</td>
                  <td>
                    {{ Form::open(array('route' => array('pel4.destroy', $row->id), 'method' => 'delete')) }}
                          <button class="btn btn-danger btn-xs" type="submit" >Delete</button>
                    {{ Form::close() }}
                  </td>
            @endforeach
          </table>
        </div>

      </div>



</div>
@endsection

@section('script')

<!-- <script type="text/javascript">


  $('#dateFrom').on('change', function(e){
      // console.log(e);
      var dateFrom = document.getElementById("dateFrom").value;
      console.log(dateFrom);
      $('#dateFromExport').val(dateFrom);
      durationCalculation();

      });


  $('#dateTo').on('change', function(e){
      // console.log(e);
      var dateTo = document.getElementById("dateTo").value;
      console.log(dateTo);
      $('#dateToExport').val(dateTo);
      durationCalculation();

      });


      function durationCalculation(){
        var dateStart = new Date (document.getElementById("dateFrom").value);
        var dateFinish = new Date(document.getElementById("dateTo").value);

        if (dateFinish < dateStart) {
          // alert('check')
          $('#dateTo').val(formatDate(dateStart));
        }

        if (dateFinish > dateStart) {
          // alert('check')
          $('#dateFrom').val(formatDate(dateFinish));
        }

      };




</script> -->


@endsection
