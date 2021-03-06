<?php

	$title = 'Mon blog'; ?>

	<?php ob_start(); ?>
		<h1 class="text-center mt-12 mb-4 blue"> <i class="fas fa-plane blue"></i> Billet simple pour l'Alaska</h1>
		
		<?php
		while ($data = $posts->fetch())
		{
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 articles">
					<p>
						<h3 class="blue"><?= strip_tags($data['excerpt']); ?></h3>
						<a href="index.php?action=post&id=<?=$data['id']?>">[...] Lire la suite</a>
					</p>
					<span>
						<?= 'Le '. htmlspecialchars($data['creation_date']) ?>	
					</span>
					<span>
						<a href="index.php?action=post&id=<?=$data['id']?>" class="comments"><i class="fas fa-comments fa-1_5x blue"></i>
					<?php
					 $comments = $commentManager->countComments($data['id']);
					 $numberOfComments = $comments['COUNT'];
					 echo $numberOfComments;
					 ?>	
					</a>
					 </span>
				</div>
			</div>
		</div>
		
		<?php 
		} // end of the while loop
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Pages
						<?php
						for ($i=1; $i <= $nombreDePages; $i++) { 
							if($i == $pageCourante)
							{
								echo $i;
							}
							else
							{
								?>
							<a href="index.php?action=listPosts&page=<?= $i ?>"><?= $i ?></a>
							<?php
							}
						}
						$posts->closeCursor(); // end of the query
						?>
					</p>
				</div>
			</div>
		</div>
	<br>
	<?php
	$content = ob_get_clean(); // content of the view
	require('template.php'); // call the template 