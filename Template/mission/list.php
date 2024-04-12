<head>
    <link rel="stylesheet" href="/Assets/css/site.css">
</head>
<?php require_once _TEMPLATEPATH_ . '/header.php';?>
<h1>Liste des Missions</h1>

<div class="slideshow-container">
<div><a class="prev" onclick="plusMissions(-1)">&#10094;</a></div>
    <div id="liste_mission"></div> 
<div><a class="next" onclick="plusMissions(1)">&#10095;</a></div>
</div>

<?php require_once _TEMPLATEPATH_ . '/footer.php';

use App\Repository\MissionRepository;

$missionRepository = new MissionRepository();
$missionsArray = $missionRepository->getAll();

echo '<script>';
echo 'const missions = [';
$premierElem = true;
foreach ($missionsArray as $mission) {
    if ($premierElem) {
        $premierElem = false;
    } else {
        echo ',';
    }
    echo '{titre: "' . $mission->getTitle() . '", description: "' . $mission->getDescription() . '",';
    echo ' codeName: "' . $mission->getCodeName() . '", startDate: "' . $mission->getStartDate()->format('Y-m-d') . '",';
    echo ' finishDate: "' . $mission->getFinishDate()->format('Y-m-d') . '", speciality: "' . $mission->getSpeciality()->getLabelOfSpeciality() . '",';
    echo ' nationality: "' . $mission->getNationality()->getCountry() . '",';
    echo ' missionType: "' . $mission->getMissionType()->getTypeName() . '",';
    echo ' missionStatus: "' . $mission->getMissionStatus()->getStatusName() . '",';
    echo ' agents: [';
    $premierAgent = true;
    foreach ($mission->getKgbAgents() as $kgbAgent) {
        if ($premierAgent) {
            $premierAgent = false;
        } else {
            echo ',';
        }
        echo '{name : "' . $kgbAgent->getName() . '", firstName: "' . $kgbAgent->getFirstName() . '",';
        echo ' dateOfBirth: "' . $kgbAgent->getDateOfBirth()->format('Y-m-d') . '", ';
        echo ' identificationCode: "' . $kgbAgent->getIdentificationCode() . '", ';
        echo ' nationality: "' . $kgbAgent->getNationality()->getCountry() . '", ';
        echo ' specialities: [';
        $premiereSpec = true;
        foreach ($kgbAgent->getSpecialities() as $speciality) {
            if ($premiereSpec) {
                $premiereSpec = false;
            } else {
                echo ',';
            }
            echo '{labelOfSpeciality : "' . $speciality->getLabelOfSpeciality() . '"}';
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
        echo '{name : "' . $target->getName() . '", firstName: "' . $target->getFirstName() . '",';
        echo ' dateOfBirth: "' . $target->getDateOfBirth()->format('Y-m-d') . '", ';
        echo ' codeName: "' . $target->getCodeName() . '", ';
        echo ' nationality: "' . $target->getNationality()->getCountry() . '"';
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
        echo '{name : "' . $contact->getName() . '", firstName: "' . $contact->getFirstName() . '",';
        echo ' dateOfBirth: "' . $contact->getDateOfBirth()->format('Y-m-d') . '", ';
        echo ' codeName: "' . $contact->getCodeName() . '", ';
        echo ' nationality: "' . $contact->getNationality()->getCountry() . '"';
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
        echo '{adress : "' . $hideout->getAdress() . '", code: "' . $hideout->getCode() . '",';
        echo ' city: "' . $hideout->getCity() . '", ';
        echo ' nationality: "' . $contact->getNationality()->getCountry() . '", ';
        echo ' hideoutType: "' . $hideout->getHideoutType()->getHideoutType() . '"';
        echo '}';
    }
    echo ']}';
}
echo '];</script>';
echo '<script src="/Assets/js/missions.js"></script>';
?>