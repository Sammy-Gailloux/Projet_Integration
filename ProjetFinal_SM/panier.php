<?php
require_once "bdConnect.php";
session_start();
$title=<<<HTML
<title>Panier</title>
HTML;
$total = 0;
$loggeduserid = $_SESSION["userId"];

//PAYER LE PANIER

if (isset($_GET["action"])) {
    if ($_GET["action"] == "pay") {


        $sqlcmd = "SELECT * FROM HTDB.panier inner join HTDB.evenements on HTDB.panier.num_evenement = HTDB.evenements.num_evenement 
        inner join HTDB.sections on HTDB.panier.num_section = HTDB.sections.num_section where num_utilisateur=$loggeduserid";
        $result = mysqli_query($conn, $sqlcmd);
        $followingdata = $result->fetch_assoc();
        $total = 0;
            $total = $total + ($followingdata["quantite_billet"] * $followingdata["prix"] * $followingdata["fm_prix"]);
            $sql = "DELETE FROM HTDB.panier WHERE num_utilisateur=$loggeduserid";
            $soldeDuJoueur = "SELECT * FROM HTDB.utilisateurs WHERE num_utilisateur = $loggeduserid";
            $resultat = mysqli_query($conn, $soldeDuJoueur);
            $value = mysqli_fetch_assoc($resultat);

            if ($value["montant"] >= $total ) {
                if (mysqli_query($conn, $sql)) {
                } else {
                    echo "Error: " . $sql . "
                " . mysqli_error($conn);
                }
                $sqlGet = "SELECT num_evenement FROM inventaire_utilisateur WHERE num_evenement=". $followingdata["num_evenement"] . " and num_utilisateur='$loggeduserid' and num_section =". $followingdata["num_section"];
	            $result = mysqli_query($conn,$sqlGet);

	            if(mysqli_num_rows($result) == 0 && $followingdata["nb_billet"] >= $followingdata["quantite_billet"]){
                $PayerPanier = "Call PayerPanier(" . $followingdata["quantite_billet"] . "," . $followingdata["num_evenement"] . "," . $loggeduserid . ",".$followingdata["num_section"].",". $followingdata["nb_billet"] . ",".$total.")";


                if (mysqli_query($conn, $PayerPanier)) {
                } else {
                    echo "Error: " . $PayerPanier . "
                " . mysqli_error($conn);
                }

                $UpdateQtestockPayer = "UPDATE HTDB.evenements set nb_billet = ". $followingdata["nb_billet"] . " - ".$followingdata["quantite_billet"]." where num_evenement =". $followingdata["num_evenement"];
                    
                    if (mysqli_query($conn, $UpdateQtestockPayer)) {
		            } else {
			            echo "Error: " . $UpdateQtestockPayer . "
				        " . mysqli_error($conn);
		            } 
                }
                else{
                    $UpdateQte = "Call PayerPanierSiItemDejaInventaire(" . $followingdata["quantite_billet"] . "," . $followingdata["num_evenement"] . "," . $loggeduserid . ",".$followingdata["num_section"].",". $followingdata["nb_billet"] . ",".$total.")";
		            if (mysqli_query($conn, $UpdateQte)) {
		            } else {
			            echo "Error: " . $UpdateQte . "
				        " . mysqli_error($conn);
		            } 

                    $UpdateQtestock = "UPDATE HTDB.evenements set nb_billet = ". $followingdata["nb_billet"] . " - ".$followingdata["quantite_billet"]." where num_evenement =". $followingdata["num_evenement"];
                    
                    if (mysqli_query($conn, $UpdateQtestock)) {
		            } else {
			            echo "Error: " . $UpdateQtestock . "
				        " . mysqli_error($conn);
		            } 

                }

            } else {
                echo 'Pas assez dargent';
                echo '<script>window.location="panier.php"</script>';
            }
    }
    echo '<script>window.location="panier.php"</script>';
}

//------------------------------


