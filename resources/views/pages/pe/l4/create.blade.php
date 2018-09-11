@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>Timesheet: Create</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('pel4.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">Timesheet data create</div>

        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <div class="col-md-2 control-label">
                <label>Project number</label>
              </div>
              <div class="col-md-4">
                <select name="tel1id" id="tel1id" class="form-control input-md">
                    @foreach($tel1s as $tel1)
                        <option value="{{ $tel1->tel1Number }}">{{ $tel1->tel1Number }}: {{ $tel1->tel1Title }}</option>
                    @endforeach
                  </select>
              </div>


              <div class="col-md-2 control-label">
                <label>CTR number</label>
              </div>
              <div class="col-md-4">
                <select name="pel2id" id="pel2id" class="form-control input-md">
                    @foreach($pel2s as $pel2)
                        <option value="{{ $pel2->id }}">{{ $pel2->pel2Number }}: {{ $pel2->pel2Title }}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-2 control-label">
                <label>Date</label>
              </div>
              <div class='col-md-4'>
                <input type="date" class="form-control" id="pel4Date" name="pel4Date" value="<?php echo date("Y-m-d");?>">

                <!-- {!! Form::date('Date', \Carbon\Carbon::now()) !!} -->
              </div>
              <div class="col-md-2 control-label">
                <label>Hour(s)</label>
              </div>
              <div class='col-md-4'>
                <!-- <input type="text" class="form-control" id="pel4Hour" name="pel4Hour" placeholder="Hour(s)" value="1"> -->
                <!-- {!! Form::Text('pel4Hour', null, ['required', 'class' => $Col2, 'placeholder' => 'Hour']) !!} -->
                <select name="pel4Hour" id="pel4Hour" class="form-control input-md">
                    @foreach($timeItems as $timeItem)
                      @if($timeItem == 1)
                        <option selected value="{{ $timeItem }}">{{ $timeItem }}</option>
                      @else
                        <option value="{{ $timeItem }}">{{ $timeItem }}</option>
                      @endif
                        <!-- <option value="{{ $timeItem }}">{{ $timeItem }}</option> -->
                    @endforeach
                  </select>

              </div>
            </div>

            <div class="form-group">
              <div class="col-md-2 control-label">
                <label>Remark</label>
              </div>
              <div class='col-md-10'>
                <input type="text" class="form-control" id="pel4Remark" name="pel4Remark" placeholder="Remark (Optional)">
                <!-- {!! Form::Text('pel4Remark', null, ['class' => $Col2, 'placeholder' => 'Remark']) !!} -->
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button onclick="newItem()" type="button" class="btn btn-primary">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>



{!! Form::open(['action' => ['pel4Controller@store'], 'class' => 'form-horizontal']) !!}

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Timesheet data submission</div>

      <div class="panel-body">


        <div class="form-group">
          <div class="container">
          <table id="pel4Table" name="pel4Table" class="table table-hover table-striped">
              <thead>
                <tr>
                    <th>Project number</th>
                    <th>CTR Number</th>
                    <th>Date</th>
                    <th>Hour(s)</th>
                    <th>Remark</th>
                    <th>Action</th>
                    <!-- <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> -->
                </tr>
              </thead>
            </table>
            <div class="container">
              <label id='sumHours'>Total hour(s)</label>
            </div>

          {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-md'] ) !!}
          </div>
        </div>

  </div>
  </div>
  </div>

{!! Form::close() !!}

@endsection

@section('script')
<script type="text/javascript">

// $(document).ready( function() {
//     $('#pel4Date').val(new Date().toDateInputValue());
// });​

  $('#tel1id').on('change', function(e){
      console.log(e);
      var tel1Number = e.target.value;
      console.log(tel1Number);
      loadpel2(tel1Number);
  });

  function getSum(){

    var sum = 0;
    var val = 0;

    var table = document.getElementById('pel4Table');
    for (var r = 1, n = table.rows.length; r < n; r++) {
        for (var c = 3, m = 4; c < m; c++) {
            // alert(table.rows[r].cells[c].innerHTML);
            val = Number(table.rows[r].cells[c].innerHTML);
            sum = sum + val;
        }

    console.log(sum);

    var text = "Total hours = " + sum ;

    document.getElementById('sumHours').innerHTML = text;

    }

    // console.log(table);

  }

  function loadpel2(tel1Number){
    $.get("{{ url('api/pel2') }}/"+tel1Number, function(data){
        $('#pel2id').empty();
        // console.log(data);
        $.each(data, function(index, subCatObj){
          $('#pel2id').append('<option value="'+subCatObj.id+'">'+subCatObj.pel2Number+': '+subCatObj.pel2Title+'</option>');
        });
        // console.log(id);
      });

  }

  function newItem()
  {

      var table = document.getElementById("pel4Table");
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var tel1id = document.getElementById("tel1id");
      var pel2id = document.getElementById("pel2id");
      var date = document.getElementById("pel4Date");
      var pel4Hour = document.getElementById("pel4Hour");
      var pel4Remark = document.getElementById("pel4Remark");

      if (pel4Hour.value == "" || Number(pel4Hour.value) < 0.5)
      {
        alert("Please insert hour");
        return false;
      }

      var resolution = Number(pel4Hour.value) % 0.5
      // alert(resolution);

      if (resolution != 0 )
      {
        alert(Number(pel4Hour.value) % 0.5);
        return false;
      }

      var tel1Number = getSelectedText2("tel1id");
      var pel2Number = getSelectedText2("pel2id");
      var tel1Title = getSelectedText1("tel1id");
      var pel2Title = getSelectedText1("pel2id");

      row.insertCell(0).innerHTML= getSelectedText1("tel1id");
      row.insertCell(1).innerHTML= getSelectedText1("pel2id");
      row.insertCell(2).innerHTML= date.value;
      row.insertCell(3).innerHTML= pel4Hour.value;
      row.insertCell(4).innerHTML= pel4Remark.value;
      row.insertCell(5).innerHTML= '<input type="button" class="btn btn-danger btn-xs" value="Delete" onClick="Javacsript:deleteItem(this)">';
      row.insertCell(6).innerHTML= '<input type="hidden" name="data['+rowCount+'][1]" value="'+tel1id.value+'" width=0>';
      row.insertCell(7).innerHTML= '<input type="hidden" name="data['+rowCount+'][2]" value="'+tel1Number+'" width=0>';
      row.insertCell(8).innerHTML= '<input type="hidden" name="data['+rowCount+'][3]" value="'+tel1Title+'" width=0>';
      row.insertCell(9).innerHTML= '<input type="hidden" name="data['+rowCount+'][4]" value="'+pel2id.value+'" width=0>';
      row.insertCell(10).innerHTML= '<input type="hidden" name="data['+rowCount+'][5]" value="'+pel2Number+'" width=0>';
      row.insertCell(11).innerHTML= '<input type="hidden" name="data['+rowCount+'][6]" value="'+pel2Title+'" width=0>';
      row.insertCell(12).innerHTML= '<input type="hidden" name="data['+rowCount+'][7]" value="'+date.value+'" width=0>';
      row.insertCell(13).innerHTML= '<input type="hidden" name="data['+rowCount+'][8]" value="'+pel4Hour.value+'" width=0>';
      row.insertCell(14).innerHTML= '<input type="hidden" name="data['+rowCount+'][9]" value="'+pel4Remark.value+'" width=0>';


            // row.insertCell(6).innerHTML= '<input type="text" name="tel1id['+rowCount+']" value="'+tel1id.value+'">';
            // row.insertCell(7).innerHTML= '<input type="text" name="tel1Number['+rowCount+']" value="'+tel1Number+'">';
            // row.insertCell(8).innerHTML= '<input type="text" name="pel2id['+rowCount+']" value="'+pel2id.value+'">';
            // row.insertCell(9).innerHTML= '<input type="text" name="pel2Number['+rowCount+']" value="'+pel2Number+'">';
            // row.insertCell(10).innerHTML= '<input type="text" name="pel4Date['+rowCount+']" value="'+date.value+'">';
            // row.insertCell(11).innerHTML= '<input type="text" name="pel4Hour['+rowCount+']" value="'+pel4Hour.value+'">';
            // row.insertCell(12).innerHTML= '<input type="text" name="pel4Remark['+rowCount+']" value="'+pel4Remark.value+'">';

      console.log(tel1id);
      getSum();


  }

  function deleteItem(obj) {

      var index = obj.parentNode.parentNode.rowIndex;
      var table = document.getElementById("pel4Table");
      table.deleteRow(index);
      getSum();


  }

  function getSelectedText1(elementId) {
    var elt = document.getElementById(elementId);
    var strAll = String(elt.options[elt.selectedIndex].text);

    if (elt.selectedIndex == -1)
        return null;
    return strAll;
    // return strSplit;
  }

  function getSelectedText2(elementId) {
    var elt = document.getElementById(elementId);
    var strAll = String(elt.options[elt.selectedIndex].text);
    var strSplit = strAll.toString().split(':')[0];
    //

    if (elt.selectedIndex == -1)
        return null;
    return strSplit;

}

</script>
@endsection
