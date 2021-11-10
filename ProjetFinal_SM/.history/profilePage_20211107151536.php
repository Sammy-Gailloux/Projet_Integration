<?php
$title = <<<HTML
<title>Profile</title>
HTML;

$content = <<<HTML
<div id="main">
<section>
<div class="inner">
<header class="major">
<h2>Profile</h2>
</header>   
<p>Modifier vos informations</p>
<form action="php/profile.php" method="POST">
<label><b>Nom</b></label>
<input type="text" placeholder="Nouveau nom" name="lastName" required>
<br>

<label><b>Prenom</b></label>
<input type="text" placeholder="Nouveau prenom" name="firstName" required>
<br>

<label><b>Alias d'utilisateur</b></label>
<input type="text" placeholder="Nouvel alias" name="userName" required>
<br>

<label><b>Courriel</b></label>
<input type="text" placeholder="Nouveau courriel" name="email" required>
<br>


<label><b>Mot de passe</b></label>
<input type="password" placeholder="Entrer le mot de passe" name="password" required>
<br>
<input type="submit" id='submit' name="submit" value='Modifier'>
</form>
</div>
</section>  
</div>
HTML;
include_once "master.php";