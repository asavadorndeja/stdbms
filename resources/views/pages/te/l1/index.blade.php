@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Tender: Index</h1>
    </div>
  </div>


  <div class="container">

      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/home">Back</a>
            <a class="btn btn-primary" href="{{ route('tel1.create') }}">Create</a>
        </div>
          <div class="btn-group btn-sm" role="group">
            <a class="btn btn-primary" href="/tel1Export" ><i class="icon-download-alt"> </i>Export</a>
          </div>
          <!-- <div class="btn-group btn-sm" role="group">
            <a class="btn btn-primary" href="/tel1TenderbyStatus" ></i>Tender by status</a>
          </div>
          <div class="btn-group btn-sm" role="group">
            <a class="btn btn-primary" href="/tel1TenderbyPotential" ></i>Tender by potential</a>
          </div> -->
          <!-- <div class="btn-group btn-sm" role="group">
            <a class="btn btn-primary" href="/tel1Chart" ></i>Chart</a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

  <div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Tender data selection</div>

        <div class="panel-body">

    <form method="get" action="{{ action('tel1Controller@index') }}" class="form-horizontal">

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
      <!-- </div>

      <div class="form-group"> -->


      <div class="col-md-1 control-label">
        <label>Status:</label>
      </div>

        <div class="col-md-3">
          <select name="selectedStatus" id="selectedStatus" class="form-control input-md">
            @foreach($teStatuses as $teStatus)
              @if($teStatus == $selectedStatus)
                <option selected value="{{ $teStatus }}">{{ $selectedStatus }}</option>
              @else
                <option value="{{ $teStatus }}">{{ $teStatus }}</option>
              @endif
            @endforeach
            </select>
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
      <div class="panel-heading">Tender index</div>

      <div class="panel-body">


  <table class="table table-hover table-striped">
      <thead>
        <tr>
            <th>Tender number</th>
            <th>Tender title</th>
            <th>Client</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
      </thead>

      @foreach ($tel1s as $row)
        <tr>
          <td>{{ $row->tel1Number }}</td>
          <td>{{ $row->tel1Title }}</td>
          <td>{{ $row->tel1Client }}</td>
          <td>{{ $row->tel1Status }}</td>
          <td>
              <a class="btn btn-primary btn-xs" href="{{ route('tel1.edit', ['id'=>$row->id]) }}">Edit</a>
          </td>

          <td>
            @if ($row->tel1Status  == 'Inquiry' or $row->tel1Status  == '' )

              {{ Form::open(array('route' => array('tel1.destroy', $row->id), 'method' => 'delete')) }}
                  <button class="btn btn-danger btn-xs" type="submit" >Delete</button>
              {{ Form::close() }}

            @endif
          </td>

          </tr>
      @endforeach
    </table>

{{ $tel1s->links() }}

</div>
</div>


</div>

@endsection
