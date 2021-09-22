<?php
echo <<<HTML
<!DOCTYPE HTML>
<html>
	<head>
        $title
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<header id="header" class="alt">
					<a href="index.php" class="logo"><strong>Billetterie</strong> <span>SM</span></a>
					<nav>
						<a href="connexion.php">Connexion</a>
						<a href="#menu">Menu</a>
					</nav>
				</header>

				<!-- Menu -->
				<nav id="menu">
					<ul class="links">
		                <li class="active"> <a href="index.php">Accueil </a> </li>

		                <li> <a href="">Evenement</a> </li>

		                <li> <a href="">Paiement</a> </li>

		                <li><a href="">Nous contacter</a></li>

				        <li><a href="">À Propos</a></li>

            		</ul>
				</nav>

				$content

				<!-- Footer -->
				<footer id="footer">
					<div class="inner">
						<ul class="copyright">
							<li>Copyright © 2021 Billeterie SM - Mickael Bourdelais & Sammy Gailloux</li>
						</ul>
					</div>
				</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
HTML;
?>