<div class="wrapper">
    <h2 class="title">Changer votre mot de passe</h2>
    <form action="" method="post" novalidate>
        <div class="form_group">
            <label>Nouveau mot de passe :</label>
            <div class="form-group form-group-password">
                <input type="password" name="new_password" class="form-control" id="passwordField" value="">
                <span onclick="toggle()" class="show-eye eye togglespan"></span>
            </div>
        </div>

        <div class="form-group">
            <label>Confirmer votre nouveau mot de passe :</label>
            <div class="form-group form-group-password">
                <input type="password" name="confirm_password" id="confirmPasswordField" class="form-control passwordField">
                <span onclick="toggleconfirm()" class="show-eye eye togglespanconfirm"></span>
            </div>
        </div>

        <?php if (!empty($viewVars['errorList'])) : ?>
            <?php foreach ($viewVars['errorList'] as $key => $error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group form-group-bottom">
            <input type="hidden" name="secure" value="<?php echo $viewVars['tokenCsrf']; ?>">
            <input type="submit" class="btn btn-success" value="Changer le mot de passe">
            <input type="reset" class="btn btn-danger" value="Annuler">
            <a class="btn btn-link text-dark" href="<?php echo $base_uri; ?>/profil">Retourner à mon profil</a>
        </div>
    </form>
</div>
