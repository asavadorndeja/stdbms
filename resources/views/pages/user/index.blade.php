@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>User: Index</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/home">Back</a>
          <!-- <a class="btn btn-primary" href="#">Create</a> -->
          <a class="btn btn-primary" href="{{ route('user.create') }}">Create</a>
        </div>
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="/userExport" ><i class="icon-download-alt"> </i>Export</a>
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
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
      </thead>

      @foreach ($users as $row)
        <tr>
          <td>{{ $row->name }}</td>
          <td>{{ $row->email }}</td>
          <td>
              <a class="btn btn-primary btn-xs" href="{{ route('user.edit', ['id'=>$row->id]) }}">Edit</a>
          </td>

          <td>
                {{ Form::open(array('route' => array('user.destroy', $row->id), 'method' => 'delete')) }}
                    <button class="btn btn-danger btn-xs" type="submit" >Delete</button>
                {{ Form::close() }}
          </td>

          </tr>
      @endforeach
    </table>

</div>
</div>

@endsection
