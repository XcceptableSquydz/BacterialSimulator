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
				collapsible: true,
				heightStyle: "content",
				widthStyle: "content",
				clearStyle: true
			});
		});
		//The drop down tabs for each of the functions in manage database
		$( function() {
			$("#accordion_manage").accordion({
				collapsible: true,
				heightStyle: "content",
				widthStyle: "content",
				clearStyle: true
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
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/pathogen') }}">
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
									<!-- Creating the label and input for new pathogen infectious dose -->
									<div class="form-group">
										<label for="infectious" class="col-md-4 control-label">Infectious Dose</label>
										<div class="col-md-6">
											<input id="infectious" type="number" class="form-control" name="infectious">
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
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/food') }}">
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
											<input id="water-content" type="number" step=".01" min="0" max="100" class="form-control" name="water-content">
										</div>
									</div>
									<!-- Creating the label and input for new ph level -->
									<div class="form-group">
										<label for="ph" class="col-md-4 control-label">PH Level</label>
										<div class="col-md-6">
											<input id="ph" type="number" step=".01" min="0" max="14" class="form-control" name="ph">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen image link -->
									<div class="form-group">
										<label for="image-link" class="col-md-4 control-label">Link to Food Image</label>
										<div class="col-md-6">
											<input id="image-link" type="url" class="form-control" name="image-link">
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
						<h3>Edit Food</h3>
						<div>
							<!-- bootstrap formatting to keep the form responsive -->
							<div class="container">
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/editfood') }}">
									<!-- csrf token -->
									{{ csrf_field() }}
									
									<div class="form-group">
										<label class="col-md-4 control-label" for="select-food">Select Food</label>
										<div class="col-md-6">
											<select class="form-control" id="select-food" name="select-food">
												<option value="" disabled="disabled" selected="selected">
													Select a Food
												</option>
												@foreach($foods as $food)
												<option value="{{ $food->food_name }}"> {{ $food->food_name }}</option>
												@endforeach
											</select>
										</div>
									</div> 

									<!-- Creating the label and input for new food name -->
									<div class="form-group">
										<label for="new-food-name" class="col-md-4 control-label">Food Name</label>
										<div class="col-md-6">
											<input id="new-food-name" type="text" class="form-control" name="new-food-name">
										</div>
									</div>
									<!-- Creating the label and input for new food image link -->
									<div class="form-group">
										<label for="new-cooked" class="col-md-4 control-label">Is Food Cooked</label>
										<div class="col-md-6">
											<select class="form-control" id="new-cooked" name="new-cooked">
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
										<label for="new-water-content" class="col-md-4 control-label">Water Content (% of food)</label>
										<div class="col-md-6">
											<input id="new-water-content" type="number" step=".01" max="100" class="form-control" name="new-water-content">
										</div>
									</div>
									<!-- Creating the label and input for new ph level -->
									<div class="form-group">
										<label for="new-ph" class="col-md-4 control-label">PH Level</label>
										<div class="col-md-6">
											<input id="new-ph" type="number" step=".01" max="14" class="form-control" name="new-ph">
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Edit Food
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<h3>Edit Pathogen</h3>
						<div>
							<!-- bootstrap formatting to keep the form responsive -->
							<div class="container">
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/editpathogen') }}">
									<!-- csrf token -->
									{{ csrf_field() }}
									<div class="form-group">
										<label class="col-md-4 control-label" for="select-pathogen">Select Pathogen</label>
										<div class="col-md-6">
											<select class="form-control" id="select-pathogen" name="select-pathogen">
												<option value="" disabled="disabled" selected="selected">
													Select a pathogen
												</option>
												@foreach($pathogens as $pathogen)
												<option value="{{ $pathogen->pathogen_name }}"> {{ $pathogen->pathogen_name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="new-pathogen-name" class="col-md-4 control-label">Pathogen Name</label>
										<div class="col-md-6">
											<input id="new-pathogen-name" type="text" class="form-control" name="new-pathogen-name">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen info link -->
									<div class="form-group">
										<label for="new-info-link" class="col-md-4 control-label">Link to More Information</label>
										<div class="col-md-6">
											<input id="new-info-link" type="url" class="form-control" name="new-info-link">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen image link -->
									<div class="form-group">
										<label for="image-link" class="col-md-4 control-label">Link to Pathogen Image</label>
										<div class="col-md-6">
											<input id="new-image-link" type="url" class="form-control" name="new-image-link">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen formula -->
									<div class="form-group">
										<label for="new-formula" class="col-md-4 control-label">Growth Rate Formula</label>
										<div class="col-md-6">
											<input id="new-formula" type="text" class="form-control" name="new-formula">
										</div>
									</div>
									<!-- Creating the label and input for new pathogen infectious dose -->
									<div class="form-group">
										<label for="infectious" class="col-md-4 control-label">Infectious Dose</label>
										<div class="col-md-6">
											<input id="infectious" type="number" class="form-control" name="infectious">
										</div>
									</div>
									<!-- Submit button -->
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Edit Pathogen
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
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/promote') }}">
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
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/delete_pathogen') }}">
									{{ csrf_field() }}
									<!-- Creating the label and input for new pathogen drop down-->
									<div class="form-group">
										<label for="delete-pathogen" class="col-md-4 control-label">Select Pathogen</label>
										<div class="col-md-6">
											<select class="form-control" id="delete-pathogen" name="delete-pathogen">
												<option value="" disabled="disabled" selected="selected">
													Select a Pathogen
												</option>
												@foreach($pathogens as $pathogen)
												<option value="{{ $pathogen->pathogen_name }}"> {{ $pathogen->pathogen_name }}</option>
												@endforeach
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
								<form class="form-horizontal" method="POST" action="{{ route('admin_controls/delete_food') }}">
									{{ csrf_field() }}
									<!-- Creating the label and input for food drop down -->
									<div class="form-group">
										<label for="delete-food" class="col-md-4 control-label">Select Food</label>
										<div class="col-md-6">
											<select class="form-control" id="delete-food" name="delete-food">
												<option value="" disabled="disabled" selected="selected">
													Select a Food
												</option>
												@foreach($foods as $food)
												<option value="{{ $food->food_name }}"> {{ $food->food_name }}</option>
												@endforeach
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
							<form class="form-horizontal" method="POST" action="{{ route('admin_controls/demote') }}">
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
				<!-- this is the tab for the view database -->
				<div id="tabs-2">
					<div id="accordion_view">
						<!-- this is an accordion for view pathogens from the database -->
						<h3>View Pathogens</h3>
						<div>
							@foreach($pathogens as $pathogen)
							<ul>
								<li>Name: {{ $pathogen->pathogen_name }}</li>
								<li>Formula: {{ $pathogen->formula }}</li>
								<li>Image Link: {{ $pathogen->image }}</li>
								<li>Description Link: {{ $pathogen->desc_link }}</li></br>
							</ul>
							@endforeach
						</div>
						<!-- this is an accordion for view foods from the database -->
						<h3>View Food</h3>
						<div>
							@foreach($foods as $food)
							<ul>
								<li>Name: {{ $food->food_name }}</li>
								<li>Is Cooked: @if ($food->cooked == 1) True @else False @endif</li>
								<li>Available Water: {{ $food->available_water }}</li>
								<li>PH Level: {{ $food->ph_level }}</li></br>
							</ul>
							@endforeach
						</div>
						<!-- this is an accordion for view administrators from the database -->
						<h3>View Adminstrators</h3>
						<div>
							@foreach($admins as $admin)
							@if ($admin->user_level >= 1)
							<li>Admin Email: {{ $admin->email }}</li></br>
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	@endsection
	@endif