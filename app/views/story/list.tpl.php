<div class="list">
    <h2 class="title">Liste des histoires</h2>
    <table class="table table-bordered">
      <!-- <caption> helps users with screen readers to find a table and understand what it’s about-->
      <caption>Liste des histoires.</caption>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Titre de l'histoire</th>
          <th scope="col">Auteur·ices</th>
          <th scope="col">Accéder à l'histoire</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($viewVars['stories'] as $key => $story) :?>
            <tr>
            <th><?= $story->getStories_title(); ?></th>
            <td><?= $story->username; ?></td>
            <td><a href='<?= $base_uri; ?>/stories/<?= $story->getStories_id(); ?>' class='link-table'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' id='Book'><path d='M2 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/><path d='M12 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/></svg></a></td>
            </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
</div>

<?php 
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    ?>
    <div class="form-group-bottom">
      <a href="login.php" class="btn bg-secondary text-white">Me connecter</a>
    </div>
    <?php
  } else {
    ?>
    <div class="form-group-bottom">
      <a href="<?= $base_uri; ?>/profil" class="btn bg-secondary text-white">Retourner sur mon profil</a>
    </div>
    <?php
  }
?>