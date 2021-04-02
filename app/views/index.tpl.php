<?php 
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    ?>
    <h2 class="title">Bienvenue !</h2>
    <div class="index-wrapper">
        <div class="form-group-index col-10 col-sm-8 col-md-5">
            <img src="<?php echo $base_uri; ?>/assets/img/login_user.svg" alt="me connecter" class="svg">
            <a href="<?php echo $base_uri; ?>/login" class="btn bg-secondary text-white">Me connecter</a>
        </div>

        <div class="form-group-index col-10 col-sm-8 col-md-5">
            <img src="<?php echo $base_uri; ?>/assets/img/add_user.svg" alt="m'inscrire" class="svg">
            <a href="<?php echo $base_uri; ?>/signup" class="btn bg-secondary text-white">M'inscrire</a>
        </div>
    </div>
   
    <?php
  } else {
    ?>
    <h2 class="title">Bienvenue <b><?php echo htmlspecialchars($_SESSION['userObject']->getUsername()); ?></b> !</h2>
    <div class="index-wrapper">
        <div class="form-group-index col-10 col-sm-8 col-md-5">
            <img src="<?php echo $base_uri; ?>/assets/img/access_profil.svg" alt="accéder à mon profil" class="svg">
            <a href="<?php echo $base_uri; ?>/profil" class="btn bg-secondary text-white">Accéder à mon profil</a>
        </div>
        <div class="form-group-index col-10 col-sm-8 col-md-5">
            <img src="<?php echo $base_uri; ?>/assets/img/access_list.svg" alt="liste" class="svg">
            <a href="<?php echo $base_uri; ?>/stories" class="btn bg-secondary text-white">Accéder à la liste </br> des histoires</a>
        </div>
    </div>
    <?php
  }
?>