<?php

$title = 'Commentaire';

ob_start(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h1 class="blue">Commentaire</h1>
			<?= 'Par '.'<span class="blue"><b>'.$comment['author'].'</b></span>'.' le '.$comment['comment_date_fr'];?>
		</div>
		<div class="col-12 comment">
			<?= $comment['comment']; ?>	
		</div>
	</div>
</div>


<?php
$content = ob_get_clean();
require('template.php');