$sqlcmdSearch ="SELECT * FROM HTDB.panier inner join HTDB.evenements on HTDB.panier.num_evenement = HTDB.evenements.num_evenement 
inner join HTDB.sections on HTDB.panier.num_section = HTDB.sections.num_section where num_utilisateur=$loggeduserid";
$result = mysqli_query($conn,$sqlcmdSearch);

$content=<<<HTML
<!-- Main -->
<div id="main">
					
					
<!-- About us -->
<section>
<div class="inner">
<header class="major">
<h2>Panier</h2>
</header>
<p>Votre panier d'achat</p>
<table class="table table-bordered">
<tr>
<th width="10%"></th>
<th width="30%">Evenement</th>
<th width="15%">Section</th>
<th width="10%">Quantite de billet</th>
<th width="13%">Prix d'un billet</th>
<th width="10%">Prix total</th>
<th width="17%">Supprimer le billet</th>
</tr>
HTML;
while ($row = mysqli_fetch_array($result)) {
    $test = $row['num_section'];
    $img = $row["photo"];
    
$content .= <<<HTML
<tr>
<td>
<img src="$img" style="width:200px;height:200px;border-radius:3px;"/>
</td>
<td>
HTML;
$content .= $row["nom_evenement"]; 
    
$content .= <<<HTML
</td>
<td>
HTML;
$content .= $row["nom_section"]; 
$content .= <<<HTML
</td>
<td>
HTML;
    
    
    $qteStock = $row["nb_billet"];
    $qteAchat = $row["quantite_billet"];
    
$content .= <<<HTML
<form action="achat.php?action=modifier&id=$test" method="post">
<select name="quantite" >
<option> Quantite: $qteAchat</option>
<option> -- Modifier --</option>
HTML;
    $cmpt = 0;
    while ($cmpt < $qteStock) {
        $cmpt++;
$content .= <<<HTML
<option value="$cmpt">$cmpt</option>
HTML;
    }

$content .= <<<HTML
</select>
<input type="submit" name="submit" value="Modifier Quantite">
</form>
</td>
<td>$ 
HTML;

$content .= $row["prix"] * $row["fm_prix"]; 
$content .= <<<HTML
</td>
<td>
$ 
HTML;
    
$content .= number_format($row["quantite_billet"] * $row["prix"] *$row["fm_prix"], 2); 
$content .= <<<HTML
</td>
<td>
HTML;
    
$content .= <<<HTML
<a href="achat.php?action=delete&id=$test">
<span class="text-danger">Supprimer</span>
</a>
</td>
HTML;
    
$content .= <<<HTML
</tr>
HTML;

    $total = $total + ($row["quantite_billet"] * $row["prix"]*$row["fm_prix"]);
}
if(isset($_POST['submit'])){
    if(!empty($_POST['quantite'])) {
        $selected = $_POST['quantite'];
        $_SESSION["qte"]=$selected;
        echo $selected;
    } else {
        echo 'Please select the value.';
    }
    }

$content .= <<<HTML
<tr>
<td colspan="3" align="right">Votre Solde</td>
<th align="right">$ 
HTML;


$sqlcmd = "SELECT * FROM HTDB.utilisateurs WHERE num_utilisateur = $loggeduserid";
$result = mysqli_query($conn, $sqlcmd);
while ($qte = $result->fetch_assoc())
$content .= $qte["montant"]; 
$content .= <<<HTML
</tr>
<tr>
<td colspan="3" align="right">Total</td>
<th align="right">$ 
HTML;

$content .= number_format($total, 2); 

$SqlPanier = "SELECT * from HTDB.panier where num_utilisateur = $loggeduserid";
$resultSqlPanier = mysqli_query($conn, $SqlPanier);
if(mysqli_num_rows($resultSqlPanier) == 0)
{
$content .= <<<HTML
</tr>
</table>
</div>
</section>
HTML;
}
else{
$content .= <<<HTML
<a href="panier.php?action=pay">Payer</a></th>
</tr>
</table>
</div>
</section>
HTML;
}

include "master.php";
?>