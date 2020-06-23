<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['titl'] ) ? $_GET['titl'] : null;
  $medias = Media::filterMedias( $search );

  $medias = Media::GetMedia();

  require('view/mediaListView.php');

}
