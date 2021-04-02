<div class="wrapper">
    <h2 class="title">Se connecter</h2>
    <form method="post" novalidate>
        <div class="form-group">
            <label>Email :</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
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
            <input type="submit" class="btn btn-success" value="Se connecter">
        </div>

        <p class="form-footer-p">Pas encore inscrit·e ? <a href="<?php echo $base_uri; ?>/signup" class="link text-info">Inscrivez-vous</a>.</p>
    </form>
</div>