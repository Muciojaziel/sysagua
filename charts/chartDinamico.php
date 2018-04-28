<?php 
require "../examples/load_data.php"; 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">	
<script src="../resources/canvasjs.min.js"></script>
</head>
<body>
	
	<div id="dadosJSON" style="display: none" ><?php echo $resultJSON; ?></div>

	<div id="dadosJSON"><?php var_dump($resultJSON); ?></div>

	

<script>
window.onload = function () {

var dataPoints1 = [];
var dataPoints2 = [];

var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: "SysAgua"
	},
	axisX: {
		title: "Grafico atualiza a cada 3s"
	},
	axisY:{
		prefix: "lts",
		includeZero: false
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
		type: "line",
		xValueType: "dateTime",
		yValueFormatString: "$####.00",
		xValueFormatString: "hh:mm:ss TT",
		showInLegend: true,
		name: "Company A",
		dataPoints: dataPoints1
		},
		{				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "$####.00",
			showInLegend: true,
			name: "Company B" ,
			dataPoints: dataPoints2
	}]
});

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

	


var updateInterval = 3000;
// initial value
var yValue1 = 700; 
var yValue2 = 690;

var time = new Date;
// starting at 9.30 am
time.setHours(9);
time.setMinutes(30);
time.setSeconds(00);
time.setMilliseconds(00);

function updateChart(count) {
	count = count || 1;
	var deltaY1, deltaY2;
	for (var i = 0; i < count; i++) {
		time.setTime(time.getTime()+ updateInterval);
		deltaY1 = .5 + Math.random() *(-.5-.5);
		deltaY2 = .5 + Math.random() *(-.5-.5);

	// adding random value and rounding it to two digits. 
	yValue1 = Math.round((yValue1 + deltaY1)*100)/100;
	yValue2 = Math.round((yValue2 + deltaY2)*100)/100;

	// pushing the new values
	dataPoints1.push({
		x: time.getTime(),
		y: yValue1
	});
	dataPoints2.push({
		x: time.getTime(),
		y: yValue2
	});
	}

	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = " Company A  $" + yValue1;
	chart.options.data[1].legendText = " Company B  $" + yValue2; 
	chart.render();
}
// generates first set of dataPoints 
updateChart(100);	
setInterval(function(){updateChart()}, updateInterval);

}
</script>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

</body>
</html>