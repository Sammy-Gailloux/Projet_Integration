<?php
$title=<<<HTML
<title>Inscription</title>
HTML;

$content=<<<HTML
<div id="main">
<section>
<div class="inner">
<header class="major">
<h2>Inscription</h2>
</header>   
<p>Remplir le formulaire pour vous inscrire</p>
<form action="" method="POST">
<label><b>Nom d'utilisateur</b></label>
<input type="text" placeholder="Entrer le nom d'utilisateur" name="userName" required>

<label><b>Prenom</b></label>
 <input type="text" placeholder="Entrer le prenom " name="firstName" required>

 <label><b>Nom</b></label>
<input type="text" placeholder="Entrer le nom" name="lastname" required>

<label><b>Courriel</b></label>
<input type="text" placeholder="Entrer le courriel" name="email" required>

<label><b>Mot de passe</b></label>
<input type="password" placeholder="Entrer le mot de passe" name="password" required>

<input type="submit" id='submit' value='Inscription' >

</form>
</div>
</section>
</div>
HTML;
	include_once "js/registerFormValidation.js";
	include_once "master.php";
?>