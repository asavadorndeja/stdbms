@extends('layouts.app')

@section('content')

<?php $Col1 = 'col-md-2 control-label'; ?>
<?php $Col2 = 'form-control'; ?>

<div class="container">
  <div class="col-md-12">
    <h1>Tender: Edit</h1>
  </div>
    <div class="col-md-6">
      <a class="btn btn-primary btn-md" href="{{ route('tel1.index') }}">Back</a>
    </div>
  </div>
</div>

<hr>

{!! Form::model($tel1, ['method'=>'PATCH', 'route' => ['tel1.update', $tel1->id], 'class' => 'form-horizontal']) !!}

<div class="container">


  <div class="panel panel-primary">
    <div class="panel-heading">Tender data edit</div>

      <div class="panel-body">


        <div class="form-group">
          {!! Form::label('tel1ID', 'Tender ID:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
          {!! Form::Text('tel1Number', null, ['required', 'maxlength' => '6', 'class' => $Col2, 'readonly']) !!}
          </div>

          {!! Form::label('tel1Title', 'Title:', ['class' => $Col1]) !!}
          <div class='col-md-6'>
            {!! Form::Text('tel1Title', null, ['required', 'class' => $Col2, 'placeholder' => 'Title']) !!}
          </div>
        </div>


        <div class="form-group">
          {!! Form::label('tel1Client', 'Client:', ['class' => $Col1]) !!}
          <div class='col-md-10'>
          {!! Form::Text('tel1Client', null, ['required', 'class' => $Col2, 'placeholder' => 'Client']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('tel1ClientRef', 'Client Ref.:', ['class' => $Col1]) !!}
          <div class='col-md-10'>
          {!! Form::Text('tel1ClientRef', null, ['class' => $Col2, 'placeholder' => 'Client Ref.']) !!}
          </div>
        </div>

        <!-- <div class="form-group">
          {!! Form::label('tel1Service', 'Services:', ['class' => $Col1]) !!}
          <div class='col-md-10'>
          {!! Form::Text('tel1Service', null, ['required', 'class' => $Col2, 'placeholder' => 'Services']) !!}
          </div>
        </div> -->

        <div class="form-group">
          {!! Form::label('tel1Service', 'Services:', ['class' => $Col1]) !!}

          <div class="col-md-10">
            <select name="tel1Service" id="tel1Service" class="form-control input-md">
              @foreach($teServices as $teService)
                @if($teService == $tel1->tel1Service)
                  <option selected value="{{ $teService }}">{{ $teService }}</option>
                @else
                  <option value="{{ $teService }}">{{ $teService }}</option>
                @endif
              @endforeach
              </select>
          </div>
        </div>


        <div class="form-group">
          {!! Form::label('tel1Phase', 'Phases:', ['class' => $Col1]) !!}

          <div class="col-md-10">
            <select name="tel1Phase" id="tel1Phase" class="form-control input-md">
              @foreach($tePhases as $tePhase)
                @if($tePhase == $tel1->tel1Phase)
                  <option selected value="{{ $tePhase }}">{{ $tePhase }}</option>
                @else
                  <option value="{{ $tePhase }}">{{ $tePhase }}</option>
                @endif
              @endforeach
              </select>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('teStatus', 'Status:', ['class' => $Col1]) !!}

          <div class="col-md-2">
            <select name="tel1Status" id="tel1Status" class="form-control input-md">
                @foreach($teStatuses as $teStatus)
                  @if($teStatus == $tel1->tel1Status)
                    <option selected value="{{ $teStatus }}">{{ $teStatus }}</option>
                  @else
                    <option value="{{ $teStatus }}">{{ $teStatus }}</option>
                  @endif
                @endforeach
              </select>
        </div>
      <!-- </div>

      <div class="form-group"> -->
        {!! Form::label('tel1Potential', 'Potential:', ['class' => $Col1]) !!}

      <div class="col-md-2">
        <select name="tel1Potential" id="tel1Potential" class="form-control input-md">
            @foreach($tePotentials as $tePotential)
              @if($tePotential == $tel1->tel1Potential)
                <option selected value="{{ $tePotential }}">{{ $tePotential }}</option>
              @else
                <option value="{{ $tePotential }}">{{ $tePotential }}</option>
              @endif
            @endforeach
          </select>

      </div>
    </div>

    <div class="form-group">
      {!! Form::label('tel1BidMethod', 'Bid method:', ['class' => $Col1]) !!}

      <div class="col-md-2">
        <select name="tel1BidMethod" id="tel1BidMethod" class="form-control input-md">
            @foreach($teBidMethods as $teBidMethod)
              @if($teBidMethod == $tel1->tel1BidMethod)
                <option selected value="{{ $teBidMethod }}">{{ $teBidMethod }}</option>
              @else
                <option value="{{ $teBidMethod }}">{{ $teBidMethod }}</option>
              @endif
            @endforeach
          </select>
    </div>
    <!-- </div>

    <div class="form-group"> -->
      {!! Form::label('tel1BidCompetitor', 'Bid competitor:', ['class' => $Col1]) !!}

    <div class="col-md-2">
      <select name="tel1BidCompetitor" id="tel1BidCompetitor" class="form-control input-md">
          @foreach($teBidCompetitors as $teCompetitor)
            @if($teCompetitor == $tel1->tel1BidCompetitor)
              <option selected value="{{ $teCompetitor }}">{{ $teCompetitor }}</option>
            @else
              <option value="{{ $teCompetitor }}">{{ $teCompetitor }}</option>
            @endif
          @endforeach
        </select>

    </div>
  </div>


  </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Tender data status date</div>

      <div class="panel-body">

      <div class="form-group">

          {!! Form::label('tel1DateInquiry', 'Inquiry date:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <input type="date" class="form-control" id="tel1DateInquiry" name="tel1DateInquiry" value="{{ $tel1->tel1DateInquiry }}" date-format="DD MMMM YYYY">
        </div>

          {!! Form::label('tel1DateInquiryDueDate', 'Inquiry due date:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            <input type="date" class="form-control" id="tel1DateInquiryDueDate" name="tel1DateInquiryDueDate" value="{{ $tel1->tel1DateInquiryDueDate }}" date-format="DD MMMM YYYY">
          </div>


        {!! Form::label('tel1DateSubmit', 'Submission date:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <input type="date" class="form-control" id="tel1DateSubmit" name="tel1DateSubmit" value="{{ $tel1->tel1DateSubmit }}" date-format="DD MMMM YYYY">
        </div>

      </div>

      <div class="form-group">

        {!! Form::label('tel1DateHold', 'Hold date:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <input type="date" class="form-control" id="tel1DateHold" name="tel1DateHold" value="{{ $tel1->tel1DateHold }}" date-format="DD MMMM YYYY">
        </div>

        {!! Form::label('tel1DateTurnDown', 'Turndown date:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <input type="date" class="form-control" id="tel1DateTurnDown" name="tel1DateTurnDown" value="{{ $tel1->tel1DateTurnDown }}" date-format="DD MMMM YYYY">
        </div>

        {!! Form::label('tel1DateAward', 'Award date:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <input type="date" class="form-control" id="tel1DateAward" name="tel1DateAward" value="{{ $tel1->tel1DateAward }}" date-format="DD MMMM YYYY">
        </div>

      </div>


      <div class="form-group">

          {!! Form::label('tel1DateComplete', 'Complete date:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            <input type="date" class="form-control" id="tel1DateComplete" name="tel1DateComplete" value="{{ $tel1->tel1DateComplete }}" date-format="DD MMMM YYYY">
          </div>

        {!! Form::label('tel1ReasonTurndown', 'Turndorn reason:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <select name="tel1ReasonTurndown" id="tel1ReasonTurndown" class="form-control input-md">
            @foreach($teReasons as $teReason)
              @if($teReason == $tel1->tel1ReasonTurndown)
                <option selected value="{{ $teReason }}">{{ $teReason }}</option>
              @else
                <option value="{{ $teReason }}">{{ $teReason }}</option>
              @endif
            @endforeach
          </select>
        </div>

        {!! Form::label('tel1SuccessBidder', 'Succesful bidder:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          {!! Form::Text('tel1SuccessBidder', null, ['class' => $Col2]) !!}
        </div>

      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">Tender data price</div>

      <div class="panel-body">
      <div class="form-group">

        {!! Form::label('tel1Price', 'Price:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            {!! Form::Number('tel1Price', null, ['class' => $Col2]) !!}
          </div>

        {!! Form::label('tel1Currency', 'Currency:', ['class' => $Col1]) !!}
        <div class='col-md-2'>
          <select name="tel1Currency" id="tel1Currency" class="form-control input-md">
              @foreach($Currencies as $Currency)
                @if($Currency == $tel1->tel1Currency)
                  <option selected value="{{ $Currency }}">{{ $Currency }}</option>
                @else
                  <option value="{{ $Currency }}">{{ $Currency }}</option>
                @endif
              @endforeach
            </select>
        </div>

        {!! Form::label('tel1CurrencyConversion', 'Conversion Rate:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            {!! Form::Number('tel1CurrencyConversion', null, ['class' => $Col2]) !!}
          </div>

        </div>

        <div class="form-group">

          {!! Form::label('tel1PriceTHB', 'Price (THB):', ['class' => $Col1]) !!}
            <div class='col-md-2'>
              {!! Form::Number('tel1PriceTHB', null, ['class' => $Col2]) !!}
            </div>
      </div>

    </div>

    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">Tender forecast</div>
        <div class="panel-body">
          <div class="form-group">

          {!! Form::label('tel1FcDateStart', 'Start date:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            <input type="date" class="form-control" id="tel1FcDateStart" name="tel1FcDateStart" value="{{ $tel1->tel1FcDateStart }}" date-format="DD MMMM YYYY">
          </div>

          {!! Form::label('tel1FcDateFinish', 'Finish date:', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            <input type="date" class="form-control" id="tel1FcDateFinish" name="tel1FcDateFinish" value="{{ $tel1->tel1FcDateFinish }}" date-format="DD MMMM YYYY">
          </div>

          {!! Form::label('tel1FcDuration', 'Duration (days):', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            {!! Form::Number('tel1FcDuration', null, ['class' => $Col2,'readonly']) !!}
          </div>
        </div>

          <div class="form-group">


          {!! Form::label('tel1FcManPower', 'Man power (man(s)):', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            {!! Form::Number('tel1FcManPower', null, ['class' => $Col2]) !!}
          </div>

          {!! Form::label('tel1FcManHour', 'Man hour (hour(s)):', ['class' => $Col1]) !!}
          <div class='col-md-2'>
            {!! Form::Number('tel1FcManHour', null, ['class' => $Col2]) !!}
          </div>

      </div>

    </div>
  </div>


  <div class="panel panel-primary">
    <div class="panel-heading">Tender note</div>
      <div class="panel-body">
        <div class="form-group">
          {!! Form::label('tel1Note', 'Note:', ['class' => $Col1]) !!}

          <div class='col-md-10'>
            {!! Form::Textarea('tel1Note', null, ['class' => $Col2]) !!}
          </div>
        </div>

        </div>

      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Update', ['class' => 'btn btn-primary btn-md'] ) !!}
      </div>
    </div>


</div>

{!! Form::close() !!}


@endsection

@section('script')

<script type="text/javascript">


  $('#tel1Currency').on('click', function(e){
      console.log(e);
      var currency = document.getElementById("tel1Currency").value;
      var price = document.getElementById("tel1Price").value;
      var conversion = document.getElementById("tel1CurrencyConversion").value;

      console.log(price);

      if (currency == 'THB') {
        // alert('check')
        $('#tel1CurrencyConversion').val('1');
        $('#tel1PriceTHB').val(price);
      }

      if (currency != 'THB') {
        // alert('check')
        $('#tel1PriceTHB').val(price*conversion);
      }


      });

  $('#tel1FcDateStart').on('change', function(e){
      console.log(e);
      durationCalculation();
      });

  $('#tel1FcDateFinish').on('change', function(e){
      console.log(e);
      durationCalculation();
      });


      function durationCalculation(){
        var dateStart = new Date (document.getElementById("tel1FcDateStart").value);
        var dateFinish = new Date(document.getElementById("tel1FcDateFinish").value);

        if (dateFinish < dateStart) {
          // alert('check')
          $('#tel1FcDateFinish').val(formatDate(dateStart));
          dateFinish = dateStart;
        }

        var timeDiff = Math.abs(dateFinish.getTime() - dateStart.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        // alert(diffDays);
        console.log(diffDays);
        $('#tel1FcDuration').val(diffDays);
      };




</script>
@endsection
