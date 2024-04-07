<!DOCTYPE html>
<?php
// session_set_cookie_params([
//     'lifetime' => 3600,
//     'path' => '/',
//     'domain' => $_SERVER['SERVER_NAME'],
//     'httponly' => true
// ]);
// session_start();
define('_ROOTPATH_', __DIR__);

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Les missions top secretes du KGB</title>
</head>
<script src="script.js"></script>
<body>
    <h1>Les missions top secrétes du KGB</h1>
<?php 
//  spl_autoload_extensions(".php"); // comma-separated list
 spl_autoload_register();
 spl_autoload_register(function ($class){
    require_once __DIR__ . '/' . strtolower(str_replace('\\', '/', $class) . '.php');
});
// require __DIR__ . "/App/Repository/mission_repository.php";
// use App\Entity\Mission;
use App\Repository\MissionRepository;

$missionRepository = new MissionRepository();
$missionsArray = $missionRepository->getAll();
/**
echo '<script>';
    echo 'const vehicules = [';
    $premierElem = true;
    // On récupère les véhicules présents dans la table et on alimente le javascript pour permettre de filtrer
    foreach ($pdo->query('SELECT * FROM VEHICULE', PDO::FETCH_ASSOC) as $vehicule) {
        if ($premierElem) {
            $premierElem = false;
        } else {
            echo ',';
        }
        echo '{marque: "'.$vehicule['MARQUE'].'", modele: "'.$vehicule['MODELE'].'",';
        echo ' urlMiniature: "'.$vehicule['URLMINIATURE'].'", kilometrage: "'.$vehicule['KILOMETRAGE'].'",';
        echo ' motorisation: "'.$vehicule['MOTORISATION'].'", prix: "'.$vehicule['PRIX'].'",';
        echo ' nbPortes: "'.$vehicule['NOMBRE_DE_PORTES'].'",';
        echo ' miseEnAvant1: "'.str_replace("\"", "\\\"", $vehicule['MISE_EN_AVANT1']).'",';
        echo ' miseEnAvant2: "'.str_replace("\"", "\\\"", $vehicule['MISE_EN_AVANT2']).'",';
        echo ' miseEnAvant3: "'.str_replace("\"", "\\\"", $vehicule['MISE_EN_AVANT3']).'",';
        echo ' miseEnAvant4: "'.str_replace("\"", "\\\"", $vehicule['MISE_EN_AVANT4']).'",';
        echo ' miseEnAvant5: "'.str_replace("\"", "\\\"", $vehicule['MISE_EN_AVANT5']).'",';
        echo 'annee: "'.$vehicule['ANNEE'].'", identifiant: "'.$vehicule['IDENTIFIANT'].'"}';
    }
    echo '];';
    echo '</script>';
 */
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