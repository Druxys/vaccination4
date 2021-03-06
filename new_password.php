<?php
include 'inc/pdo.php';
include 'inc/function.php';
include 'inc/request.php';

$error = array();
if (!empty($_GET['email']) && !empty($_GET['token'])) {
  $mail = urldecode($_GET['email']);
  $token = urldecode($_GET['token']);

  $user =selectuserfromtoken($token,$mail);

  if (!empty($user))
  {
    if (!empty($_POST['submitted']))
    {
      $password = trim(strip_tags($_POST['password']));
      $password2 = trim(strip_tags($_POST['password2']));
      if ((!empty($password)) && (!empty($password2)))
      {
        if(strlen($password) < 3 )
        {
          $error['password'] = 'trop court.';
        }
          elseif(strlen($password) > 50)
        {
          $error['password'] = 'trop long.';
        }
        elseif ($password != $password2)
        {
          $error['password'] = 'Veuillez renseigné le même mdp.';
        }
      }
      else
      {
        $error['password'] = 'Veuillez renseignez ce champ';
      }

      if (count($error) == 0)
      {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $new_token = generateRandomString(50);

        majpassword($user,$new_token,$hash);
        header('Location: index.php');
      }

    }
  }
}
else {
  die ('404');
}


// 1 - Formulaire avec un un champ password + un champ verif password
// 2 - Recupérer dans la bdd l'email ainsi que le token dans l'url
// 3 - Modifer dans la bdd le password correspondant et générer un nouveau token

include 'inc/header.php';
 ?>
 <form class="" method="post">
   <label for="password">Nouveau mot de passe : </label>
   <input type="password" name="password" value="">
   <?php
   afficherErreur($error, 'password');
   br(); ?>
   <label for="password2">Confirmer mot de passe : </label>
   <input type="password" name="password2" value="">
   <?php
   afficherErreur($error, 'password2');
   br(); ?>
   <input type="submit" name="submitted" value="Envoyer">
 </form>

 <?php
 include 'inc/footer.php';
