<?php

require_once( 'model/historique.php' );

function historiquePage() { 
 
  $user_id = $_SESSION['user_id'];
  $historiqueContent = Historique::getHistorique($user_id);
  require('view/historiqueView.php');


if (isset($_POST['delete'])){
  	$hID = $_POST['delete'];
  	Historique::deleteHistorique($hID);	
}  


if (isset($_POST['deleteall'])){
	$user_id = $_SESSION['user_id'];
  	Historique::deleteAllHistorique($user_id);

}  
}