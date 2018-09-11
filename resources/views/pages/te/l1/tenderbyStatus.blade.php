@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Tender: Tender by statuses</h1>
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

<hr>

<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading">Tender statistical: tender quantity (Unit:Each)</div>

      <div class="panel-body">

        <table class="table table-hover table-striped">
            <thead>
              <tr>
                  <th>Description</th>
                  <th>Since 2015</th>
                  <th>Year {{ date("Y",strtotime("-1 year")) }}</th>
                  <th>Year {{ date("Y") }}</th>
                  <th>{{ date("M-Y",strtotime("-1 month")) }}</th>
                  <th>{{ date("M-Y") }}</th>
              </tr>
            </thead>

            @foreach ($dataQty as $row)
              <tr>
                <td>{{ $row[0] }}</td>
                <td>{{ $row[1] }}</td>
                <td>{{ $row[2] }}</td>
                <td>{{ $row[3] }}</td>
                <td>{{ $row[4] }}</td>
                <td>{{ $row[5] }}</td>
              </tr>
            @endforeach
          </table>

      </div>

  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Tender statistical: tender cost (Unit: Million THB)</div>

      <div class="panel-body">

        <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Description</th>
                <th>Since 2015</th>
                <th>Year {{ date("Y",strtotime("-1 year")) }}</th>
                <th>Year {{ date("Y") }}</th>
                <th>{{ date("M-Y",strtotime("-1 month")) }}</th>
                <th>{{ date("M-Y") }}</th>
              </tr>
            </thead>

            @foreach ($dataPrice as $row)
              <tr>
                <td>{{ $row[0] }}</td>
                <td>{{ round($row[1]/1000000,2) }}</td>
                <td>{{ round($row[2]/1000000,2) }}</td>
                <td>{{ round($row[3]/1000000,2) }}</td>
                <td>{{ round($row[4]/1000000,2) }}</td>
                <td>{{ round($row[5]/1000000,2) }}</td>
              </tr>
            @endforeach
          </table>

      </div>

  </div>


</div>

@endsection
