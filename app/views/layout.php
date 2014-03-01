<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Literate PHP</title>
		<link href='//fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
		<link href="/css/style.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="container">
			<header>
				<h1><a href="/">Literate PHP</a></h1>
				<nav>
					<ul>
						<?php foreach($litPaths as $path) : ?>
							<li <?= $path['active'] ? 'class="active"' : null ?>><a href="<?= $path['path'] ?>"><?= $path['path'] ?></a></li>
						<?php endforeach ?>
					</ul>
				</nav>
			</header>
			<div class="content">
				<?= md($contents) ?>
			</div>
			<footer>
				<p>Powered by <a href="https://github.com/rtablada/literate-php-blog">Literate PHP</a></p>
			</footer>
		</div>
	</body>
</html>
