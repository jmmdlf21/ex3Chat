<?php

require_once("includes/chargementClasses.inc.php");

try {
	$RequetesPDO = new RequetesPDO();
	$reponse['ret'] = $RequetesPDO->deleteItem("clients", $_GET['id']);
	$reponse['clients']= $RequetesPDO->getTable("clients");
	echo json_encode($reponse);
}
catch (Exception $e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
}