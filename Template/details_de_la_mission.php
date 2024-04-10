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
<?php 
session_start();
//  spl_autoload_extensions(".php"); // comma-separated list
// define('_ROOTPATH_', __DIR__);
 spl_autoload_register();
//  spl_autoload_register(function ($class){
//     require_once __DIR__ . '/../' . strtolower(str_replace('\\', '/', $class) . '.php');
// });
// require __DIR__ . "/App/Repository/mission_repository.php";
// use App\Entity\Mission;
use App\Repository\MissionRepository;

$missionRepository = new MissionRepository();
$missionsArray = $missionRepository->getAll();

echo '<script>';
echo 'const missions = [';
$premierElem = true;
foreach ($missionsArray as $mission){
    if ($premierElem) {
        $premierElem = false;
    } else {
        echo ',';
    }
    echo '{titre: "'.$mission->getTitle().'", description: "'.$mission->getDescription().'",';
    echo ' codeName: "'.$mission->getCodeName().'", startDate: "'.$mission->getStartDate()->format('Y-m-d').'",';
    echo ' finishDate: "'.$mission->getFinishDate()->format('Y-m-d').'", speciality: "'.$mission->getSpeciality()->getLabelOfSpeciality().'",';
    echo ' nationality: "'.$mission->getNationality()->getCountry().'",';
    echo ' missionType: "'.$mission->getMissionType()->getTypeName().'",';
    echo ' missionStatus: "'.$mission->getMissionStatus()->getStatusName().'",';
    echo ' agents: [';
    $premierAgent = true;
    foreach ($mission->getKgbAgents() as $kgbAgent) {
        if ($premierAgent) {
            $premierAgent = false;
        } else {
            echo ',';
        }
        echo '{name : "'.$kgbAgent->getName().'", firstName: "'.$kgbAgent->getFirstName().'",';
        echo ' dateOfBirth: "'.$kgbAgent->getDateOfBirth()->format('Y-m-d').'", ';
        echo ' identificationCode: "'.$kgbAgent->getIdentificationCode().'", ';
        echo ' nationality: "'.$kgbAgent->getNationality()->getCountry().'", ';
        echo ' specialities: [';
        $premiereSpec = true;
        foreach ($kgbAgent->getSpecialities() as $speciality) {
            if ($premiereSpec) {
                $premiereSpec = false;
            } else {
                echo ',';
            }
            echo '{labelOfSpeciality : "'.$speciality->getLabelOfSpeciality().'"}';
        }
        echo ']}';
    }
    echo '], targets:[';
    $premiereCible = true;
    foreach ($mission->getTargets() as $target) {
        if ($premiereCible) {
            $premiereCible = false;
        } else {
            echo ',';
        }
        echo '{name : "'.$target->getName().'", firstName: "'.$target->getFirstName().'",';
        echo ' dateOfBirth: "'.$target->getDateOfBirth()->format('Y-m-d').'", ';
        echo ' codeName: "'.$target->getCodeName().'", ';
        echo ' nationality: "'.$target->getNationality()->getCountry().'"';
        echo '}';
    }
    echo '], contacts: [';
    $premierContact = true;
    foreach ($mission->getContacts() as $contact) {
        if ($premierContact) {
            $premierContact = false;
        } else {
            echo ',';
        }
        echo '{name : "'.$contact->getName().'", firstName: "'.$contact->getFirstName().'",';
        echo ' dateOfBirth: "'.$contact->getDateOfBirth()->format('Y-m-d').'", ';
        echo ' codeName: "'.$contact->getCodeName().'", ';
        echo ' nationality: "'.$contact->getNationality()->getCountry().'"';
        echo '}';
    }
    echo '], hideouts: [';
    $premierePlanque = true;
    foreach ($mission->getHideouts() as $hideout) {
        if ($premierePlanque) {
            $premierePlanque = false;
        } else {
            echo ',';
        }
        echo '{adress : "'.$hideout->getAdress().'", code: "'.$hideout->getCode().'",';
        echo ' city: "'.$hideout->getCity().'", ';
        echo ' nationality: "'.$contact->getNationality()->getCountry().'", ';
        echo ' hideoutType: "'.$hideout->getHideoutType()->getHideoutType().'"';
        echo '}';
    }
    echo ']}';  
}
echo '</script>';
?>
</body>
</html>
