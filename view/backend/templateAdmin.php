<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/styles.css">
	</head>
	<body>
		<?= $content ?>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=7kcf4dx0hhm2as5zjm8cpjalfa5bj2ngf3whr5y47zogdi00"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</body>
</html>