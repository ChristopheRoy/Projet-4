<?php

$title = 'Accueil';
ob_start();?>

<div class="container-fluid indexHeader">
	<img class="banniere" src="public/img/alaska.jpg">
	<div class="overlay">
		<div class="texteBanniere">
			<h2><i class="fas fa-plane blue"></i> Billet simple pour l'Alaska</h2>
			<p>Mon dernier roman est disponible en ligne.</p>
			<a href="index.php?action=listPosts" class="btn btnConsulterPage">Consulter la page</a>
		</div>
		<div class="authorPicture d-none d-lg-block">
			<img src="public/img/author.jpg">
			<h3>Jean Forteroche</h3>
			<p>Acteur et écrivain.</p>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center presentation">
			<h1 class="mt-6 blue"><?= $messageDeBienvenue ?></h1>
			<p class="presentationText">
				Vous retrouverez ici toutes les informations sur mes romans ainsi que mes projets personnels.
			</p>
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-3 presentationSection">
					<i class="fas fa-pencil-alt fa-4x blue"></i>
					<h2 class="mb-5">Mes projets</h2>
					<p class="text-justify mb-5">Lorem ipsum dolor sit amet  duis ultrices mauris ut quam consequat, consectetur adipiscing elit. Cras ut odio sodales, tempus metus non, vulputate metus. Duis ultrices mauris ut quam consequat, ac vestibulum nisl iaculis. </p>
					<a href="#" class="btn btn1">Plus d'infos</a>
				</div>
				<div class="col-12 col-md-8 col-lg-3 presentationSection">
					<i class="fas fa-book fa-4x blue"></i>
					<h2 class="mb-5">Mon dernier roman</h2>
					<p class="text-justify mb-5">Lorem ipsum dolor sit amet  duis ultrices mauris ut quam consequat, consectetur adipiscing elit. Cras ut odio sodales, tempus metus non, vulputate metus. Duis ultrices mauris ut quam consequat, ac vestibulum nisl iaculis. </p>
					<a href="index.php?action=listPosts" class="btn btn2">En savoir plus</a>
				</div>
				<div class="col-12 col-md-8 col-lg-3 presentationSection">
					<i class="fas fa-user fa-4x blue"></i>
					<h2 class="mb-5">Réseaux sociaux</h2>
					<p class="text-justify mb-5">Lorem ipsum dolor sit amet  duis ultrices mauris ut quam consequat, consectetur adipiscing elit. Cras ut odio sodales, tempus metus non, vulputate metus. Duis ultrices mauris ut quam consequat, ac vestibulum nisl iaculis. </p>
					<span>
						<a href=""><i class="fab fa-facebook-f fa-2x mr-3"></i></a>
						<a href=""><i class="fab fa-twitter fa-2x mr-3"></i></a>
						<a href=""><i class="fab fa-instagram fa-2x mr-3"></i></a>
						<a href=""><i class="fab fa-google-plus-g fa-2x mr-3"></i></a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

if(!isset($_SESSION['id']) && !isset($_SESSION['name']))
{
	?>
		<div class="signInSignUpSection">
			<button class="btn btnInscription" data-toggle="modal" data-target="#ModalInscription">S'inscrire</button>
			<button class="btn btnConnexion" data-toggle="modal" data-target="#ModalConnexion">Se connecter</button>
		</div>

	<?php
}

?>
<?php
$content = ob_get_clean();
require('template.php');