<?php
require_once( '../model/database.php' );

/// tokenverify.php
/// Quand l'utilisateur ira sur ce lien nous allons récupérer les champs et comaprer avec la base de donnés.
/// requete


// on récuperer les donnés de URL
$email = $_GET['email'];
$token = $_GET['token'];

//on initialise la db
$db = init_db();

$sql_email = $db->prepare('SELECT token FROM user WHERE email = :email');
$sql_email->bindValue(':email', $email);
$sql_email->execute();

$email_result = $sql_email->fetch();

// on vérifie sur le token de URL est le même que celui de la table
if($email_result['token'] == $token){

$update_email = $db->prepare('UPDATE user SET verify = "1" WHERE email = :email');
$update_email->bindValue(':email', $email);
$update_email->execute();

header('Location : ../index.php');

}else{
echo 'non pas verifier';
}


?>