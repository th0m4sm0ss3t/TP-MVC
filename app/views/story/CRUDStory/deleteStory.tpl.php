<h2 class="title">Supprimer définitivement mon histoire</h2>

<div class="wrapper">
    <form action="" method="post" novalidate>
        <input type="hidden" name="stories_id" value="<?= $story_id; ?>"/>
        <p class="title">Êtes-vous sûr·e de vouloir supprimer définitivement votre histoire ?</p><br>
        <div class="form-group form-group-bottom">
            <input type="submit" class="btn btn-danger" value="Oui, supprimer">
            <a href="<?= $base_uri; ?>/profil" type="reset" class="btn btn-secondary">Finalement non</a>
        </div>
    </form>
</div>