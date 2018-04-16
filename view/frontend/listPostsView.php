<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
	<h1>Mon super blog !</h1>
	<?php
	while ($data = $posts->fetch())
	{
	?>
		<div class="news">
			<h3>
				<?= htmlspecialchars($data['title']) ?>		
			</h3>
			<p>
				<?= htmlspecialchars($data['content'])?>
			</p>
			<span>
				<?= 'Le '. htmlspecialchars($data['creation_date']) ?>	
			</span>
			<a href="?action=post&id=<?= $data['id']?>">Commentaires</a>
		</div>
	<?php 
	}
$posts->closeCursor(); // end of the query

$content = ob_get_clean(); // content of the view
require('template.php'); // call the template 
?>