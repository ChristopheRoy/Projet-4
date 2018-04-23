<?php
$title = 'Mot de passe oublié ?';
?>
<h1>Mot de passe oublié ?</h1>
<p>Indiquez votre adresse e-mail ici, nous vous enverrons un e-mail avec un lien vous permettant de redéfinir votre mot de passe !</p>
<br/>
<form method="post" action="index.php?action=send_email">
	<input type="email" name="email" placeholder="Votre adresse mail" /><br/><br/>
	<input type="submit" value="Envoyer" /><br/>
</form>
<?php