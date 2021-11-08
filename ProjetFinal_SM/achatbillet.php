<?php
require_once "bdConnect.php";

session_start();

$title=<<<HTML
<title>Achats</title>
HTML;

$id = $_GET['id'];

$sectionDetail = "SELECT * FROM HTDB.sections inner join HTDB.lieux on HTDB.sections.num_lieux = HTDB.lieux.num_lieux inner join HTDB.representation on HTDB.lieux.num_lieux = HTDB.representation.num_lieux
inner join HTDB.evenements on HTDB.representation.num_evenement = HTDB.evenements.num_evenement where HTDB.sections.num_section = $id";
$result = mysqli_query($conn, $sectionDetail) or die("Error: " . mysqli_error($conn));
$row = mysqli_fetch_array($result);

$num_Evenement = $row["num_evenement"];
$nbBillet = $row["nb_billet"];
$_SESSION["sectionId"] = $id;
$NomSection = $row["nom_section"];
$Prix = $row["prix"] * $row["fm_prix"];
$content=<<<HTML
<div id="main" class="alt">
<div class="inner">
<section id="test">  
<div id="yo">
<header class="major" style="">
</header>
<p>$NomSection</p>
<p>$Prix $ par billet</p>

<form action="achat.php?action=ajouterPanier&id=$num_Evenement" method="post">
<input type="number" style="color:black;" name="nbBillet" value="1" min="1" max="$nbBillet" >
<p>$nbBillet billets disponibles</p>
<input type="submit" name="ajouterPanier" value="Ajouter au panier">
</form>
</div>
</section>
</div>
</div>
HTML;

include "master.php";
?>   