<?php

/**
 * Classe RequetesPDO, accès PDO aux tables MySQL
 *
 */

class RequetesPDO {

    /**
     * Récupération des lignes d'une table 
     *
	 * @return array
     */
    public function getDernierId() {
		$sPDO = SingletonPDO::getInstance();
		$oPDOStatement = $sPDO->query("SELECT id_message FROM `messages` ORDER BY id_message DESC LIMIT 1");
		return $oPDOStatement->fetch(PDO::FETCH_ASSOC);
	}

    /**
     * Récupération des lignes d'une table 
     *
	 * @return array
     */
    public function getMessages($messages, $dernierId) {
		$sPDO = SingletonPDO::getInstance();
		$cleNom =  "id_" . substr($messages, 0, -1);

		$oPDOStatement = $sPDO->query("SELECT * FROM $messages 
									   WHERE $cleNom > $dernierId  
									   ORDER BY $cleNom DESC");
		return $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupération des lignes d'une table 
     *
	 * @return array
     */
    public function getTable($table) {
		TraceDebug::log(__METHOD__);
		$sPDO = SingletonPDO::getInstance();
		$cleNom =  substr($table, 0, -1) . "_id";
		$oPDOStatement = $sPDO->query("SELECT * FROM $table ORDER BY $cleNom DESC");
		return $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }

	
    /**
     * Récupération d'une ligne dans une table avec sa clé primaire
     *
	 * @return array
     */
    public function getItem($table, $cle) {
		$sPDO = SingletonPDO::getInstance();
		$cleNom =  substr($table, 0, -1) . "_id";
		$oPDOStatement = $sPDO->prepare("SELECT * FROM $table WHERE $cleNom=:$cleNom");
		$oPDOStatement->bindValue(":$cleNom", $cle);
		$oPDOStatement->execute();
		return $oPDOStatement->fetch(PDO::FETCH_ASSOC);
	}
	
  	/**
     * Ajout d'un message dans une table
     *
	 * @return boolean false if no row added, true otherwise
     */
    public function insertMessage($table, $donnees) {
		$sPDO = SingletonPDO::getInstance();

		$req = "INSERT INTO $table SET 
				id_webdiffusion = 1, 
				pseudo = 'U3', 
				message = '" . $donnees["message"] . "', 
				date_heure = NOW()";

		$oPDOStatement = $sPDO->prepare($req); 
		$oPDOStatement->execute();

		if ($oPDOStatement->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
    }	
    
  /**
     * Ajout d'un item dans une table
     *
	 * @return boolean false if no row added, true otherwise
     */
    public function insertItem($table, $champs) {
		$sPDO = SingletonPDO::getInstance();
		
		$req = "INSERT INTO $table SET ";
		foreach ($champs as $nom => $valeur) {
			$req .= "$nom=:$nom, ";
		}
		$req = substr($req, 0, -2);
		
		$oPDOStatement = $sPDO->prepare($req); 
		
		foreach ($champs as $nom => $valeur) {
			$oPDOStatement->bindValue(":$nom", $valeur);
		}
		$oPDOStatement->execute();
		if ($oPDOStatement->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
    }

    
    /**
     * Modification d'un item dans une table
     *
	 * @return boolean false if no row modified, true otherwise
     */
    public function updateItem($table, $champs) {
		$sPDO = SingletonPDO::getInstance();
		$cleNom =  substr($table, 0, -1) . "_id";
		$req = "UPDATE $table SET ";
		foreach ($champs as $nom => $valeur) {
			$req .= "$nom=:$nom, ";
		}
		$req = substr($req, 0, -2);
		$req .= " WHERE $cleNom=:$cleNom";
		
		$oPDOStatement = $sPDO->prepare($req); 
		
		foreach ($champs as $nom => $valeur) {
			$oPDOStatement->bindValue(":$nom", $valeur);
		}
		$oPDOStatement->bindValue(":$cleNom", $champs[$cleNom]);
		$oPDOStatement->execute();
		if ($oPDOStatement->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

    }	


    /**
     * Suppression d'un item dans une table
     *
	 * @return boolean false if no row deleted, true otherwise
     */
    public function deleteItem($table, $cle) {
		TraceDebug::log(__METHOD__);
		$sPDO = SingletonPDO::getInstance();
		$cleNom =  substr($table, 0, -1) . "_id";
		$oPDOStatement = $sPDO->prepare("DELETE FROM $table WHERE $cleNom=:$cleNom"); 
		$oPDOStatement->bindValue(":$cleNom", $cle);
		$oPDOStatement->execute();
		if ($oPDOStatement->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
    }
}