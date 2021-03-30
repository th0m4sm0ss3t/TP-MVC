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
                        <a class="nav-link text-white" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">Me connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="signup.php">M'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/list">Liste des histoires du site</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Effectuer une recherche
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="search_bar_stories.php">Par histoire</a>
                            <a class="dropdown-item text-white bg-dark" href="search_bar_author.php">Par auteur·ice</a>
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
                        <a class="nav-link text-white" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon profil
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="profil.php">Accéder à mon profil</a>
                            <a class="dropdown-item text-white bg-dark" href="logout.php">Me déconnecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="l/list">Liste des histoires du site</a>
                    </li>
                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-white bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Effectuer une recherche
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="search_bar_stories.php">Par histoire</a>
                            <a class="dropdown-item text-white bg-dark" href="search_bar_author.php">Par auteur·ice</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
<?php }
?>
