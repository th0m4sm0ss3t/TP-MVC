<?php 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   ?>
    <section id="nav">
        <nav class="navbar navbar-dark bg-dark navbar-expand-md py-2">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks"><span
                    class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarLinks">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/login">Me connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/signup">M'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/stories">Liste des histoires du site</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Effectuer une recherche
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/searchStory">Par histoire</a>
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/searchAuthor">Par auteur·ice</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
   <?php
} else {
    ?>
    <section id="nav">
        <nav class="navbar navbar-dark bg-dark navbar-expand-md py-2">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks"><span
                    class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarLinks">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/">Accueil</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon profil
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/profil">Accéder à mon profil</a>
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/logout">Me déconnecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $base_uri; ?>/stories">Liste des histoires du site</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Effectuer une recherche
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/searchStory">Par histoire</a>
                            <a class="dropdown-item text-white bg-dark" href="<?php echo $base_uri; ?>/searchAuthor">Par auteur·ice</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
<?php }
?>
