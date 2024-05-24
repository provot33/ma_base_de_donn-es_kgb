<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/style.css" type="text/css">
    <title>Les missions top secretes du KGB</title>
</head>

<body>
    <img class="logo_center" src="/Assets/images/logo.jpg" />
    <h1>Les missions top secrètes du KGB</h1>
    <div class="connexion" style="display:flex; flex-direction: row; justify-content: space-evenly;">
        <div class="connexion" style="flex-direction: column;">
        <a href="./?controller=mission&action=list"><img class="image_button" src="/Assets/images/dossier-secret.jpg" /></a>
        <br />
        <a href="./?controller=mission&action=list" class="button">Liste des missions</a>
        </div>

        <div class="connexion" style="flex-direction: column;">
        <a href="./?controller=authent&action=login"><img class="image_button" src="/Assets/images/officier.jpg" /></a>
        <br />
        <a href="./?controller=authent&action=login" class="button">Administrer le site</a>
        </div>
    </div>
</body>
</html>