<?php

require_once("includes/chargementClasses.inc.php");

try {
	$RequetesPDO = new RequetesPDO();
	$ligne = $RequetesPDO->getItem("clients", $_GET['id']);
	echo json_encode($ligne);
}
catch (Exception $e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
}