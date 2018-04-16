<?php

	$title = "Panneau d'administration";

	ob_start(); ?>
	<h1>Panneau d'administration</h1>
	<a href="index.php?action=createNewArticle">Créer un article</a>
	<?php

	while($post = $posts->fetch())
	{
		?>
		<div class="news">	
				<?= $post['content']?>
			<span>
				<?= 'Le '. $post['creation_date'] ?>	
			</span>
			<a href="index.php?action=edit&id=<?= $post['id'] ?>">Modifier</a>
		</div>
		<?php
	}
	$posts->closeCursor();
	$content = ob_get_clean();
	require('templateAdmin.php');
?>
