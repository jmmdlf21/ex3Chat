<?php 

header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Origin: *");

function chargerClasse($classe) {
    $dossiers = array('outils/', 'modeles/', 'controleurs/');
	foreach ($dossiers as $dossier) {
        if (file_exists('./'.$dossier.$classe.'.class.php')) {
            require_once('./'.$dossier.$classe.'.class.php');
		}
	}
}

spl_autoload_register('chargerClasse');
