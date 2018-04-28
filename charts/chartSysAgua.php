<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script src="../resources/canvasjs.min.js"></script>

</head>
<body>
	<?php
	require "../resources/conexao.php";

	$servername = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'sysagua';

	$conn = new Conexao($servername, $user, $password, $db);

	if($conn){
		echo 'Status Conexao BD: <input type="text" value="conectado" disabled/><br/>';
	}else{
		echo 'nao conectado ao BD';
	}

	//inicia a conexao
	$consult = $conn->conectar();

	//executa consulta
	$sql = 'SELECT * from dados';
	$result = $conn->executarQuery($sql);
	?>

	<table style="border: 1px solid black;">
		<tr>
			<th>Data/hora</th>
			<th>Tópico</th>
			<th>Valor</th>
		</tr>
		<?php 
		//Repetir e construir as linha da tabela com o resultado
		foreach ($result as $r){
			//var_dump($r);
			//echo nl2br("\n\nData: ".$r['data']);
			//echo nl2br("\nTópico: ".$r['topico']);
			//echo nl2br("\nMensagem: ".$r['mensagem']);
			?>
		<tr>
		    <td><?php echo $r['data']; ?></td>
		    <td><?php echo $r['topico']; ?></td> 
		    <td><?php echo $r['mensagem'];?></td>
  		</tr>
<?php } ?>
		
	</table>
	<?php 
		foreach ($result as $c){
			var_dump($c);
	?>
<script>
window.onload = function () {
	var cData;
	var cTopico;
	var cMensagem;
var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	title:{
		text: "SysAgua"
	},
	axisY :{
		includeZero: false,
		title: "Consumo",
		suffix: "lts"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Domingo",
		dataPoints: [
			{ label: "00", y: cData=<?=$c['mensagem']?> },
			/*{ label: "01", y: 10.00 },
			{ label: "02", y: 14.44 },
			{ label: "03", y: 10.45 },
			{ label: "04", y: 12.58 },
			{ label: "05", y: 8.44 },
			{ label: "06", y: 5.40 }
			{ label: "Ep. 8", y: 2.72 },
			{ label: "Ep. 9", y: 2.66 },
			{ label: "Ep. 10", y: 3.04 }*/
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		visible: false,
		yValueFormatString: "##.00mn",
		name: "Horas",
		dataPoints: [
			{ label: "00:00", y: 3.86 },
			{ label: "01:00", y: 3.76 },
			{ label: "02:00", y: 3.77 },
			{ label: "03:00", y: 3.65 },
			{ label: "04:00", y: 3.90 },
			{ label: "05:00", y: 3.88 },
			{ label: "06:00", y: 3.69 },
			{ label: "07:00", y: 3.86 },
			{ label: "08:00", y: 3.38 },
			{ label: "09:00", y: 4.20 },
			{ label: "10:00", y: 6.20 },
			{ label: "11:00", y: 7.30 },
			{ label: "12:00", y: 8.20 },
			{ label: "13:00", y: 4.20 },
			{ label: "14:00", y: 10.20 },
			{ label: "15:00", y: 0.20 },
			{ label: "16:00", y: 15.20 },
			{ label: "17:00", y: 17.50 },
			{ label: "18:00", y: 18.20 },
			{ label: "19:00", y: 0.20 },
			{ label: "20:00", y: 20.20 },
			{ label: "21:00", y: 5.00},
			{ label: "22:00", y: 2.20 },
			{ label: "23:00", y: 2.20 },
		]
	}
	/*{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 3",
		dataPoints: [
			{ label: "Ep. 1", y: 4.37 },
			{ label: "Ep. 2", y: 4.27 },
			{ label: "Ep. 3", y: 4.72 },
			{ label: "Ep. 4", y: 4.87 },
			{ label: "Ep. 5", y: 5.35 },
			{ label: "Ep. 6", y: 5.50 },
			{ label: "Ep. 7", y: 4.84 },
			{ label: "Ep. 8", y: 4.13 },
			{ label: "Ep. 9", y: 5.22 },
			{ label: "Ep. 10", y: 5.39 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 4",
		dataPoints: [
			{ label: "Ep. 1", y: 6.64 },
			{ label: "Ep. 2", y: 6.31 },
			{ label: "Ep. 3", y: 6.59 },
			{ label: "Ep. 4", y: 6.95 },
			{ label: "Ep. 5", y: 7.16 },
			{ label: "Ep. 6", y: 6.40 },
			{ label: "Ep. 7", y: 7.20 },
			{ label: "Ep. 8", y: 7.17 },
			{ label: "Ep. 9", y: 6.95 },
			{ label: "Ep. 10", y: 7.09 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 5",
		dataPoints: [
			{ label: "Ep. 1", y: 8 },
			{ label: "Ep. 2", y: 6.81 },
			{ label: "Ep. 3", y: 6.71 },
			{ label: "Ep. 4", y: 6.82 },
			{ label: "Ep. 5", y: 6.56 },
			{ label: "Ep. 6", y: 6.24 },
			{ label: "Ep. 7", y: 5.40 },
			{ label: "Ep. 8", y: 7.01 },
			{ label: "Ep. 9", y: 7.14 },
			{ label: "Ep. 10", y: 8.11 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 6",
		dataPoints: [
			{ label: "Ep. 1", y: 7.94 },
			{ label: "Ep. 2", y: 7.29 },
			{ label: "Ep. 3", y: 7.28 },
			{ label: "Ep. 4", y: 7.82 },
			{ label: "Ep. 5", y: 7.89 },
			{ label: "Ep. 6", y: 6.71 },
			{ label: "Ep. 7", y: 7.80 },
			{ label: "Ep. 8", y: 7.60 },
			{ label: "Ep. 9", y: 7.66 },
			{ label: "Ep. 10", y: 8.89 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 7",
		dataPoints: [
			{ label: "Ep. 1", y: 10.11 },
			{ label: "Ep. 2", y: 9.27 },
			{ label: "Ep. 3", y: 9.25 },
			{ label: "Ep. 4", y: 10.17 },
			{ label: "Ep. 5", y: 10.72 },
			{ label: "Ep. 6", y: 10.24 },
			{ label: "Ep. 7", y: 12.07 }
		]
	}]*/
	]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
<?php } ?>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

</body>
</html>