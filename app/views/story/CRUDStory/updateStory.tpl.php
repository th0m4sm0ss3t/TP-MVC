<?php
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header('Location: ' . $router->generate('login'));
        exit;
    }
?>

<h2 class="title" id="edit">Modifier votre histoire</h2>

<div class="wrapper">
    <form action="" method="post" novalidate>
        <div class="form-group">
            <label>Titre de l'histoire :</label>
            <input type="text" name="stories_title" class="form-control" value="<?= $viewVars['story']->getStories_title() ?>">
        </div>

        <div class="form-group">
            <label>Contenu :</label>
            <textarea name='stories_content' class='form-control'  cols='40' rows='5' value="<?php echo $value["stories_content"]; ?>"><?= $viewVars['story']->getStories_content(); ?></textarea>
        </div>

        <?php if (!empty($viewVars['errorList'])) : ?>
            <?php foreach ($viewVars['errorList'] as $key => $error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <input type='hidden' name='stories_id' value="<?= $viewVars['story']->getStories_id(); ?>"/>
        <div class="form-group form-group-bottom">
            <input type="submit" class="btn btn-success" value="Sauvegarder les changements">
            <input type="reset" class="btn btn-danger" value="Annuler">
        </div>
    </form>
</div>