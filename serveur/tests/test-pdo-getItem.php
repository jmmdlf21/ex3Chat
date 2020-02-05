<?php

require_once("../modeles/RequetesPDO.class.php");
require_once("../outils/SingletonPDO.class.php");
require_once("../outils/TraceDebug.class.php");


try {
	$RequetesPDO = new RequetesPDO();
	var_dump($RequetesPDO->getItem("clients", 3));
}
catch (Exception $e) {
	echo $e->getMessage();
}