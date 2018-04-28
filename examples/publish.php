<?php

require("../phpMQTT.php");

$server = "192.168.1.100";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()

use Bluerhinos\phpMQTT;
$mqtt = new phpMQTT($server, $port, $client_id.rand());

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("/ifpe/sysagua", "Hello World3! at " . date("r"), 0);

	$mqtt->close();
} else {
    echo "Time out!\n";
}
