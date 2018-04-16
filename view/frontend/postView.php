<?php

$title = 'Article';
ob_start();

?>

<div class="news">
	<h3><?php echo $post['title']; ?></h3>
	<p><?php echo $post['content']; ?></p>
</div>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php
while($comment = $comments->fetch())
{
	?>
	<p><?= $comment['author'].' le '.$comment['comment_date_fr'].'<br/>'.$comment['comment']; ?></p>
	<?php
}
$comments->closeCursor();
$content = ob_get_clean();
require('template.php');

?>








