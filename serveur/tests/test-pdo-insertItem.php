<?php

require_once("../modeles/RequetesPDO.class.php");
require_once("../outils/SingletonPDO.class.php");
require_once("../outils/TraceDebug.class.php");


try {
	$RequetesPDO = new RequetesPDO();
	var_dump($RequetesPDO->insertItem("clients",
		['client_nom' => "aaa",
		 'client_prenom' => "bbb",
		 'client_date_naissance' => "2010-01-01",
		 'client_telephone' => "514 123-1234"
		])
	);
}
catch (Exception $e) {
	echo $e->getMessage();
}