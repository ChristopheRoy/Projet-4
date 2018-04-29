<?php require('view/frontend/menu.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="public/css/styles.css">
	</head>
	<body>
		<?= getMenu(); ?>
		<div class="mt-10">
			<?= $content ?>
		</div>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=7kcf4dx0hhm2as5zjm8cpjalfa5bj2ngf3whr5y47zogdi00"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
		<script src="public/js/jquery-3.2.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<footer class="p-2 text-center">© Jean Forteroche - <a href="" class="blue">Mentions légales</a></footer>
	</body>
</html>