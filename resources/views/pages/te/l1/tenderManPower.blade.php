@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Tender: Manpower forecast</h1>
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
    <div class="panel-heading">Man power statistic</div>

      <div class="panel-body">


        <div id="app">
            {!! $ch1a->container() !!}
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

{!! $ch1a->script() !!}

@endsection
