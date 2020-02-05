<?php

require_once("includes/chargementClasses.inc.php");

try {
	$RequetesPDO = new RequetesPDO();
	$dernierId   = $_GET["dernierId"];

	// Initialise le dernierId la premiere fois que la page est ouverte
	if($dernierId == "empty") {
		$ligne = $RequetesPDO->getDernierId();
		$dernierId = $ligne["id_message"] - 1;
	}

	$lignes = $RequetesPDO->getMessages("messages", $dernierId);
	echo json_encode($lignes);
}
catch (Exception $e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo $e->getMessage();
}