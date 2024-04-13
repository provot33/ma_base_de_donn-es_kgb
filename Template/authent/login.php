<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/style.css" type="text/css">
    <title>Les missions top secretes du KGB</title>
</head>
<?php require_once _TEMPLATEPATH_ . '/header.php'; ?>

<div class="connexion">
<img src="/Assets/images/logo.jpg" />

<?php foreach ($errors as $error) { ?>
    <div class="alert">
        <?= $error; ?>
    </div>
<?php } ?>

<form method="POST">
    <div class="colonne">
        <div class="ligne">
            <label for="email" >Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="ligne">
            <label for="password" >Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>

        <input type="submit" name="loginUser" class="btn ligne" value="Se connecter">
    </div>
</form>
</div>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>