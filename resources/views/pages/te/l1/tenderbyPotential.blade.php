@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Tender: Tender by potentials</h1>
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
    <div class="panel-heading">Tender statistical: tender quantity by potentials (Unit: Each)</div>

      <div class="panel-body">

        <table class="table table-hover table-striped">
            <thead>
              <tr>
                  <th>Description</th>
                  <th>{{ date("M-Y",strtotime("-4 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-3 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-2 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-1 month")) }}</th>
                  <th>{{ date("M-Y") }}</th>
              </tr>
            </thead>

            @foreach ($dataQtyPotential as $row)
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
    <div class="panel-heading">Tender statistical: tender price by potentials (Unit: Million THB)</div>

      <div class="panel-body">

        <table class="table table-hover table-striped">
            <thead>
              <tr>
                  <th>Description</th>
                  <th>{{ date("M-Y",strtotime("-4 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-3 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-2 month")) }}</th>
                  <th>{{ date("M-Y",strtotime("-1 month")) }}</th>
                  <th>{{ date("M-Y") }}</th>
              </tr>
            </thead>

            @foreach ($dataPrcPotential as $row)
              <tr>
                <td>{{ $row[0] }}</td>
                <td>{{ round($row[1]/1000000,2) }}</td>
                <td>{{ round($row[2]/1000000,2) }}</td>
                <td>{{ round($row[3]/1000000,2) }}</td>
                <td>{{ round($row[4]/1000000,2) }}</td>
                <td>{{ round($row[5]/1000000,2) }}</td>
            @endforeach
          </table>

      </div>

  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Tender statistical: tender factor price by potentials (Unit: Million THB)</div>

      <div class="panel-body">

        <div id="app">
            {!! $chart->container() !!}
        </div>

      </div>

</div>

@endsection

@section('script')

<script src="https://unpkg.com/vue"></script>

<script>
    var app = new Vue({
        el: '#app',
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

{!! $chart->script() !!}

@endsection
