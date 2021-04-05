<?php
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login");
    exit;
}
?>

<div class="wrapper">
    <h2 class="title">Supprimer votre profil</h2>
    <form action="" method="post" novalidate>
        <div class="form_group">
            <label>Email :</label>
            <input type="email" name="email" class="form-control" value="">
        </div>

        <div class="form_group">
            <label>Mot de passe :</label>
            <div class="form-group form-group-password">
                <input type="password" name="password" class="form-control" id="passwordField">
                <span onclick="toggle()" class="togglespan show-eye eye"></span>
            </div>
        </div>

        <?php if (!empty($viewVars['errorList'])) : ?>
            <?php foreach ($viewVars['errorList'] as $key => $error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form_group form-group-bottom">
            <input type="submit" class="btn btn-danger" value="Supprimer le profil">
            <a class="btn btn-link text-dark" href="<?php echo $base_uri; ?>/profil">Retourner à mon profil</a>
        </div>
    </form>
</div>