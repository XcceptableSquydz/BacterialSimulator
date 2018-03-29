@extends('layouts.master-layout')
@section('title')
<title>Run Simulation</title>
@endsection
<style>
.swal-title {
    margin: 0px;
    font-size: 16px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.21);
    margin-bottom: 28px;
}
</style>
@section('script')

<svg width="960" height="500" style="border: 1pt solid black">
    <!--<defs>
        <pattern id="imgpattern" width="1" height="1">
            <image width="960" height="500"
            xlink:href="https://imageresizer.static9.net.au/g1YGuRLpZO6jxEf7I-xeR4Kld9I=/1024x0/http%3A%2F%2Fprod.static9.net.au%2F_%2Fmedia%2F2017%2F09%2F28%2F09%2F43%2FCan-you-eat-raw-chicken.jpg"/>
        </pattern>
    </defs>-->
    <path fill="url(#imgpattern)" stroke-width="1"
    d="M 0,0 L 0,960 960,500 960,0  Z" />
</svg>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hexbin.v0.2.min.js"></script>
<!--<script src="{{ asset('js/simulation.js') }}"></script>-->
<script>
    //When the page loads, load these jquery functions
    $(document).ready(function() {
        var simulationClicked = 0;
        //when the run simulation button is clicked we take the input from the user and print it out
        $("#run-simulation").click(function(){
            simulationClicked++;
            path_name.innerText = $("#select-pathogen :selected").val() + " on " + $("#select-food :selected").val();
            var infectious_dosage = $("#select-pathogen :selected").attr("id");
            var img = $("#select-food :selected").attr("id");
            var time = Number($("#time").val());
            var cells = $("#cells").val();
            var temp = $("#temp").val();

            d3.selectAll("svg > *").remove();

            var svg = d3.select("svg"),
            width = +svg.attr("width"),
            height = +svg.attr("height"),
            style = +svg.attr("style");

            /*var defs = svg.append('svg:defs');

            defs.append("svg:pattern")
            .attr("id", "imgpattern")
            .attr("width", 0)
            .attr("height", 0)
            .attr("x", 0)
            .attr("y", 0)
            .append("svg:image")
            .attr("xlink:href", img)
            .attr("width", 960)
            .attr("height", 500);

            var background = svg.append("background")
            .attr("d", "M 0,0 L 0,960 960,500 960,0  Z")
            .style("stroke-width", "1")
            .style("fill", "#imgpattern");*/


            var delta = 0.01,
            cells = Number(cells), //number of starting cells and total cells
            infectious_dosage = Number(infectious_dosage), //infectious dose
            lot = 1, //length of time
            doublingTime = 30;
            minutes = 0; // Total number of random points.

            $("#num_cells").html("Number of Cells: " + cells);
            $("#lot").html("Length of time (minutes): " + minutes);

            var rx = d3.randomNormal(width / 2, 80),
            ry = d3.randomNormal(height / 2, 80),
            points = d3.range(cells).map(function() { return [rx(), ry()]; });

            var color = d3.scaleSequential(d3.interpolateLab("white", "green"))
            .domain([0, infectious_dosage/100]);

            var hexbin = d3.hexbin()
            .radius(20)
            .extent([[0, 0], [width, height]]);

            var hexagon = svg.selectAll("path")
            .data(hexbin(points))
            .enter().append("path")
            .attr("d", hexbin.hexagon(19.5))
            .attr("fill", function(d) { return color(d.length); });

            var makeCallback = function() {
                // note that we're returning a new callback function each time
                return function(elapsed) {
                    if(lot % 6 != 0)
                        lot++;
                    else{
                        minutes++;
                        lot = 1;
                        $("#lot").html("Length of time (minutes): " + minutes);
                    }
                    
                    points = d3.range(cells).map(function() { return [rx(), ry()]; });
                    
                    hexagon = hexagon
                    .data(hexbin(points));

                    hexagon.exit().remove();

                    hexagon = hexagon.enter().append("path")
                    .attr("d", hexbin.hexagon(19.5))
                    .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
                    .merge(hexagon)
                    .attr("fill", function(d) { return color(d.length); });
                    console.log(cells);
                    if(cells < infectious_dosage & minutes < time){
                        if(minutes != 0 & minutes%doublingTime == 0)
                            cells = cells * 2;
                        else
                            cells = cells;
                    }
                    else{
                        simulationClicked = 0;
                        swal({
                            title: 'Gross!',
                            text: 'This food has been infected.',
                            imageUrl: 'http://www.dadshopper.com/wp-content/uploads/2016/10/21.png',
                            imageWidth: 210,
                            imageHeight: 200,
                            imageAlt: 'Sick emoji',
                            animation: false
                        })
                        return false;
                    }

                    $("#num_cells").html("Number of Cells: " + cells);

                    if(simulationClicked == 2){
                        simulationClicked = 1;
                        return false;
                    }

                    d3.timeout(makeCallback(), 50);
                    return true;
                }
            };
            var interval = d3.timeout(makeCallback(), 50);
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
                <label class="col-md-4">Select Pathogen</label>
                <div class="form-group">
                    <select class="form-control" id="select-pathogen" name="select-pathogen">
                        <option value="" disabled="disabled" selected="selected">
                            Select a Pathogen
                        </option>
                        @foreach($pathogens as $pathogen)
                        <option id="{{ $pathogen->infectious_dose }}" value="{{ $pathogen->pathogen_name }}"> {{ $pathogen->pathogen_name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Creating the label and input for food drop down-->
                <label class="col-md-4">Select Food</label>
                <div class="form-group">
                    <div>
                        <select class="form-control" id="select-food" name="select-food">
                            <option value="" disabled="disabled" selected="selected">
                                Select a Food
                            </option>
                            @foreach($foods as $food)
                            <option id="{{ $food->image_link }}" value="{{ $food->food_name }}"> {{ $food->food_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Creating the label and slider for length of time -->
                <label class="col-md-4">Length of Time (Minutes)</label>
                <div class="form-group">
                    <input type="number" name="time" id="time" value="1" min="1">
                </div>
                <!-- Creating the label and slider for temperature -->
                <label class="col-md-4">Temperature (F)</label>
                <div class="form-group">
                    <input type="number" name="temp" id="temp" value="0" min="0">
                </div>
                <!-- Creating the label and slider for starting cells -->
                <label class="col-md-4">Starting Cells</label>
                <div class="form-group">
                    <input type="number" name="cells" id="cells" value="1" min="1">
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
    </div>
</div>
<center>
    <h3 id="path_name"></h3>
    <label id="num_cells">Number of Cells: 0</label>
    <label id="lot" class="col-md-offset-1">Length of Time (Minutes): 0</label>
</center>
@endsection