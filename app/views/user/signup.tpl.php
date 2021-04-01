<div class="wrapper">
    <h2 class="title">S'inscrire</h2>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Email :</label>
            <input type="email" name="email" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>Pseudo :</label>
            <input type="text" name="username" class="form-control" value="">
        </div>

        <div class="form-group">
        <label>Mot de passe :</label>
            <div class="form-group form-group-password">
                <input type="password" name="password" class="form-control" id="passwordField" value="">
                <span onclick="toggle()" class="show-eye eye togglespan"></span>
            </div>
        </div>

        <div class="form-group">
        <label>Confirmer le mot de passe :</label>
            <div class="form-group form-group-password">
                <input type="password" name="confirm_password" class="form-control" id="confirmPasswordField" value="">
                <span onclick="toggleconfirm()" class="show-eye eye togglespanconfirm"></span>
            </div>
        </div>

        <div class="form-group form-group-bottom">
            <input type="submit" class="btn btn-success" value="S'inscrire">
            <input type="reset" class="btn btn-danger" value="Annuler">
        </div>
    </form>
    <p class="form-footer-p">Déjà inscrit·e ? <a href="<?php echo $base_uri; ?>/login" class="link text-info">Connectez-vous</a>.</p>
</div>