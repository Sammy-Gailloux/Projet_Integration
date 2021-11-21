<?php
require_once "bdConnect.php";
session_start();

$logged = function ($num){
	if(isset($_SESSION["userId"])){
		return 
		"<a href='details.php?id=$num' class='button small next'>Détails</a>
        <a href='achat.php?id=$num' class='button small next'>Acheter</a>";
	}
	else{
		return
		"<a href='details.php?id=$num' class='button small next'>Détails</a>";
	}
};
$title=<<<HTML
<title>Accueil</title>
HTML;
$sqlcmdTout = "SELECT * FROM HTDB.evenements where num_evenement <8"; 

$result = mysqli_query($conn,$sqlcmdTout);

$content=<<<HTML
<section id="banner" class="major">
<div class="inner">
<header class="major">
<h1>L'achat de billet simplifié</h1>
</header>
</div>
</section>

<!-- Main -->
<div id="main">
<!-- Featured Products -->
<section class="tiles">
<div class="inner">
<header class="major">
<h2>Événements populaires</h2>
<a href="evenement.php" class="button small"> <h3>Tous les evenements</h3></a>
</header>
</div>
HTML;
while($row = mysqli_fetch_array($result)) { 
        $num_evenement = $row["num_evenement"];
        $nom = $row["nom_evenement"];	
        $photo = $row["photo"];
        $prix = $row["prix"];
$content.=<<<HTML
<article>
<span class="image">
<img src=$photo alt="" />
</span>
<header class="major">
<h3>$nom</h3>
<p><strong>$prix $</strong></p>
<div class="major-actions">
{$logged($num_evenement)}
</div>
</header>
</article>
HTML;
        }

//About us 
$content.=<<<HTML
</section>
<section>
<div class="inner">
<header class="major">
<h2>À propos de nous</h2>
</header>
<ul class="actions">
<li><a href="about-us.html" class="button next">En apprendre plus</a></li>
</ul>
</div>
</section>
					

HTML;
	include "master.php";
?>