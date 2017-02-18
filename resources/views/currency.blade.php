@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Currency Management</div>
				<br>
				<button id="btn-add" name="btn-add" class="btn btn-primary btn-xm">Add New Currency</button>
				<button id="btn-add" name="btn-add" class="btn btn-danger btn-xm delete-all">Reset</button>
				<div class="panel-body">
					<!-- Load currencies -->
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Currency Name</th>
								<th>Code</th>
								<th>Rate to USD</th>
								<th>Date Created</th>
								<th>Date Updated</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody id="currency-list" name="currency-list">
							@foreach ($currencies as $currency)
							<tr id="currency{{$currency->id}}">
								<td>{{$currency->id}}</td>
								<td>{{$currency->name}}</td>
								<td>{{$currency->code}}</td>
								<td>{{$currency->rate}}</td>
								<td>{{$currency->created_at}}</td>
								<td>{{$currency->updated_at}}</td>
								<td>
									<button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$currency->id}}">Edit</button>
									<button class="btn btn-danger btn-xs btn-delete delete-currency" value="{{$currency->id}}">Delete</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					
					<!-- Modal to edit currency details -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
									<h4 class="modal-title" id="myModalLabel">Currency Editor</h4>
								</div>
								<div class="modal-body">
									<form id="frmCurrencies" name="frmCurrencies" class="form-horizontal" novalidate="">

										<div class="form-group error">
											<label for="name" class="col-sm-3 control-label">Name</label>
											<div class="col-sm-9">
												<input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="">
											</div>
										</div>

										<div class="form-group">
											<label for="code" class="col-sm-3 control-label">Code</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="code" name="code" placeholder="Code" value="">
											</div>
										</div>
										
										<div class="form-group">
											<label for="rate" class="col-sm-3 control-label">Rate to USD</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="rate" name="rate" placeholder="Rate" value="">
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
									<input type="hidden" id="currency_id" name="currency_id" value="0">
								</div>
							</div>
						</div>
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
<script src="{{asset('js/currency.js')}}"></script>
@endsection