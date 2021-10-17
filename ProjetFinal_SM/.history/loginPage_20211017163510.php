<?php
$title=<<<HTML
<title>Connexion</title>
HTML;

$content=<<<HTML
<div id="main">
<section>
<div class="inner">
<header class="major">
<h2>Connexion</h2>
</header>   
<p>Remplir le formulaire pour vous connecter</p>
<form action="php/login.php" method="POST">
<label><b>Nom d'utilisateur</b></label>
<input type="text" placeholder="Entrer le nom d'utilisateur" name="alias" required>


<label><b>Mot de passe</b></label>
<input type="password" placeholder="Entrer le mot de passe" name="password" required>
<br>
<input type="submit" id='submit' name="submit" value='Connexion' >

<p>Aucun compte? <a href="registerPage.php">Inscrivez-vous</a>.</p>
</form>
</div>
</section>  
</div>
HTML;
	include_once "master.php";
?>