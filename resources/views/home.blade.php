@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Please select your currency conversion below:</div>
                <div class="panel-body">
					<div class="col-md-4">
						<label for="lastname">From</label>
						<select class="form-control" name="from" id="from">
						  @foreach ($currencies as $id=>$name) 
							<option value="{{ $id }}">{{ $name }}</option>
						  @endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label for="lastname">To</label>
						<select class="form-control" name="to" id="to">
						  @foreach ($currencies as $id=>$name)
							<option value="{{ $id }}">{{ $name }}</option>
						  @endforeach
						</select>
					</div>
					<div class="col-md-7 row extra-bottom-padding">
						<br>
						<label for="amount" class="col-md-4 control-label">Amount</label>
					</div>
					<div class="col-md-8">
						 <input id="amount" type="numeric" class="form-control" name="amount" required>
					</div>
					<div class="col-md-8">
						<br>
						<label for="amount" id="lblamount"></label>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/amount_complete.js')}}"></script>
@endsection
