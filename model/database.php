<?php

/*************************************
* ----- INIT DATABASE CONNECTION -----
*************************************/

function init_db() {
  try {

    //SERVER (PHP MAIL DEBUG)
    // $host     = 'db5000527661.hosting-data.io';
    // $dbname   = 'dbs506520';
    // $charset  = 'utf8';
    // $user     = 'dbu293874';
    // $password = '76Uh?mV5@';

    // LOCAL
    $host     = 'localhost';
    $dbname   = 'user';
    $charset  = 'utf8';
    $user     = 'root';
    $password = '';

    $db = new PDO( "mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password );

  } catch(Exception $e) {

    die( 'Erreur : '.$e->getMessage() );

  }

  return $db;
}
