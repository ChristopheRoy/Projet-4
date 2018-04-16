<?php

	$title = "Panneau d'administration";

	ob_start(); ?>
	<h1>Panneau d'administration</h1>
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
	$posts->closeCursor(); // end of the query
	$content = ob_get_clean(); // content of the view
	require('templateAdmin.php'); // call the template 
?>
