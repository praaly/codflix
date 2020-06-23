<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;
  protected $password_confirm;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    // $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number    = preg_match('@[0-9]@', $password);
    // $specialChars = preg_match('@[^\w]@', $password);    
    
    // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8):
    //   throw new Exception( 'Votre mot de passe doit inclure : 8 caractères, 1 Lettre majuscule, 1 Numéro, 1 caractère spécial' );

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    //crée un nouveau hachage en utilisant un algorithme de hachage fort et irréversible
    $this->password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email déjà utilisé" );

    // Insert new user
    $req->closeCursor();

    $emailsend = $this->getEmail();
   	$token = bin2hex(random_bytes(50));

    $req  = $db->prepare( "INSERT INTO user ( email, password, token ) VALUES ( :email, :password, :token )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword(),
      'token' => $token
    ));

    // Close databse connection
    $db = null;    

	$to      = $emailsend;
	$subject = 'CODFLIX VERIFIER VOTRE COMPTE';
	$message = '
	<style type="text/css">
	  a {
	    text-decoration: none;
	    color: #666;
	    font-weight: bold;
	  }
	  td {
	    padding: 25px;
	  }
	</style>
	<table align="center" width="600px" style="background:white; margin-top: 35px; border-collapse: collapse; border: 1px solid #ccc; box-shadow: 0 0 7px 2px #ccc">
	  <tr style="border: 0px solid #999;">
	    <th colspan="2" align="left" style="height: 90px; border: 0px solid #999;"></th>
	  </tr>
	  <tr>
	    <td colspan="2" align="left">
	      <h1 style="color: #009688;">Bienvenue '.$emailsend.'</h1>
	      <p>Merci de t avoir inscrit sur CODFLIX le nouveau site de streaming, Vous pouvez activer votre compte afin de profiter de nos avantages, si cet email ne vous ait pas destiné merci de ne pas cliquer sur le lien.</p>
	      <p>Il y a {nombre de serie) ajouées ce mois ci.</p>
	      <p>Cordialement l équipe CODFLIX</p>
	    </td>
	  </tr>
	  <tr>
	    <td style="padding: 0 25px" colspan="2">
	      <hr style="border: 0px solid black; border-bottom: 1px solid #ccc;">
	    </td>
	  </tr>
	  <tr>
	    <td align="left" style="padding: 0 25px 25px 25px">
	      <p style="color: #bbb">
	        Alexandre Luast<br>
	        <span style="font-size: 10pt;">
	          Coding Factory<br>
	          alexandre.luast@edu.itescia.fr
	        </span>
	      </p>
	    </td>
	    <td style="padding-top: 0;" align="right">
	      <div style="padding:0; background-color:#ff3232; width: 200px; height: 50px;"><br/><center><a href="http://praaly.fr/itescia/controller/tokenVerify.php?email='.$emailsend.'&token='.$token.'">VALIDER</a></center></div>
	    </td>
	  </tr> 
	</table>';		
	$headers = 'MIME-Version: 1.0' . "\r\n" .
	'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
	'From: support@codflix.com' . "\r\n" .
	'Reply-To: noreply@codflix.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

  }
  

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/ 

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

}