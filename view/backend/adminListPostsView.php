<?php

	$title = "Panneau d'administration";

	ob_start(); ?>
	<h1>Panneau d'administration</h1>
	<a href="index.php?action=createNewArticle">Créer un article</a>
	<form method="POST" action="index.php?action=delete_post">
	<?php

	while($post = $posts->fetch())
	{
		?>
		<div class="news">	
				<?= $post['content']?><input type="checkbox" name="checked_post_id[]" value="<?= $post['id']; ?>">
			<span><?= 'Le '. $post['creation_date'] ?></span>
			<a href="index.php?action=edit&id=<?= $post['id'] ?>">Modifier</a>
		</div>
		<?php
	}
	?>
		<input type="submit" value="Effacer la sélection">
	</form>
	<?php
	$posts->closeCursor();
	$content = ob_get_clean();
	require('templateAdmin.php');
?>
