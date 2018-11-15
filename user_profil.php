<?php
  include 'inc/pdo.php';
  include 'inc/function.php';
  include 'inc/request.php';

  $id = $_SESSION['user']['id'];
  $resultat = array();
  if(!empty($id) && is_numeric($id)){
    if($_SESSION['user']['id'] == $id){
      $resultat = recoveruserdata($id);
    }
    else{
      header('Location: page403.php');
    }
  }
else{
  header('Location: page404.php');
}


  include 'inc/header.php';
?>
<div class="modifprofil">
  <h3>Votre profil</h3>
  <div class="profil">
    <p>Pseudo : <?php echo $resultat['pseudo']?></p>
    <p>Email : <?php echo $resultat['email']?></p>
    <p>Nom : <?php echo $resultat['nom']?></p>
    <p>Prénom : <?php echo $resultat['prenom']?></p>
    <p>Age : <?php echo $resultat['age']?></p>
    <button  type="button" name="button" onclick="window.location.href='edit_profil.php'">Modifier</button>
  </div>
</div>

<?php
  include 'inc/footer.php';
