<?php
require_once "bdConnect.php";
session_start();
$loggeduserid = $_SESSION["userId"];
$title=<<<HTML
<title>Inventaire</title>
HTML;
$content=<<<HTML
<!-- Main -->
<div id="main">
<!-- About us -->
<section>
<div class="inner">
<header class="major">
<h2>Inventaire</h2>
</header>
<p>Votre inventaire :</p>
<table class="table table-bordered">
<tr>
<th width="10%"></th>
<th width="30%">Evenement</th>
<th width="10%">Section</th>
<th width="10%">Nombre de billets</th>
</tr>
HTML;
$InventaireJoueur = "CALL AfficherInventaireJoueur($loggeduserid)"; 
$result = mysqli_query($conn,$InventaireJoueur);
while($row = mysqli_fetch_array($result)) {
    $Image = $row["photo"];
    $NumItem = $row["num_evenement"];
    $Nom = $row["nom_evenement"];
    $Qte = $row["nb_billet_inventaire"];
    $section = $row["nom_section"];
    
$content.=<<<HTML
<tr>
<td><img src="$Image" style="width:100px"/></td>
<td width="30%">$Nom</td>
<td width="30%">$section</td>
<td width="10%">$Qte</td>
</tr>
HTML;
    }
$content.=<<<HTML
</tr>
</table>
</div>
</section>
HTML;
include "master.php";
?>