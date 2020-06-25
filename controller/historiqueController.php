<?php

require_once( 'model/historique.php' );

function historiquePage() { 
 
  $historiqueContent = Historique::getHistorique();
  require('view/historiqueView.php');

	if (isset($_GET['delete'])){
	  	$hID = $_GET['delete'];
	  	Historique::deleteHistorique($hID);	
	}  

}