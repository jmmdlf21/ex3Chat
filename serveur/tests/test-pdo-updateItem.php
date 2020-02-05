<?php

require_once("../modeles/RequetesPDO.class.php");
require_once("../outils/SingletonPDO.class.php");
require_once("../outils/TraceDebug.class.php");


try {
	$RequetesPDO = new RequetesPDO();
	var_dump($RequetesPDO->updateItem("clients",
		['client_id' => 10,
		 'client_nom' => "aaaxxx",
		 'client_prenom' => "bbbxxx",
		 'client_date_naissance' => "2012-01-01",
		 'client_telephone' => "123 123-1234"
		])
	);
}
catch (Exception $e) {
	echo $e->getMessage();
}