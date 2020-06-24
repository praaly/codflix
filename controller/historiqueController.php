<?php

require_once( 'model/historique.php' );

function historiquePage() { 

  $historiqueContent = Historique::getHistorique();
  //$historiquedelete = Historique::deleteHistorique($hID);

  require('view/historiqueView.php');

}