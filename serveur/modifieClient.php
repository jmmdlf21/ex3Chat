<?php

require_once("includes/chargementClasses.inc.php");

try {
	$RequetesPDO = new RequetesPDO();
	parse_str(file_get_contents("php://input"), $client);
	$reponse['ret'] = $RequetesPDO->updateItem("clients", $client);
	$reponse['clients']= $RequetesPDO->getTable("clients");
	echo json_encode($reponse);
}
catch (Exception $e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
}