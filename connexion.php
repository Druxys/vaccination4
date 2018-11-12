<?php
include 'inc/pdo.php';
include 'inc/function.php';
include 'inc/request.php';

$error = array();
if (!empty($_POST['submitted']))
{
  $login_mail = trim(strip_tags($_POST['login_mail']));
  $password = trim(strip_tags($_POST['password']));

  $error=connect($login_mail,$password);
  if(count($error) == 0)
  {
    $_SESSION['user'] = array(
      // Clé unique pour eviter les problèmes de connexion
      'id' => $user['id'],
      'pseudo' => $user['pseudo'],
      'email' => $user['email'],
      'role' => $user['role'],
      'ip' => $_SERVER['REMOTE_ADDR']
    );
    header('Location: user_log.php');
  }
 }

 // lien vers une page mdp oublié

include 'inc/header.php';
 ?>

 <form method="post">
    <label for="login_mail">Login ou e-mail :</label>
    <input type="text" name="login_mail" value="">
    <?php
    afficherErreur($error, 'login_mail');
    br(); ?>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" value="">
    <?php
    afficherErreur($error, 'password');
    br(); ?>
    <a href="password_forget.php">Mot de passe oublié?</a>
    <input type="submit" name="submitted" value="Envoyer">
 </form>

 <?php
include 'inc/footer.php';
