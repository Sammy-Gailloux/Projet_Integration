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
        //Carte de credit
        $numCarte = $_POST['numCarte'];
        $CVV = $_POST['cvv'];
        $Exp = $_POST['exp'];

        $ExpirationSeparer = explode("/", $Exp);
        $numCarteSansEspace = str_replace(' ', '', $numCarte);
        $GetCreditCard = "SELECT * from HTDB.carteCredit where num_carte =$numCarteSansEspace";
        $resultatCC = mysqli_query($conn, $GetCreditCard);
        $Cc = mysqli_fetch_assoc($resultatCC);


        $sqlcmd = "SELECT * FROM HTDB.panier inner join HTDB.evenements on HTDB.panier.num_evenement = HTDB.evenements.num_evenement 
        inner join HTDB.sections on HTDB.panier.num_section = HTDB.sections.num_section where num_utilisateur=$loggeduserid";
        $result = mysqli_query($conn, $sqlcmd);
        $followingdata = $result->fetch_assoc();
            $sql = "DELETE FROM HTDB.panier WHERE num_utilisateur=$loggeduserid";
            $soldeDuJoueur = "SELECT * FROM HTDB.utilisateurs WHERE num_utilisateur = $loggeduserid";
            $resultat = mysqli_query($conn, $soldeDuJoueur);
            $value = mysqli_fetch_assoc($resultat);


        if($Cc["num_carte"] == $numCarteSansEspace && $Cc["cvv"] == $CVV && $Cc["mois"] == $ExpirationSeparer[0] && $Cc["annee"] == $ExpirationSeparer[1]){

            if (mysqli_query($conn, $sql)) {
            } else {
                echo "Error: " . $sql . "
            " . mysqli_error($conn);
            }

            $sqlGet = "SELECT num_evenement FROM inventaire_utilisateur WHERE num_evenement=". $followingdata["num_evenement"] . " and num_utilisateur='$loggeduserid' and num_section =". $followingdata["num_section"];
            $result = mysqli_query($conn,$sqlGet);

            if(mysqli_num_rows($result) == 0 && $followingdata["nb_billet"] >= $followingdata["quantite_billet"]){
                $PayerPanier = "Call PayerPanier(" . $followingdata["quantite_billet"] . "," . $followingdata["num_evenement"] . "," . $loggeduserid . ",".$followingdata["num_section"].",". $followingdata["nb_billet"] . ")";


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
                $UpdateQte = "Call PayerPanierSiItemDejaInventaire(" . $followingdata["quantite_billet"] . "," . $followingdata["num_evenement"] . "," . $loggeduserid . ",".$followingdata["num_section"].",". $followingdata["nb_billet"] . ")";
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
            $getMail = "SELECT * from HTDB.utilisateurs WHERE num_utilisateur = $loggeduserid";
            $result = mysqli_query($conn,$getMail);
            $courriel = mysqli_fetch_array($result);

            $msg = "Bonjour {$courriel["nom"]},\n Merci d'avoir commander sur La Billetterie Hard Time Tickets!\n
                    Voici vos achats:\n";
            $msg = wordwrap($msg,70);
            mail($courriel["courriel"],"My subject",$msg);
        }
        else{
            echo "<script type='text/javascript'>alert('Carte De Credit Non Valide');</script>";
        }
    }
        
}

//------------------------------


$sqlcmdSearch ="SELECT * FROM HTDB.panier inner join HTDB.evenements on HTDB.panier.num_evenement = HTDB.evenements.num_evenement 
inner join HTDB.sections on HTDB.panier.num_section = HTDB.sections.num_section where num_utilisateur=$loggeduserid";
$result = mysqli_query($conn,$sqlcmdSearch);

$content=<<<HTML
<!-- Main -->
<div id="main">
					
<!-- About us -->
<section id="test">
<div class="inner">
<div class="flex-child ">
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
HTML;


$sqlcmd = "SELECT * FROM HTDB.utilisateurs WHERE num_utilisateur = $loggeduserid";
$result = mysqli_query($conn, $sqlcmd);
while ($qte = $result->fetch_assoc())
$content .= <<<HTML
</tr>
<tr>
HTML;
$totalCout = number_format($total, 2); 


$SqlPanier = "SELECT * from HTDB.panier where num_utilisateur = $loggeduserid";
$resultSqlPanier = mysqli_query($conn, $SqlPanier);
if(mysqli_num_rows($resultSqlPanier) == 0)
{
$content .= <<<HTML
</tr>
</table>
</div>
</div>

</section>
HTML;
}
else{
$content .= <<<HTML
</tr>
</table>
</div>
</div>
<div class="flex-child allo">
<header style="text-align: center;">
<h1>Payer</h1>    
</header>
<p>Total : $totalCout $</p>
<form action="panier.php?action=pay" method="POST">
<div class="card-header">
<div class="row">
<div class="col-md-6"> <span>Carte de crédit</span> </div>  
<div class="col-md-6 text-right" style="margin-top: -5px;"> <img src="https://img.icons8.com/color/36/000000/visa.png"> <img src="https://img.icons8.com/color/36/000000/mastercard.png"></div>
</div>
</div>
<div class="card-body" style="height: 350px">
<div class="form-group"> <label for="cc-number" class="control-label">Numéro de carte</label> <input name="numCarte" id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" maxlength="19" pattern="[0-9\s]{13,19}" placeholder="•••• •••• •••• ••••" required> </div>
<div class="row">
<div class="col-md-6">
<div class="form-group"> <label for="cc-exp" class="control-label">Expiration</label> <input name="exp" id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" maxlength="5" pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" placeholder="••/••" required> </div>
</div>
<div class="col-md-6">
<div class="form-group"> <label for="cc-cvc" class="control-label">CVV</label> <input name="cvv" id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" maxlength="3" pattern="^\d{1,3}$" placeholder="•••" required> </div>
</div>
<div class="col-md-6">
<div class="form-group"> <label for="code" class="control-label">Coupon Rabais</label> <input id="code" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="••••••"> </div>
</div>
</div>
<div class="form-group"> <input value="Paiement" type="submit" class="btn btn-success btn-lg form-control" style="font-size: .8rem;"> </div>
</div>
</form>     
</div>
</section>  
HTML;
}
include "master.php";
?>