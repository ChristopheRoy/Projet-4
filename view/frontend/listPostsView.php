<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
	<h1>Mon super blog !</h1>
	<a href="index.php?access=admin&page=dashboard">Panneau d'administration</a>
	<?php
	while ($data = $posts->fetch())
	{
	?>
		<div class="news">
			<p>
				<?= $data['content'] ?>
			</p>
			<span>
				<?= 'Le '. htmlspecialchars($data['creation_date']) ?>	
			</span>
			<a href="?action=post&id=<?= $data['id']?>">Commentaires</a>
		</div>
	<?php 
	}
$posts->closeCursor(); // end of the query
?>
<br>
<?php
$content = ob_get_clean(); // content of the view
require('template.php'); // call the template 
?>