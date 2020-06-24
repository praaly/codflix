<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ? ORDER BY release_date DESC" );
    $req->execute( array( '%' . $title . '%' ));

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }  

  // UN FILM/SERIE
  public static function GetContent($mediaID){

    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE id=:id" );
    $req->bindValue(':id', $mediaID);
    $req->execute();

    $db   = null;
    return $req->fetch(); 

  }

  // PERMET DE VOIR TOUS LES SAISONS
  public static function GetSeasonContent($mediaID){

    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM listseason WHERE id_serie=:id" );
    $req->bindValue(':id', $mediaID);
    $req->execute();

    $db   = null;
    return $req->fetchAll(); 

  }

    // PERMET DE VOIR TOUS LES EPISODES
  public static function GetEpisodeContent($mediaID, $search_1){

  $db   = init_db();

  $req  = $db->prepare( "SELECT * FROM listepisode WHERE id_serie=:id AND id_season=:result ORDER BY release_date DESC" );
  $req->bindValue(':id', $mediaID);
  $req->bindValue(':result', $search_1);    
  $req->execute();

  // Close databse connection
  $db   = null;

  return $req->fetchAll();

}

}
