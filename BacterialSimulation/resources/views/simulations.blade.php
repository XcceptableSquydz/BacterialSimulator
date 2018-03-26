@extends('layouts.master-layout')
@section('title')
<title>Run Simulation</title>
@endsection
@section('script')
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="{{ asset('js/simulation.js') }}"></script>
<script>
    //When the page loads, load these jquery functions
    $(document).ready(function() {
        //creates sliders for time, temp, and cells
        $("#time").slider({
            tooltip: 'always'
        });

        $("#temp").slider({
            tooltip: 'always'
        });

        $("#cells").slider({
            tooltip: 'always'
        });
        //when the run simulation button is clicked we take the input from the user and print it out
        $("#run-simulation").click(function(){
            var path = $("#select-pathogen :selected").val();
            var food = $("#select-food :selected").val();
            var time = $("#time").val();
            var cells = $("#cells").val();
            var temp = $("#temp").val();
            $("#par-input").text("Pathogen: " + path + " Food: " + food + " Time: " + time + " Cells: " + cells + " Temp: " + temp);

        });
    });
</script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" method="POST" action="{{ route('admin_controls/delete_pathogen') }}">
                {{ csrf_field() }}
                <!-- Creating the label and input for pathogen drop down-->
                <label class="col-md-4" for="select-pathogen">Select Pathogen</label>
                <div class="form-group">
                    <div>
                        <select class="form-control" id="select-pathogen" name="select-pathogen">
                            <option value="" disabled="disabled" selected="selected">
                                Select a Pathogen
                            </option>
                            @foreach($pathogens as $pathogen)
                            <option value="{{ $pathogen->pathogen_name }}"> {{ $pathogen->pathogen_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Creating the label and input for food drop down-->
                <label class="col-md-4" for="select-food">Select Food</label>
                <div class="form-group">
                    <div>
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
                <!-- Creating the label and slider for length of time -->
                <label class="col-md-4" for="user_type">Length of Time (Minutes)</label>
                <div class="form-group">
                    <div data-role="rangeslider">
                        <input type="range" name="time" id="time" value="200" min="0" max="1000">
                    </div>
                </div>
                <!-- Creating the label and slider for temperature -->
                <label class="col-md-4" for="user_type">Temperature (F)</label>
                <div class="form-group">
                    <div data-role="rangeslider" class="ui-rangeslider">
                        <input type="range" name="temp" id="temp" value="200" min="0" max="1000">
                    </div>
                </div>
                <!-- Creating the label and slider for starting cells -->
                <label class="col-md-4" for="user_type">Starting Cells</label>
                <div class="form-group">
                    <div data-role="rangeslider">
                        <input type="range" name="cells" id="cells" value="200" min="0" max="1000">
                    </div>
                </div>
            </form>
            <!-- Creating the run simulations button -->
            <div class="col-md-4 col-md-offset-1">
                <br>
                <button id="run-simulation" name="run-simulation" class="btn btn-primary">
                    Run Simulation
                </button>
                <br>
            </div>
            <!-- only for iteration 1 testing -->
            <p id="par-input">
            </p>
            <br>
            <br>
            <br>
        </div>
        <center>
            <div class="container" id="grid"></div>
        </center>
    </div>
</div>
@endsection