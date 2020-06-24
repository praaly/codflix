<?php

require_once( 'database.php' );

class Historique {


// ON APPELLE CETTE BASE POUR AFFICHER LE NOM AU LIEU DE ID (voir si une autre methode déjà fait par php pour simplifier)
public static function transformID($media_id){

$db   = init_db();

$req  = $db->prepare( "SELECT * FROM media WHERE id = :id" );
$req->bindValue(':id', $media_id);
$req->execute();

$db   = null;
return $req->fetch(); 
}


// PERMET D'AFFICHER L'HISTORIQUE
public static function getHistorique(){

	$db   = init_db();

	$req  = $db->prepare( "SELECT * FROM history" );
	$req->execute();

	$db   = null;
	return $req->fetchAll(); 
}


// PERMET DE SUPPRIMER UN HISTORIQUE
public static function deleteHistorique($hID){

	$db   = init_db();

	$req  = $db->prepare( "DELETE FROM history WHERE id = :id" );
	$req->bindValue(':id', $media_id);
	$req->execute();

	$db   = null;
	return $req->fetchAll(); 
}

}
