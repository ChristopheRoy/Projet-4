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
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="#">Jean Forteroche</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul id="myScrollspy" class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Accueil</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?action=listPosts">Mon roman</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?access=admin&interface=dashboard">Panneau d'administration</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?action=disconnect">Se déconnecter</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="mt-10">
			<?= $content ?>
		</div>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=7kcf4dx0hhm2as5zjm8cpjalfa5bj2ngf3whr5y47zogdi00"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
		<script src="public/js/jquery-3.2.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	</body>
</html>