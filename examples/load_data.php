<!DOCTYPE HTML>
<html>
<head>  
<meta charset="UTF-8">
<script src="../resources/canvasjs.min.js"></script>

</head>
<body>
	<?php
	require '../resources/conexao.php';

	$servername = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'sysagua';
	$mqArray = array();
	$conn = new Conexao($servername, $user, $password, $db);
	
	//inicia a conexao
	$consult = $conn->conectar();

	//executa consulta
	$sql = 'SELECT * from dados';
	$result = $conn->executarQuery($sql);

	//var_dump($result);
	foreach ($result as $r){
		/*echo nl2br("\n\nId:".$r['id']);
		echo nl2br("\nData: ".$r['data']);
		echo nl2br("\nTopico: ".$r['topico']);
		echo nl2br("\nMensagem: ".$r['mensagem']);
		//header('Content-Type: application/json');
		echo nl2br("\n".($r)."\n");*/
		$mqArray[] = array('id'=>$r['id'],"data"=>$r['data'],"topico"=>$r['topico'],"mensagem"=>$r['mensagem']);
		//$mqArray[] = $r['data'];
		//$mqArray[] = $r['topico'];
		//$mqArray[] = $r['mensagem'];
		//var_dump($mqArray);
	}

		//$mqArray[];
		//var_dump($mqArray);
	
		$resultJSON = json_encode($mqArray);
	/*$varX = array(
		["ab", "x", "y"],
		["ac", "cas","y"],
		["ad", "vc", "y"]
	);
	$resultJSON = json_encode($varX);
	//echo nl2br("\n\n");*/


	/*$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
	//header('Content-Type: application/json');
    echo json_encode($arr);*/
   
	//Depurar o que tem em result
	//
	//echo "::: ".$result;
	 //exit;
?>
	
</body>
</html>