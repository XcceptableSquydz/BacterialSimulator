@extends('layouts.master-layout')
@section('title')
<title>Run Simulation</title>
@endsection
@section('script')
<style>
.hexagon {
  stroke: #000;
  stroke-width: 0.5px;
}
</style>
<svg width="960" height="500"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hexbin.v0.2.min.js"></script>
<script>
    //When the page loads, load these jquery functions
    $(document).ready(function() {
        $("#time").slider({
            tooltip: 'always'
        });

        $("#temp").slider({
            tooltip: 'always'
        });

        $("#cells").slider({
            tooltip: 'always'
        });

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
<script>
    var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom,
    g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var randomX = d3.randomNormal(width / 2, 80),
    randomY = d3.randomNormal(height / 2, 80),
    points = d3.range(2000).map(function() { return [randomX(), randomY()]; });

    var color = d3.scaleSequential(d3.interpolateLab("white", "green"))
    .domain([0, 20]);

    var hexbin = d3.hexbin()
    .radius(20)
    .extent([[0, 0], [width, height]]);

    var x = d3.scaleLinear()
    .domain([0, width])
    .range([0, width]);

    var y = d3.scaleLinear()
    .domain([0, height])
    .range([height, 0]);

    g.append("clipPath")
    .attr("id", "clip")
    .append("rect")
    .attr("width", width)
    .attr("height", height);

    g.append("g")
    .attr("class", "hexagon")
    .attr("clip-path", "url(#clip)")
    .selectAll("path")
    .data(hexbin(points))
    .enter().append("path")
    .attr("d", hexbin.hexagon())
    .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
    .attr("fill", function(d) { return color(d.length); });

    g.append("g")
    .attr("class", "axis axis--y")
    .call(d3.axisLeft(y).tickSizeOuter(-width));

    g.append("g")
    .attr("class", "axis axis--x")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x).tickSizeOuter(-height));
</script>
<svg width="960" height="500"></svg>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" method="POST" action="{{ route('admin_controls/delete_pathogen') }}">
                {{ csrf_field() }}
                <!-- Creating the label and input for new pathogen drop down-->
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

                <label class="col-md-4" for="user_type">Length of Time (Minutes)</label>
                <div class="form-group">
                    <div data-role="rangeslider">
                        <input type="range" name="time" id="time" value="200" min="0" max="1000">
                    </div>
                </div>

                <label class="col-md-4" for="user_type">Temperature (F)</label>
                <div class="form-group">
                    <div data-role="rangeslider" class="ui-rangeslider">
                        <input type="range" name="temp" id="temp" value="200" min="0" max="1000">
                    </div>
                </div>

                <label class="col-md-4" for="user_type">Starting Cells</label>
                <div class="form-group">
                    <div data-role="rangeslider">
                        <input type="range" name="cells" id="cells" value="200" min="0" max="1000">
                    </div>
                </div>
            </form>

            <div class="col-md-4 col-md-offset-1">
                <br>
                <button id="run-simulation" name="run-simulation" class="btn btn-primary">
                    Run Simulation
                </button>
                <br>
            </div>

            <p id="par-input">
            </p>
            
        </div>
    </div>
</div>
@endsection