<div class="wrapper">
    <h2 class="title">Ajouter une histoire</h2>
    <form action="" method="post" novalidate>
        <div class="form-group">
            <label>Titre de l'histoire :</label>
            <input type="text" name="stories_title" class="form-control">
        </div>

        <div class="form-group">
        <label>Contenu :</label>
            <textarea name="stories_content" cols="40" rows="5" class="form-control"></textarea>
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
            <input type="submit" class="btn btn-success" value="Publier mon histoire">
            <input type="reset" class="btn btn-danger" value="Annuler">
        </div>
    </form>
</div>
