<?php

session_start();

require_once( 'model/user.php' );

/****************************
* ----- LOAD LOGIN PAGE -----
****************************/

function loginPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/loginView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- LOGIN FUNCTION -----
***************************/

/// Ajout d'une amélioration
/// password_verify(input, comparaison a la bdd)
/// J'ai choisi de faire ceci car c'est plus sécurisé que le SHA256 (qui est non aléatoire)
/// Cette fonctionalité va verifier entre ce que la personne à ecrit par rapport a la bdd
// CF : user.php > 45

function login( $post ) {

  $data           = new stdClass();
  $data->email    = $post['email'];
  $data->password = $post['password'];

  $user           = new User( $data );
  $userData       = $user->getUserByEmail();

  $error_msg      = "Email ou mot de passe incorrect";

  if($userData['verify'] == 1){ 
    if( $userData && sizeof( $userData ) != 0 ):    
      if( password_verify( $post['password'], $userData['password'])):

        // Set session
        $_SESSION['user_id'] = $userData['id'];

        header( 'location: index.php ');
      endif;
    endif;

    require('view/auth/loginView.php');
  }
  else{
    echo 'non tu dois être vérifier';
  }
}

/****************************
* ----- LOGOUT FUNCTION -----
****************************/

function logout() {
  $_SESSION = array();
  session_destroy();

  header( 'location: index.php' );
}
