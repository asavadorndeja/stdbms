@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Tender: Report</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/home">Back</a>
        </div>
        </div>
      </div>
    </div>
  </div>
<div class="container">


  <table class="table table-hover table-striped">
      <thead>
        <tr>
            <th>Description</th>
            <th>Since estblish</th>
            <th>Last year</th>
            <th>Last month</th>
            <th>This month</th>
        </tr>
      </thead>

      @foreach ($tenderQtySofar as $row)
        <tr>
          <td>{{ $row }}</td>
          <td>{{ $row }}</td>
        </tr>
      @endforeach
    </table>


</div>



</div>

@endsection
