@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>Human Resource: Information</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/home">Back</a>
            <!-- <a class="btn btn-primary" href="{{ route('user.create') }}">Create</a> -->
        </div>
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/hrl1Export" ><i class="icon-download-alt"> </i>Export</a>
        </div>
        </div>
      </div>
    </div>
  </div>
<div class="container">


  <table class="table table-hover table-striped">
      <thead>
        <tr>
            <th>User name</th>
            <th>Frist name</th>
            <th>Last name</th>
            <th>Role 1</th>
            <th>Role 2</th>
            <th>Edit</th>
        </tr>
      </thead>

      @foreach ($hrl1 as $row)
        <tr>
          <td>{{ $row->name }}</td>
          <td>{{ $row->hrl1FirstName }}</td>
          <td>{{ $row->hrl1LastName }}</td>
          <td>{{ $row->hrl1Role1 }}</td>
          <td>{{ $row->hrl1Role2 }}</td>
          <td>
              <a class="btn btn-primary btn-xs" href="{{ route('hrl1.edit', ['id'=>$row->name]) }}">Edit</a>
          </td>
          </tr>
      @endforeach
    </table>

</div>
</div>

@endsection
