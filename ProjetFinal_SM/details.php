<?php
require_once "bdConnect.php";
session_start();
$title=<<<HTML
<title>Details</title>
HTML;

$id = $_GET['id'];

$DetailEvenement = "SELECT * FROM HTDB.evenements inner join HTDB.categories on HTDB.evenements.num_categorie = HTDB.categories.num_categorie  inner join HTDB.representation on HTDB.evenements.num_evenement = HTDB.representation.num_evenement
inner join HTDB.lieux on HTDB.representation.num_lieux = HTDB.lieux.num_lieux where HTDB.evenements.num_evenement = $id";
$result = mysqli_query($conn, $DetailEvenement) or die("Error: " . mysqli_error($conn));

while ($row = mysqli_fetch_array($result)) {
    $nom = $row["nom_evenement"];
    $descriptionEv = $row["description_evenement"];
    $photo = $row["photo"];
    $categorie = $row["description"];
    $date = $row["date"];
    $lieux = $row["nom_lieux"];
    $capacite = $row["capacite"];
    $prix = $row["prix"];
}
$content=<<<HTML
<div id="main" class="alt">

<!-- One -->
<section id="one">
<div class="inner">
<a href="evenement.php"><h1><-Retour</h1></a>
<header class="major">
<h1>$nom</h1>
</header>
<p style= "float: right; margin-right:65%;">Date: $date</p>
<p style= "float: right; margin-right:60%;">Lieu: $lieux</p>
<p style= "float: right; margin-right:60%;">Capacite: $capacite specateurs</p>
<p style= "float: right; margin-right:70%;">Prix: $prix$</p>
<span class="image main" style="width:20%  "><img src="$photo" alt="" /></span>
<p>Categorie: $categorie</p>
<p>Description: $descriptionEv</p>
</div>
</section>

</div>
HTML;

include "master.php";
?>  