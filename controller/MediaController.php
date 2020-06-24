<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

//searchbar
function mediaPage() {
  
  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::filterMedias( $search );

  require('view/mediaListView.php');

}

//contenu
function mediaContentPage() { 

  $mediaID = $_GET['media'];
  $mediaContent = Media::GetContent( $mediaID );
  $mediaSeasonContent = Media::GetSeasonContent( $mediaID );

  $search_1 = isset( $_POST['season'] ) ? $_POST['season'] : null;
  $mediaEpisodeContent = Media::GetEpisodeContent($mediaID, $search_1);

  require('view/mediaContentView.php');

}