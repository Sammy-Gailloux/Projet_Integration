<?php
session_start();

$title=<<<HTML
<title>Accueil</title>
HTML;

$content=<<<HTML
<section id="banner" class="major">
<div class="inner">
<header class="major">
<h1>L'achat de billet simplifié</h1>
</header>
<div class="content">
<p>Vous avez des questions pour nous?</p>
<ul class="actions">
<li><a href="contact.html" class="button next scrolly">Contacter nous</a></li>
</ul>
</div>
</div>
</section>

<!-- Main -->
<div id="main">
					
					
<!-- About us -->
<section>
<div class="inner">
<header class="major">
<h2>À Propos De Nous</h2>
</header>
<p>Billetterie HTT est un site web ...</p>
<ul class="actions">
<li><a href="about-us.html" class="button next">En apprendre plus</a></li>
</ul>
</div>
</section>
					
<!-- Featured Products -->
<div class="inner">
<header class="major">
<h2>Événements populaires</h2>
<h3>À Venir</h3>
</header>
</div>
HTML;
	include "master.php";
?>