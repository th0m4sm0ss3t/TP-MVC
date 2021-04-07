<h2 class="title">Effectuer une recherche par histoire</h2>
<div class="wrapper__search">
    <form action="" method="POST" novalidate>
        <div class="form-group form-group-search">
            <input class="form-control form-control-search" type="text" name="search" placeholder="Rechercher..."/>
            <input type="submit" value="Rechercher"  class="btn btn-info" />
        </div>
    </form>
</div>

<!-- On affiche un message pour indiquer qu'une recherche ne doit pas être vide -->
<?php if (!empty($viewVars['errorList'])) : ?>
    <?php foreach ($viewVars['errorList'] as $key => $error) : ?>
        <div class="alert alert-danger title w-75 mx-auto" role="alert">
            <?= $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- On affiche un message pour indiquer le nombre de résultat -->
<?php if (!empty($viewVars['resultMessage'])) : ?>

    <?php foreach ($viewVars['resultMessage'] as $key => $message) : ?>
        <p class="title"><?= $message; ?></p>
    <?php endforeach; ?>

    <!-- On affiche les résultats de recherches uniquement une recherche a bien été effectuée et qu'elle contient au moins 1 résultat -->
    <div class="card_results"><?php
        if (!empty($viewVars['fetchedResults'])){
            foreach ($viewVars['fetchedResults'] as $key => $result) : ?>

            <div class="card text-center border-info" style="width: 20rem;">
                <div class="card-body">
                    <h2 class="card-title bg-light">
                        <?= $result->getStories_title();?>
                    </h2>
                    <p class="card-text"><?= mb_strimwidth($result->getStories_content(), 0, 340, '...'); ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><a href='<?= $base_uri;?>/stories/<?= $result->getStories_id(); ?>' class="btn btn-info">Accéder à l'histoire</a></small>
                </div>
            </div>

            <?php endforeach ;  ?>
        <?php } ?>
    </div>

<?php endif; ?>