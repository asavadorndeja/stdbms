@extends('layouts.app')

@section('content')

<div class="Container">

  <div class="container">
    <div class="col-md-12">
      <h1>CTR: Index</h1>
    </div>
  </div>
  <div class="container">
      <div class="col-md-12">
        <div class="btn-group btn-sm" role="group">
          <a class="btn btn-primary" href="{{ route('pel1.index') }}">Back</a>
          <a class="btn btn-primary" href="{{ route('pel2.create', ['id'=>$tel1Number]) }}">Create</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

  <table class="table table-hover table-striped">
      <thead>
        <tr>
            <th>Project number</th>
            <th>CTR number</th>
            <th>Title</th>
            <!-- <th>Desciption</th> -->
            <th>Budget hours</th>
            <th>Action</th>
            <th></th>
        </tr>
      </thead>

      @foreach ($pel2s as $row)
        <tr>
          <td>{{ $tel1Number }}</td>
          <td>{{ $row->pel2Number }}</td>
          <td>{{ $row->pel2Title }}</td>
          <!-- <td>{{ $row->pel2Desciption }}</td> -->
          <td>{{ $row->pel2Budget }}</td>
          <td>
              <a class="btn btn-primary btn-xs" href="{{ route('pel2.edit', $row->id) }}">Edit</a>
              <!-- <a class="btn btn-danger btn-xs" href="{{ route('pel2.destroy', $row->id) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?">Delete</a> -->
          </td>
          <td>
              {{ Form::open(array('route' => array('pel2.destroy', $row->id), 'method' => 'delete')) }}
                  <button class="btn btn-danger btn-xs" type="submit" >Delete</button>
              {{ Form::close() }}

          </td>

        </tr>
      @endforeach
    </table>

</div>

@endsection
