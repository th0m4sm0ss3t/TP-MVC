<?php
  // Check if the user is logged in, if not then redirect them to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header('Location: ' . $router->generate('login'));
      exit;
  }
?>

<div class="page-header">
    <h1 class="title">Bienvenue sur votre profil <b><?php echo htmlspecialchars($_SESSION['userObject']->getUsername()); ?></b> !</h1>
    <p class="title">Nous sommes le <?php  echo $viewVars['todaysDate']; ?> et il est <?php echo date("H:i", $viewVars['timestamp']) ?>.</p>
</div>

<div class="profil_infos">
    <h2 class="title">Vos informations :</h2>
    <p>Pseudo : <?php echo htmlspecialchars($_SESSION['userObject']->getUsername()) ;?></p>
    <p>Adresse mail : <?php echo htmlspecialchars($_SESSION['userObject']->getEmail()) ; ?></
</div>

<div class="form-group-bottom">
    <a href="<?php echo $base_uri; ?>/resetPassword" class="btn form-group-bottom-btn bg-secondary text-white">Changer votre mot de passe</a>
    <a href="<?php echo $base_uri; ?>/logout" class="btn form-group-bottom-btn btn-info">Se déconnecter</a>
    <a href="<?php echo $base_uri; ?>/deleteProfil" class="btn form-group-bottom-btn btn-danger">Supprimer le profil</a>
</div>
</div>

<div class="add_story_profildiv">
<h2 class=" title title_add_story">Ajouter une nouvelle histoire</h2>
  <a class="btn btn-dark plus_btn" href="<?php echo $base_uri; ?>/addStory" role="button"><svg fill="none" viewBox="0 0 24 24" height="40" width="40" xmlns="http://www.w3.org/2000/svg">
  <path xmlns="http://www.w3.org/2000/svg" d="M12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM12 7C12.5523 7 13 7.44772 13 8V11H16C16.5523 11 17 11.4477 17 12C17 12.5523 16.5523 13 16 13H13V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V13H8C7.44772 13 7 12.5523 7 12C7 11.4477 7.44772 11 8 11H11V8C11 7.44772 11.4477 7 12 7Z" fill="#fff"></path>
  </svg></a>
</div>

<div class="list">
    <h2 class="title">Liste de vos écrits</h2>
    <!-- If no story related to this user then... -->
    <?php if(empty($viewVars['userStoriesInfos'])) {?>
        <p>Vous n'avez pas encore écrit d'histoire !</p>
    <?php } else { ?>

    <!-- ... else show table with user's stories -->
    <table class="table table-bordered">
      <!-- <caption> helps users with screen readers to find a table and understand what it’s about-->
      <caption>Liste de vos écrits.</caption>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Titre</th>
          <th scope="col">Accéder à l'histoire</th>
          <th scope="col">Modifier</th>
          <th scope="col">Suppression</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($viewVars['userStoriesInfos'] as $key => $value) {?>
            <tr>
                <td><?php echo $value->stories_title; ?></td>
                <td><a href='<?php echo $base_uri; ?>/stories/<?php echo $value->stories_id; ?>' class='link-table'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' id='Book'><path d='M2 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/><path d='M12 6s1.5-2 5-2 5 2 5 2v14s-1.5-1-5-1-5 1-5 1V6z'/></svg></a></td>
                <td><a href='<?php echo $base_uri; ?>/updateStory/<?php echo $value->stories_id; ?>' class='link-table'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' id='Pencil'><path d='M3.428 16.572L17 3a2.828 2.828 0 114 4L7.428 20.572a2 2 0 01-1.022.547L2 22l.881-4.406a2 2 0 01.547-1.022z'/><path d='M4 16l4 4'/><path d='M14 6l4 4'/></svg></a></td>
                <td><!-- Button trigger modal -->
                <button type="button" class="btn btn-transparent link-table" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' id='TrashCan'><path d='M4 6h16l-1.58 14.22A2 2 0 0116.432 22H7.568a2 2 0 01-1.988-1.78L4 6z'/><path d='M7.345 3.147A2 2 0 019.154 2h5.692a2 2 0 011.81 1.147L18 6H6l1.345-2.853z'/><path d='M2 6h20'/><path d='M10 11v5'/><path d='M14 11v5'/></svg>
                </button></td>
            </tr>
          <?php }; ?>
      </tbody>
    </table>
    <?php } ?>
</div>

<!-- MODAL DELETE -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Êtes-vous sûr·e de vouloir supprimer définitivement votre histoire ?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="secure" value="<?php echo $viewVars['tokenCsrf']; ?>">
        <button type="button" class="btn btn-danger"><a href='<?php echo $base_uri; ?>/deleteStory/<?= $value->stories_id ?>' class="text-white">Oui, supprimer</a></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Finalement non</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL DELETE -->