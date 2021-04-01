<?php foreach ($viewVars['story'] as $key=>$story) : ?>
    <h2 class="title"><?php echo $story["stories_title"]; ?></h2>
    <div class="story_content"><?php echo nl2br($story["stories_content"]); ?></div>
    <p class="title"><?php echo $story["username"]; ?></p>
<?php endforeach; ?>