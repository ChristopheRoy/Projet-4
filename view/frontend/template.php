<?php
if(isset($_SESSION['id']) && isset($_SESSION['name']) && $_SESSION['rank'] == 'default_user')
{
	ob_start();?>
	<a href="index.php?action=disconnect">Se déconnecter</a>
	<?php
	$menu = ob_get_clean();
}
else if(isset($_SESSION['id']) && isset($_SESSION['name']) && $_SESSION['rank'] == 'admin')
{
	ob_start();?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="#"><span class="blue">J</span>ean <span class="purple">F</span>orteroche</a>
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
	<?php
	$menu = ob_get_clean();
}
else
{
	ob_start();
	?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="#"><span class="blue">J</span>ean <span class="purple">F</span>orteroche</a>
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
						<a class="nav-link"  data-toggle="modal" href="#ModalConnexion">Se connecter</a>
					</li>
					<li class="nav-item">
						<a class="nav-link"  data-toggle="modal" href="#ModalInscription">S'inscrire</a>
					</li>
				</ul>
			</div>
		</nav>

			<!-- Modal Inscription -->
	<div class="modal fade" id="ModalInscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="index.php?action=add_user">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Pseudo">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<input type="password" name="password1" class="form-control" placeholder="Mot de passe">
						</div>
						<div class="form-group">
							<input type="password" name="password2" class="form-control" placeholder="Mot de passe">
						</div>
						<button type="submit" class="btn btn-primary">S'inscrire</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Connexion -->
	<div class="modal fade" id="ModalConnexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="index.php?action=sign_in">
						<div class="form-group">
							<input type="text" name="name"  class="form-control" placeholder="Pseudo"/>
						</div>
						<div class="form-group">
							<input type="password" name="password"  class="form-control" placeholder="Mot de passe" />
						</div>
						<button type="submit" class="btn btn-primary">Se connecter</button>
						<a href="index.php?action=forgotten_password">Mot de passe oublié ?</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	$menu = ob_get_clean();
}

?>

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
		<?= $menu ?>
		<div class="mt-10">
			<?= $content ?>
		</div>
		<script src="public/js/jquery-3.2.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	</body>
</html>