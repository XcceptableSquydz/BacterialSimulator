function gridData() {
	var data = new Array();
	var xpos = 1; //starting xpos and ypos at 1 so the stroke will show when we make the grid below
	var ypos = 1;
	var width = 35;
	var height = 20;
	var cells = 0;
	
	// iterate for rows	
	for (var row = 0; row < 15; row++) {
		data.push( new Array() );
		
		// iterate for cells/columns inside rows
		for (var column = 0; column < 24; column++) {
			data[row].push({
				x: xpos,
				y: ypos,
				width: width,
				height: height,
				cells: cells
			})
			// increment the x position. I.e. move it over by 50 (width variable)
			xpos += width;
		}
		// reset the x position after a row is complete
		xpos = 1;
		// increment the y position for the next row. Move it down 50 (height variable)
		ypos += height;	
	}
	return data;
}

var color = d3.scaleSequential(d3.interpolateLab("white", "green"))
.domain([0, 10]);

var gridData = gridData();	
// I like to log the data to the console for quick debugging
console.log(gridData);

var grid = d3.select("#grid")
.append("svg")
.attr("width","850px")
.attr("height","500px");

var row = grid.selectAll(".row")
.data(gridData)
.enter().append("g")
.attr("class", "row");

var column = row.selectAll(".square")
.data(function(d) { return d; })
.enter().append("rect")
.attr("class","square")
.attr("x", function(d) { return d.x; })
.attr("y", function(d) { return d.y; })
.attr("width", function(d) { return d.width; })
.attr("height", function(d) { return d.height; })
.style("fill", "#fff")
.style("stroke", "#222")
.attr("cells", "0"); /*function(d) {
	d.cells ++;
	if ((d.click)%4 == 0 ) { d3.select(this).style("fill", function(d) { return color(d.click); }) }
	if ((d.click)%4 == 1 ) { d3.select(this).style("fill", function(d) { return color(d.click); }) }
	if ((d.click)%4 == 2 ) { d3.select(this).style("fill", function(d) { return color(d.click); }) }
	if ((d.click)%4 == 3 ) { d3.select(this).style("fill", function(d) { return color(d.click); }) }*/