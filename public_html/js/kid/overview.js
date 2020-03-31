google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Day', 'Sales'],
		['Mon',  15],
		['Tue',  12],
		['Wed',  20],
		['Thu',  30],
		['Fri',  25],
		['Sat',  22],
		['Sun',  5]
	]);

	var options = {
		legend: "none",
		pointSize: 5,
	};

	var chart_div = document.getElementById('chart_div');
		var chart = new google.visualization.LineChart(chart_div);

		// Wait for the chart to finish drawing before calling the getImageURI() method.
		google.visualization.events.addListener(chart, 'ready', function () {
				chart_div.innerHTML = '<img class="chart-image" src="' + chart.getImageURI() + '">';
				console.log(chart_div.innerHTML);
		});

	chart.draw(data, options);

	$(window).resize(function(){
		drawChart();
	});
}
