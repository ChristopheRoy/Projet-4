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
	<a href="index.php?action=disconnect">Se déconnecter</a>
	<a href="index.php?access=admin&page=dashboard">Panneau d'administration</a>
	<?php
	$menu = ob_get_clean();
}
else
{
	ob_start();
	?>
	<h3>Se connecter</h3>
	<form method="post" action="index.php?action=sign_in">
		<input type="text" name="name" placeholder="Pseudo"/><br/>
		<input type="password" name="password" placeholder="Mot de passe" /><br/><br/>
		<input type="submit" value="Se connecter">
	</form>

	<h1>S'inscrire</h1>

	<form method="post" action="index.php?action=add_user">
		<input type="text" name="name" placeholder="Pseudo" /><br/>
		<input type="email" name="email" placeholder="Email" /><br/>
		<input type="password" name="password1" placeholder="Mot de passe" /><br/>
		<input type="password" name="password2" placeholder="Mot de passe" /><br/><br/>
		<input type="submit" value="S'inscrire" />
	</form>

	<?php
	$menu = ob_get_clean();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/styles.css">
	</head>
	<body>
		<?= $menu ?>
		<?= $content ?>
	</body>
</html>