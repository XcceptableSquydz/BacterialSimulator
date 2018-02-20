@extends('layouts.master-layout')
@section('title')
<title>Administrator Controls</title>
@endsection
@section('script')
<script>
	//When the page loads, load these jquery functions
	$(document).ready(function() {
		//creates the tabs for view database, and managedatabase
		$( function() {
			$("#tabs").tabs();
		});
		//The drop down tabs for each of the functions in view database
		$( function() {
			$("#accordion_view").accordion({
				//collapsible means you can click on a tab and close it
				collapsible: true
			});
		});
		//The drop down tabs for each of the functions in manage database
		$( function() {
			$("#accordion_manage").accordion({
				collapsible: true
			});
		});
	});
</script>
@endsection
@section('content')
<?php $user = Auth::user()?>
@if ($user->user_level >= 1)
<body>
	<div class="container">
		<!-- Creating the tabs -->
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Manage Database</a></li>
				<li><a href="#tabs-2">View Database</a></li>
			</ul>
			<!-- Creating the output in each tab -->
			<div id="tabs-1">
				<!-- Creating the drop downs in each accordion, every new section begins with <h3> -->
					<div id="accordion_manage">
						<h3>Add Pathogen</h3>
						<div>
							<!-- bootstrap formatting to keep the form responsive -->
							<div class="container">
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls') }}">
									<!-- csrf token -->
									{{ csrf_field() }}
									<!-- Creating the label and input for new pathogen name -->
									<div class="form-group">
										<label for="pathogen-name" class="col-md-4 control-label">Pathogen Name</label>
										<div class="col-md-6">
											<input id="pathogen-name" type="text" class="form-control" name="pathogen-name">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen info link -->
									<div class="form-group">
										<label for="info-link" class="col-md-4 control-label">Link to More Information</label>
										<div class="col-md-6">
											<input id="info-link" type="url" class="form-control" name="info-link">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen image link -->
									<div class="form-group">
										<label for="image-link" class="col-md-4 control-label">Link to Pathogen Image</label>
										<div class="col-md-6">
											<input id="image-link" type="url" class="form-control" name="image-link">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen formula -->
									<div class="form-group">
										<label for="formula" class="col-md-4 control-label">Growth Rate Formula</label>
										<div class="col-md-6">
											<input id="formula" type="text" class="form-control" name="formula">
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Add Pathogen
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<h3>Add Food</h3>
						<div>
							<!-- bootstrap formatting to keep the form responsive -->
							<div class="container">
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls') }}">
									<!-- csrf token -->
									{{ csrf_field() }}
									<!-- Creating the label and input for new food name -->
									<div class="form-group">
										<label for="food-name" class="col-md-4 control-label">Food Name</label>
										<div class="col-md-6">
											<input id="food-name" type="text" class="form-control" name="food-name">
										</div>
									</div>
									<!-- Creating the label and input for new food image link -->
									<div class="form-group">
										<label for="cooked" class="col-md-4 control-label">Is Food Cooked</label>
										<div class="col-md-6">
											<select class="form-control" id="cooked" name="cooked">
												<option value="" disabled="disabled" selected="selected">
													Select a Category
												</option>
												<option value="1">Yes</option>
												<option value="2">No</option>
											</select>
										</div>
									</div>
									<!-- Creating the label and input for new water content -->
									<div class="form-group">
										<label for="water-content" class="col-md-4 control-label">Water Content (% of food)</label>
										<div class="col-md-6">
											<input id="water-content" type="text" class="form-control" name="water-content">
										</div>
									</div>
									<!-- Creating the label and input for new ph level -->
									<div class="form-group">
										<label for="ph" class="col-md-4 control-label">PH Level</label>
										<div class="col-md-6">
											<input id="ph" type="text" class="form-control" name="ph">
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Add Food
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						@if ($user->user_level == 2)
						<h3>Promote User</h3>
						<div>
							<div class="container">
								<!-- Input user's email -->
								<form class="form-horizontal" method="POST" action="{{ route('edit_account') }}">
									{{ csrf_field() }}
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="col-md-4 control-label">E-Mail Address</label>
										<div class="col-md-6">
											<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
											@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Promote User
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						@endif
						<h3>Delete Pathogen</h3>
						<div>
							<div class="container">
								<!-- Select pathogen to delete -->
								<form class="form-horizontal" method="POST" action="{{ route('edit_account') }}">
									{{ csrf_field() }}
									<!-- Creating the label and input for new pathogen drop down-->
									<div class="form-group">
										<label for="delete-pathogen" class="col-md-4 control-label">Select Pathogen</label>
										<div class="col-md-6">
											<select class="form-control" id="delete-pathogen" name="delete-pathogen">
												<option value="" disabled="disabled" selected="selected">
													Select a Pathogen
												</option>
											</select>
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Delete Pathogen
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<h3>Delete Food</h3>
						<div>
							<div class="container">
								<!-- Select food to delete -->
								<form class="form-horizontal" method="POST" action="{{ route('edit_account') }}">
									{{ csrf_field() }}
									<!-- Creating the label and input for food drop down -->
									<div class="form-group">
										<label for="delete-food" class="col-md-4 control-label">Select Food</label>
										<div class="col-md-6">
											<select class="form-control" id="delete-food" name="delete-food">
												<option value="" disabled="disabled" selected="selected">
													Select a Food
												</option>
											</select>
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Delete Food
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						@if ($user->user_level == 2)
						<h3>Demote User</h3>
						<div>
							<!-- Input user's email -->
							<form class="form-horizontal" method="POST" action="{{ route('edit_account') }}">
								{{ csrf_field() }}
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email" class="col-md-4 control-label">E-Mail Address</label>
									<div class="col-md-6">
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
										@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
										@endif
									</div>
								</div>
								<!-- Submit button -->
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Demote User
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				@endif
				<div id="tabs-2">
					<div id="accordion_view">
						<h3>View Pathogens</h3>
						<div>

						</div>
						<h3>View Food</h3>
						<div>

						</div>
						<h3>View Adminstrators</h3>
						<div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	@endsection
	@endif