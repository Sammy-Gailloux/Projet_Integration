<?php
ini_set('memory_limit','128M');
require_once "bdConnect.php";

$title=<<<HTML
<title>Evenements</title>
HTML;

//commande pour acceder a la bd

$sqlcmdTout = "SELECT * FROM HTDB.evenements"; 

$result = mysqli_query($conn,$sqlcmdTout);
$content=<<<HTML
<div id="main">
<section id="one">
<div class="inner">
<form method="post">
<label>Recherche</label>
<input style="color:black;background-color:white;margin-bottom:10px;"type="text" name="search">
<input type="submit" name="submit" value="Rechercher">
	
</form>
<header class="major">
<h1>Evenements</h1>
<a href="evenement.php" class="button small next"> <h3>Tous Les Evenements</h3></a>
</header>
</div>
</section>
<section class="tiles">
HTML;
if (isset($_POST["submit"])) {
    $str = $_POST["search"]; 
    $sqlcmdSearch ="SELECT * FROM HTDB.evenements WHERE nom_evenement like '$str'";
    $resultSearch = mysqli_query($conn,$sqlcmdSearch);

    if($row = mysqli_fetch_array($resultSearch)){
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
<a href="details.php?id=$num_evenement" class="button small next">Détails</a>
</div>
</header>
</article>
</section>
</div>  
HTML;
    
    }
    else{
$content.=<<<HTML
<h2 style="float:center">Aucun Resultat</h2>
</div>
HTML;
    }
   
}
else{
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
<a href="details.php?id=$num_evenement" class="button small next">Détails</a>
</div>
</header>
</article>
HTML;
        }
$content.=<<<HTML
</section>
</div>
HTML;
}

	include "master.php";
?>