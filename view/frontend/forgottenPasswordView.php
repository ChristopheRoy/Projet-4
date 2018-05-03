<?php
$title = 'Mot de passe oublié ?';
ob_start();?>
<div class="container">
	<div class="row">
		<div class="col-12 text-center mt-5">
			<h1 class="blue">Mot de passe oublié ?</h1>
			<p>Indiquez votre adresse e-mail ici, nous vous enverrons un e-mail avec un lien vous permettant de redéfinir votre mot de passe !</p>
			<br/>
			<form method="post" action="index.php?action=send_email">
				<label>Votre adresse mail</label><br/>
				<input type="email" name="email" placeholder="example@gmail.com" /><br/><br/>
				<input type="submit" value="Envoyer" class="btn btn-primary"/><br/>
			</form>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean();
require('template.php');