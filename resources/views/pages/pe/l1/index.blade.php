@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Project: Index</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/home">Back</a>
            <!-- <a class="btn btn-primary" href="{{ route('pel2.create') }}">Create</a> -->
        </div>
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/pel2Export" ><i class="icon-download-alt"> </i>Export</a>
        </div>
        </div>
      </div>
    </div>
  </div>

<hr>

<div class="container">

  <div class="panel panel-primary">
      <div class="panel-heading">Project index</div>

      <div class="panel-body">

  <table class="table table-hover table-striped">
      <thead>
        <tr>
            <th>Project number</th>
            <th>Project title</th>
            <th>Client</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
      </thead>

      @foreach ($tel1s as $row)
        <tr>
          <td>{{ $row->tel1Number }}</td>
          <td>{{ $row->tel1Title }}</td>
          <td>{{ $row->tel1Client }}</td>
          <td>{{ $row->tel1Status }}</td>
          <td>
              <a class="btn btn-primary btn-xs" href="{{ route('pel2.index', ['tel1Number'=>$row->tel1Number]) }}">Edit</a>
          </td>

          <!-- <td>
            @if ($row->tel1Status  == 'Inquiry' or $row->tel1Status  == '' )

              {{ Form::open(array('route' => array('tel1.destroy', $row->id), 'method' => 'delete')) }}
                  <button class="btn btn-danger btn-xs" type="submit" >Delete</button>
              {{ Form::close() }}

            @endif
          </td> -->

          </tr>
      @endforeach
    </table>

    {{ $tel1s->links() }}

</div>


</div>

@endsection
