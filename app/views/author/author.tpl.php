<div class="list">
    <!-- If no story related to this user then... -->
    <?php if(empty($viewVars['stories'])) { ?>  
        <p>Cet·te auteur·ice n'a pas encore écrit d'histoire !</p>
    <?php } else { ?>
        <h2 class="title">Liste des histoires de <?= $viewVars['stories']['0']->username; ?></h2>
        <!-- ... else show table with user's stories -->
        <table class="table table-bordered">
        <!-- <caption> helps users with screen readers to find a table and understand what it’s about-->
        <caption>Liste des histoires de <?= $viewVars['stories']['0']->username; ?>.</caption>
        <thead class="thead-dark">
            <tr>
            <th scope="col">Titre</th>
            <th scope="col">Écris par </th>
            <th scope="col">Accéder à l'histoire</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($viewVars['stories'] as $key=>$story) {?>
                <tr>
                    <td><?= $story->getStories_title(); ?></td>
                    <td><?= $story->username; ?></td>
                    <td><a href='<?= $base_uri; ?>/stories/<?= $story->getStories_id(); ?>' class='link-table'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' id='Book'><path d='M2 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/><path d='M12 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/></svg></a></td>
                </tr>
            <?php }; ?>
        </tbody>
        </table>
        <?php } ?>
    </div>
</div>