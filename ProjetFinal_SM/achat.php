<?php
require_once "bdConnect.php";
session_start();

//AJOUTER AU PANIER
if (isset($_POST["ajouterPanier"])) {
    $loggeduserid = $_SESSION["userId"];
	$sectionId = $_SESSION["sectionId"];
    $id = $_GET['id'];
	$nbBillet = $_POST['nbBillet'];
    $sql = "SELECT num_evenement FROM HTDB.panier WHERE num_section='$sectionId' and num_utilisateur='$loggeduserid'";
	$result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 0)
	{
		$ajouterpanier = "INSERT INTO HTDB.panier (num_evenement, quantite_billet, num_utilisateur,num_section)
                		VALUES (" . $id. ",".$nbBillet."," . $loggeduserid . ",".$sectionId.")";
		if (mysqli_query($conn, $ajouterpanier)) {
		} else {
			echo "Error: " . $ajouterpanier . "
            " . mysqli_error($conn);
		}
	}
	else
	{
		$UpdateQte = "UPDATE HTDB.panier set quantite_billet = quantite_billet+$nbBillet where num_evenement='$id' and num_utilisateur='$loggeduserid'";
		if (mysqli_query($conn, $UpdateQte)) {
		} else {
			echo "Error: " . $UpdateQte . "
				" . mysqli_error($conn);
		} 
	}

	
	//echo '<script>window.location="achat.php"</script>';

}
// SUPPRIMER DU PANIER
if (isset($_GET["action"])) {
	if ($_GET["action"] == "delete") {
		$sql = "DELETE FROM HTDB.panier WHERE num_section=" . $_GET["id"];
		if (mysqli_query($conn, $sql)) {
		} else {
			echo "Error: " . $sql . "
            " . mysqli_error($conn);
			
		}
	}
	echo '<script>window.location="panier.php"</script>';
}

//MODIFIER QUANTITE DE BILLET PANIER
if (isset($_GET["action"])) {
	$sectionId = $_SESSION["sectionId"];
	$loggeduserid = $_SESSION["userId"];
	if(isset($_POST['submit'])){
		if(!empty($_POST['quantite'])) {
			$selected = $_POST['quantite'];
			if ($_GET["action"] == "modifier") {
				$UpdatePanier = "UPDATE HTDB.panier set quantite_billet = $selected where num_section=$sectionId and num_utilisateur=$loggeduserid";
			if (mysqli_query($conn, $UpdatePanier)) {
			} else {
				echo "Error: " . $UpdatePanier . "
					" . mysqli_error($conn);
			} 
		} else {
			echo 'Please select the value.';
		}
	}
	
    echo '<script>window.location="panier.php"</script>'; 
	}
}

$title=<<<HTML
<title>Achats</title>
HTML;

$id = $_GET['id'];

$DetailEvenement = "SELECT * FROM HTDB.evenements inner join HTDB.categories on HTDB.evenements.num_categorie = HTDB.categories.num_categorie  inner join HTDB.representation on HTDB.evenements.num_evenement = HTDB.representation.num_evenement
inner join HTDB.lieux on HTDB.representation.num_lieux = HTDB.lieux.num_lieux inner join HTDB.sections on HTDB.lieux.num_lieux = HTDB.sections.num_lieux where HTDB.evenements.num_evenement = $id";
$result = mysqli_query($conn, $DetailEvenement) or die("Error: " . mysqli_error($conn));

$rowInfo = mysqli_fetch_array($result);
$num_evenement = $rowInfo["num_evenement"];
$nom = $rowInfo["nom_evenement"];
$descriptionEv = $rowInfo["description_evenement"];
$photo = $rowInfo["photo"];
$prix = $rowInfo["prix"];
$categorie = $rowInfo["description"];
$date = $rowInfo["date"];
$lieux = $rowInfo["nom_lieux"];
$capacite = $rowInfo["capacite"];
$prix = $rowInfo["prix"];
$billetdispo = $rowInfo["nb_billet"];

$content=<<<HTML
<div id="main" class="alt">
<div class="inner">
<section id="test">  
HTML;
$content.=<<<HTML
    
<div class="flex-child ">
<header class="major" style="">
<img src="$photo" style="width:200px;"alt="Image Evenement" />
<p><a href="details.php?id=$num_evenement" class="button small" >Plus d'informations</a></p>
<p style= "">$nom</p>
<p style= "">$date</p>
<p style= "">$lieux</p>
<hr>
</header>
<p style= "">Billets disponibles: $billetdispo billets</p>
</div>

<div class="flex-child allo">
<header style="text-align: center;">
<h1>Billets</h1>    
</header>
HTML;
while ($row = mysqli_fetch_array($result)) {
$nomSection = $row["nom_section"];
$prix_billets = $prix * $row["fm_prix"];
$numSection = $row["num_section"];

$content.=<<<HTML
<a href="achatbillet.php?id=$numSection">
<p style= "">$nomSection</p>
<p style= "">$prix_billets $</p>
</a>
<hr>
HTML;
}   
$content.=<<<HTML
</div>
</section>

</div>
</div>
</div>
HTML;

include "master.php";
?>   