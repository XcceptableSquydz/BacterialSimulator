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
<!-- creates the container that will hold all of the cells that populate.
        the defs/pattern are here to hold the background image.
        the path tag draws a square and fills it with the pattern. -->
        <svg id="svgtag" width="960" height="500" style="border: 1pt solid black">
            <defs>
                <pattern id="imgpattern" width="1" height="1">
                    <image id="imglink" width="960" height="500"
                    xlink:href=""/>
                </pattern>
            </defs>
            <path fill="url(#imgpattern)" stroke-width="1"
            d="M 0,0 L 0,960 960,500 960,0  Z" />
        </svg>
        <!-- sources for the alert and hexagons/cells that will be colored -->
        <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"></script>
        <script src="https://d3js.org/d3-hexbin.v0.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.25.6/d3-legend.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.25.6/d3-legend.min.js"></script>
        <!--<script src="{{ asset('js/simulation.js') }}"></script>-->
        <script>
    //When the page loads, load these jquery functions
    $(document).ready(function() {
        var simulationClicked = 0;
        //when the run simulation button is clicked we take the input from the user and print it out
        $("#run-simulation").click(function(){
            if(($("#select-pathogen :selected").val() != "") && ($("#select-food :selected").val() != '')){
                simulationClicked++; //needed to reset/clear the function so two simulations aren't running at the same time.
            //changing the header based on the pathogen selected.
            path_name.innerText = $("#select-pathogen :selected").val() + " on " + $("#select-food :selected").val();
            //setting the infection dose
            var infectious_dosage = $("#select-pathogen :selected").attr("id");
            //setting the image http path
            var img = $("#select-food :selected").attr("id");
            //casting the time from user input to a number
            var time = Number($("#time").val());
            var cells = $("#cells").val();
            var temp = $("#temp").val();

            //removing old svg elements so cells don't stay on the screen when a user wants to run the next simulation
            d3.selectAll("svg > *").remove();
            d3.selectAll("svg > path").remove();
            d3.selectAll("svg > g").remove();

            /**/

            //filling svg variables with defined in the svg tag at the top
            var svg = d3.select("svg"),
            width = +svg.attr("width"),
            height = +svg.attr("height"),
            style = +svg.attr("style");

            var cells = Number(cells), //number of starting cells and total cells
            infectious_dosage = Number(infectious_dosage), //infectious dose
            lot = 1, //length of time
            doublingTime = 30;
            minutes = 0; // Total number of random points.

            //resets the num cells and length of time tags to 0
            $("#num_cells").html("Number of Cells: " + cells);
            $("#lot").html("Length of time (minutes): " + minutes);

            //giving the svg more variables
            var svg = d3.select("svg"),
            margin = {top: 20, right: 20, bottom: 30, left: 40},
            width = +svg.attr("width") - margin.left - margin.right,
            height = +svg.attr("height") - margin.top - margin.bottom,
            g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            //creating the starting cells
            var rx = d3.randomNormal(width / 2, 80),
            ry = d3.randomNormal(height / 2, 80),
            points = d3.range(cells).map(function() { return [rx(), ry()]; });
            background = d3.range(1).map(function() { return [rx(), ry()]; });
            //setting the color gradient based on infectious dose
            var color = d3.scaleSequential(d3.interpolateLab("white", "green"))
            .domain([0, infectious_dosage/100]);

            //creating the hexagons
            var hexbin = d3.hexbin()
            .radius(20)
            .extent([[0, 0], [width, height]]);

            //recreating the def tag, pattern tag, and image tag to display the background
            var defs = svg.selectAll("defs")
            .data(hexbin(background))
            .enter().append("defs")
            .append("linearGradient")
            .append("pattern")
            .attr("id", "imgpattern")
            .attr("width", "1")
            .attr("height", "1")
            .append("image")
            .attr("id", "imglink")
            .attr("width", "960")
            .attr("height", "500")
            .attr("xlink:href", function(d) { return $("#select-food :selected").attr("id")});

            //recreating the path for the background so it displays on the screen
            var background = svg.selectAll("#background")
            .data(hexbin(background))
            .enter().append("path")
            .attr("id", "background")
            .attr("d", "M 0,0 L 0,960 960,500 960,0  Z")
            .attr("stroke-width", "1")
            .attr("fill", "url(#imgpattern)");

            //giving the hexgon values and appending it to the svg path
            var hexagon = svg.selectAll("path")
            .data(hexbin(points))
            .enter().append("path")
            .attr("d", hexbin.hexagon(19.5))
            .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
            .attr("fill", function(d) { return color(d.length); });

            //adding legend to the svg
            var log = d3.scaleLog()
            .domain([ 1, infectious_dosage/100 ])
            .range(["white", "green"]);

            var svg = d3.select("svg");

            svg.append("g")
            .attr("class", "legendLog")
            .attr("transform", "translate(20,20)");

            var logLegend = d3.legendColor()
            .cells([1, infectious_dosage/1000, infectious_dosage/500, infectious_dosage/250, infectious_dosage/100, infectious_dosage/20, infectious_dosage/10])
            .scale(log);

            svg.select(".legendLog")
            .call(logLegend);


            //the recursive function to add cells until the timer runs out or the infectious dose is reached
            var makeCallback = function() {
                // note that we're returning a new callback function each time
                return function(elapsed) {
                    //change based on how fast you want the minutes to calculate (higher makes for weird asynchronous problems)
                    if(lot % 1 != 0)
                        lot++;
                    else{
                        minutes++;
                        lot = 1;
                        $("#lot").html("Length of time (minutes): " + minutes);
                    }
                    //creating a new plot based on the amount of cells
                    points = d3.range(cells).map(function() { return [rx(), ry()]; });
                    
                    //adding those new points to the hexagon
                    hexagon = hexagon
                    .data(hexbin(points));

                    //removing old hexagons
                    hexagon.exit().remove();

                    //adding new hexagon attributes
                    hexagon = hexagon.enter().append("path")
                    .attr("d", hexbin.hexagon(19.5))
                    .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
                    .merge(hexagon)
                    .attr("fill", function(d) { return color(d.length); });

                    //determines whether or not the function continues running and when to double the cells
                    if(minutes < time){
                        if(cells < infectious_dosage){
                            if(minutes != 0 & minutes%doublingTime == 0)
                                cells = cells * 2;
                            else
                                cells = cells;
                        }
                        //once infectious show the sweet alert
                        else{
                            simulationClicked = 0;
                            swal({
                                title: 'You will most likely be sick if you eat this!',
                                text: "Number of Cells: " + cells + " Duration: " + minutes,
                                imageUrl: 'http://www.dadshopper.com/wp-content/uploads/2016/10/21.png',
                                imageWidth: 210,
                                imageHeight: 200,
                                imageAlt: 'Sick emoji',
                                animation: false
                            })
                            return false;
                        }
                    }
                    //if the time is reached before infectious don't show the sweet alert and stop the function
                    else{
                        simulationClicked = 0;
                        return false;
                    }

                    $("#num_cells").html("Number of Cells: " + cells);

                    //if the simulation is run during another simulation retrun false on the old function
                    //kind of a hacky way to stop the old function
                    if(simulationClicked == 2){
                        simulationClicked = 1;
                        return false;
                    }

                    //recursive call to keep the function running
                    d3.timeout(makeCallback(), 100);
                    return true;
                }
            };
            //the first recursive call so the simulation actually runs
            var interval = d3.timeout(makeCallback(), 100);
        }
        else{
            swal("INPUT ERROR!", "Please select a Pathogen AND a Food!", "error");
        }
    });
});
</script>
@endsection
@section('content')

<div class="container" style = "z-index: -1;">
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
                <!-- Creating the label and slider for temperature 
                <label class="col-md-4">Temperature (F)</label>
                <div class="form-group">
                    <select class="form-control" id="select-temp" name="select-temp">
                        <option value="" disabled="disabled" selected="selected">
                            Select a Food
                        </option>
                        @foreach($pathogens as $pathogen)
                        <option id="{{ $loop->index }}" value="{{ $pathogen->pathogen_name }}"> {{ $food->food_name }}</option>
                        @endforeach
                    </select>
                </div> -->
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