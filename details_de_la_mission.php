<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Le Détail des missions</title>
</head>
<body>
    <main>
    <h1>Détails de la mission</h1>
    <form method="post" id="formulaire"></form>
    <fieldset id="infos">
        <legend> <h2>Informations</h2></legend>
         <div id="nm">
          <label for="Nom">Nom:</label>
          <input type="text" placeholder="Parker">
         </div>
         <div id="fnm">
          <l abel="" for="">Prénom:
          <input type="text" placeholder="Peter">
         </l></div>
         <div>
          <label for="Statut">Statut</label>
         </div>
         <div>
          <input type="radio" name="Statut" id="particulier" required="" checked="">
          <label for="particulier">Particulier</label>
         </div>
         <div>
            <input type="radio" name="Statut" id="Professionnel" required="">
            <label for="Professionnel">Professionnel</label>
         </div>
    </fieldset>
    <fieldset>
        <legend> <h2>Message</h2></legend>
         <div>
          <label for="objet">Objet</label>
          <select type="text" name="objet" id="objet" required="">
                <option value="demande_de_contat">Demande de contact</option>
                <option value="offre_d'emploi">Offre d'emploi</option>
                <option value="envoi_d'une_brochure_tarifaire">Envoi d'une brochure tarifaire</option>
          </select>
         </div>
         <div> 
         <label for="email">Email</label>
         <input type="email" name="email" placeholder="email@.fr" required="">
            </div>
            <div>
        <textarea name="objet" id="messageArea" cols="30" rows="10"></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </fieldset>
</main>
<footer></footer>

</body>
</html>