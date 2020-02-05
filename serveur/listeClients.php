<?php

require_once("includes/chargementClasses.inc.php");

try {
	$RequetesPDO = new RequetesPDO();
	$lignes = $RequetesPDO->getTable("clients");
	$lignes = $RequetesPDO->getTable("clients");
	echo json_encode($lignes);
}
catch (Exception $e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
}