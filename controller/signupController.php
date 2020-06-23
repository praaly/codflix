<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require_once('view/auth/signupView.php');
  else:
    require_once('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function signup($post){

  $data = new stdClass();
  $data->email = $post['email'];
  $data->password = $post['password'];
  $data->password_confirm = $post['password_confirm'];

  try {
      $user = new User ($data);
      $user->createUser();
      header( 'location: index.php?action=login ');
  }
  catch (Exception $error){
      $error_msg = $error->getMessage();
      require_once('view/auth/signupView.php');
      
  }
  

}