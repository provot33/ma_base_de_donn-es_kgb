<head>
    <link rel="stylesheet" href="/Assets/css/style.css">
</head>
<?php require_once _TEMPLATEPATH_ . '/header.php';?>
<?php 
if (isset($_SESSION['user'])){
    echo '<a href="./?controller=authent&action=logout" class="logout button">Déconnexion</a>';
}
?>
<h1>Liste des Missions</h1>
<!-- <div><a class="prev" onclick="plusMissions(-1)">&#10094;</a></div> -->
<?php
// echo '<div><select name="mission-list" id="mission-select" onchange="afficheMissionCombo()">';
// $selected=true;
// $index =0;
// foreach ($missions as $mission) {
//     echo '<option value="'.$index.'"';
//     // if ($selected) {
//     //     echo ' selected';
//     //     $selected = false;
//     // }
//     echo '>'.$mission->getTitle().'</option>';
//     $index++;
// }
// echo '</select></div>';

echo '<div><table id="missions-list">';
echo '<thead><tr>';
echo' <th></th><th>Titre de la mission</th><th>Date début</th><th>Date fin</th><th>Localisation</th><th>Statut</th>';
echo '</tr></thead>';

$index=0;
foreach ($missions as $mission) {
    echo '<tr>';
    // echo '<td><label onClick="afficheMission('.$index.')">Lien</label></td>';
    echo '<td><a href="./?controller=mission&action=detail&mission='.$mission->getId().'">Detail</td>';
    echo '<td>'.$mission->getTitle().'</td>';
    echo '<td>'.$mission->getStartDate()->format('Y-m-d').'</td>';
    echo '<td>'.$mission->getFinishDate()->format('Y-m-d').'</td>';
    echo '<td>'.$mission->getNationality()->getCountry().'</td>';
    echo '<td>'.$mission->getMissionStatus()->getStatusName().'</td>';
    echo '</tr>';
    $index++;
}
echo '</table></div>';

?>

<!-- <div class="slideshow-container">
    <div id="liste_mission"></div> 
</div> -->
<!-- <div><a class="next" onclick="plusMissions(1)">&#10095;</a></div> -->


<?php require_once _TEMPLATEPATH_ . '/footer.php';

// echo '<script>';
// echo 'const missions = [';
// $premierElem = true;
// foreach ($missions as $mission) {    
//     if ($premierElem) {
//         $premierElem = false;
//     } else {
//         echo ',';
//     }
//     echo '{titre: "' . $mission->getTitle() . '", description: "' . $mission->getDescription() . '",';
//     echo ' codeName: "' . $mission->getCodeName() . '", startDate: "' . $mission->getStartDate()->format('Y-m-d') . '",';
//     echo ' finishDate: "' . $mission->getFinishDate()->format('Y-m-d') . '", speciality: "' . $mission->getSpeciality()->getLabelOfSpeciality() . '",';
//     echo ' nationality: "' . $mission->getNationality()->getCountry() . '",';
//     echo ' missionType: "' . $mission->getMissionType()->getTypeName() . '",';
//     echo ' missionStatus: "' . $mission->getMissionStatus()->getStatusName() . '",';
//     echo ' agents: [';
//     $premierAgent = true;
//     foreach ($mission->getKgbAgents() as $kgbAgent) {
//         if ($premierAgent) {
//             $premierAgent = false;
//         } else {
//             echo ',';
//         }
//         echo '{name : "' . $kgbAgent->getName() . '", firstName: "' . $kgbAgent->getFirstName() . '",';
//         echo ' dateOfBirth: "' . $kgbAgent->getDateOfBirth()->format('Y-m-d') . '", ';
//         echo ' identificationCode: "' . $kgbAgent->getIdentificationCode() . '", ';
//         echo ' nationality: "' . $kgbAgent->getNationality()->getCountry() . '", ';
//         echo ' specialities: [';
//         $premiereSpec = true;
//         foreach ($kgbAgent->getSpecialities() as $speciality) {
//             if ($premiereSpec) {
//                 $premiereSpec = false;
//             } else {
//                 echo ',';
//             }
//             echo '{labelOfSpeciality : "' . $speciality->getLabelOfSpeciality() . '"}';
//         }
//         echo ']}';
//     }
//     echo '], targets:[';
//     $premiereCible = true;
//     foreach ($mission->getTargets() as $target) {
//         if ($premiereCible) {
//             $premiereCible = false;
//         } else {
//             echo ',';
//         }
//         echo '{name : "' . $target->getName() . '", firstName: "' . $target->getFirstName() . '",';
//         echo ' dateOfBirth: "' . $target->getDateOfBirth()->format('Y-m-d') . '", ';
//         echo ' codeName: "' . $target->getCodeName() . '", ';
//         echo ' nationality: "' . $target->getNationality()->getCountry() . '"';
//         echo '}';
//     }
//     echo '], contacts: [';
//     $premierContact = true;
//     foreach ($mission->getContacts() as $contact) {
//         if ($premierContact) {
//             $premierContact = false;
//         } else {
//             echo ',';
//         }
//         echo '{name : "' . $contact->getName() . '", firstName: "' . $contact->getFirstName() . '",';
//         echo ' dateOfBirth: "' . $contact->getDateOfBirth()->format('Y-m-d') . '", ';
//         echo ' codeName: "' . $contact->getCodeName() . '", ';
//         echo ' nationality: "' . $contact->getNationality()->getCountry() . '"';
//         echo '}';
//     }
//     echo '], hideouts: [';
//     $premierePlanque = true;
//     foreach ($mission->getHideouts() as $hideout) {
//         if ($premierePlanque) {
//             $premierePlanque = false;
//         } else {
//             echo ',';
//         }
//         echo '{adress : "' . $hideout->getAdress() . '", code: "' . $hideout->getCode() . '",';
//         echo ' city: "' . $hideout->getCity() . '", ';
//         echo ' nationality: "' . $contact->getNationality()->getCountry() . '", ';
//         echo ' hideoutType: "' . $hideout->getHideoutType()->getHideoutType() . '"';
//         echo '}';
//     }
//     echo ']}';
// }
// echo '];</script>';
echo '<script src="/Assets/js/missions.js"></script>';
?>