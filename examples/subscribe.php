<?php
//set_time_limit(20);

require_once "../phpMQTT.php";

$server = "192.168.1.100";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "phpMQTT-subscriberX"; // make sure this is unique for connecting to sever - you could use uniqid()


		$server1 = 'localhost';
		$username1 = 'root';
		$password1 = '';
		$dbname1 = 'sysagua';

		$conn = mysqli_connect($server1, $username1, $password1, $dbname1);

use Bluerhinos\phpMQTT;
$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$topics['/ifpe/sysagua'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);

while($mqtt->proc()){ 
	//echo "";
}

$mqtt->close();

	function procmsg($topic, $msg){
		echo "\nMsg Recieved: ". (date("r") . "\n");
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";

		global $conn;
		
		if($conn){
			//echo nl2br("\nconectado!\n");
			$sql = "INSERT INTO dados(id, data, topico, mensagem)VALUES(NULL, NOW(),'$topic', '$msg')";
			$exec = mysqli_query($conn, $sql);
			echo "\ninserido com sucesso!\n";
		}else{
			echo "\nNão foi possivel conectar-se ao BD\n";
		}

	}
?>
