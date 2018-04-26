@extends('layouts.master')

@section('isi')
	<div id="container"></div>
    <script type="text/javascript">
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable([
		  ['Method', 'Count'],
		  ['How to:', 8],
		  ['Video', 2],
		  ['Tutorial', 4]
		]);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Class Method Preference', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('container'));
		  chart.draw(data, options);
		}
	</script>

@endsection()