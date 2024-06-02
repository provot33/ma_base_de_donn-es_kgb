<head>
    <link rel="stylesheet" href="/Assets/css/style.css">
</head>
<?php require_once _TEMPLATEPATH_ . '/header.php';?>
<?php

function alimenteComboNationality($nationalities, $valeur, $tableau): string
{
    $comboNationalite = '<select id="' . $tableau . '-nationality-select" disabled="">';
    foreach ($nationalities as $nationality) {
        $comboNationalite = $comboNationalite.'<option value="' . $nationality->getIdNationality() . '"';
        $comboNationalite = $comboNationalite.($nationality->getIdNationality() == $valeur ? ' selected' : '');
        $comboNationalite = $comboNationalite.'>' . $nationality->getCountry() . '</option>';
    }

    $comboNationalite = $comboNationalite.'</select>';

    return $comboNationalite;
}

function alimenteComboHideoutTypes($hideoutTypes, $valeur, $tableau): string
{
    $comboHideoutType = '<select id="' . $tableau . '-hideouttype-select" disabled="">';
    foreach ($hideoutTypes as $hideoutType) {
        $comboHideoutType = $comboHideoutType.'<option value="' . $hideoutType->getIdHideoutType() . '"';
        $comboHideoutType = $comboHideoutType.($hideoutType->getIdHideoutType() == $valeur ? ' selected' : '');
        $comboHideoutType = $comboHideoutType.'>' . $hideoutType->getHideoutType() . '</option>';
    }

    $comboHideoutType = $comboHideoutType.'</select>';

    return $comboHideoutType;
}

if (isset($_SESSION['user'])) {
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
echo ' <th></th><th>Titre de la mission</th><th>Date début</th><th>Date fin</th><th>Localisation</th><th>Statut</th>';
echo '</tr></thead>';

$index = 0;
foreach ($missions as $mission) {
    echo '<tr>';
    if (isset($_SESSION['user'])) {
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $mission->getId() . '">Modifier</td>';
    } else {
        echo '<td><a href="./?controller=mission&action=detail&mission=' . $mission->getId() . '">Detail</td>';
    }
    echo '<td>' . $mission->getTitle() . '</td>';
    echo '<td>' . $mission->getStartDate()->format('Y-m-d') . '</td>';
    echo '<td>' . $mission->getFinishDate()->format('Y-m-d') . '</td>';
    echo '<td>' . $mission->getNationality()->getCountry() . '</td>';
    echo '<td>' . $mission->getMissionStatus()->getStatusName() . '</td>';
    echo '</tr>';
    $index++;
}
echo '</table></div>';
/*
'specialities' => $specialities,
'missionTypes' => $missionTypes,
'missionStatus' => $missionStatus,
'hideoutTypes' => $hideoutTypes,
'nationalities' => $nationalities,

'kgbAgents' => $kgbAgents,
'contacts' => $contacts,
'hideouts' => $hideouts,
'targets' => $targets,
 */
if (isset($_SESSION['user'])) {
    echo '<h1>Gestion des données</h1>';

    echo '<h2>Types de missions</h2>';
    echo '<div><table id="missions-types-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Libéllé type de mission</th>';
    echo '</tr></thead>';
    foreach ($missionTypes as $missionType) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $missionType->getIdType() . '">Modifier</td>';
        echo '<td>' . $missionType->getIdType() . '</td>';
        echo '<td>' . $missionType->getTypeName() . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Statuts de missions</h2>';
    echo '<div><table id="missions-status-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Libéllé statut de mission</th>';
    echo '</tr></thead>';
    foreach ($missionStatus as $missionStatu) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $missionStatu->getIdStatus() . '">Modifier</td>';
        echo '<td>' . $missionStatu->getIdStatus() . '</td>';
        echo '<td>' . $missionStatu->getStatusName() . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Spécialités possibles</h2>';
    echo '<div><table id="specialities-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Libellé spécialité</th>';
    echo '</tr></thead>';
    foreach ($specialities as $speciality) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $speciality->getIdSpeciality() . '">Modifier</td>';
        echo '<td>' . $speciality->getIdSpeciality() . '</td>';
        echo '<td>' . $speciality->getLabelOfSpeciality() . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Types de planques</h2>';
    echo '<div><table id="hideout-types-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Libellé type de Planque</th>';
    echo '</tr></thead>';
    foreach ($hideoutTypes as $hideoutType) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $hideoutType->getIdHideoutType() . '">Modifier</td>';
        echo '<td>' . $hideoutType->getIdHideoutType() . '</td>';
        echo '<td>' . $hideoutType->getHideoutType() . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Pays suivis</h2>';
    echo '<div><table id="nationalities-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Nom du Pays</th>';
    echo '</tr></thead>';
    foreach ($nationalities as $nationality) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $nationality->getIdNationality() . '">Modifier</td>';
        echo '<td>' . $nationality->getIdNationality() . '</td>';
        echo '<td>' . $nationality->getCountry() . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Administrateurs</h2>';
    echo '<div><table id="administrators-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Nom</th><th>Prénom</th><th>Adresse courriel</th><th>Date de création</th>';
    echo '</tr></thead>';
    foreach ($administrators as $administrator) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $administrator->getId() . '">Modifier</td>';
        echo '<td>' . $administrator->getId() . '</td>';
        echo '<td>' . $administrator->getName() . '</td>';
        echo '<td>' . $administrator->getFirstName() . '</td>';
        echo '<td>' . $administrator->getEmail() . '</td>';
        echo '<td>' . $administrator->getCreationDate()->format('Y-m-d') . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Agents du KGB</h2>';
    echo '<div><table id="kgbagents-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Nom de code</th><th>Nationalité</th><th>Spécialités</th>';
    echo '</tr></thead>';
    foreach ($kgbAgents as $kgbAgent) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $kgbAgent->getIdAgent() . '">Modifier</td>';
        echo '<td>' . $kgbAgent->getIdAgent() . '</td>';
        echo '<td>' . $kgbAgent->getName() . '</td>';
        echo '<td>' . $kgbAgent->getFirstName() . '</td>';
        echo '<td>' . $kgbAgent->getDateOfBirth()->format('Y-m-d') . '</td>';
        echo '<td>' . $kgbAgent->getIdentificationCode() . '</td>';
        echo '<td>' . alimenteComboNationality($nationalities, $kgbAgent->getNationality()->getIdNationality(), 'kgbagents') . '</td>';
        echo '<td>' . 'Specialites' . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Contacts</h2>';
    echo '<div><table id="contacts-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Nom de code</th><th>Nationalité</th>';
    echo '</tr></thead>';
    foreach ($contacts as $contact) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $contact->getIdContact() . '">Modifier</td>';
        echo '<td>' . $contact->getIdContact() . '</td>';
        echo '<td>' . $contact->getName() . '</td>';
        echo '<td>' . $contact->getFirstName() . '</td>';
        echo '<td>' . $contact->getDateOfBirth()->format('Y-m-d') . '</td>';
        echo '<td>' . $contact->getCodeName() . '</td>';
        echo '<td>' . alimenteComboNationality($nationalities, $contact->getNationality()->getIdNationality(), 'contacts') . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Planques</h2>';
    echo '<div><table id="hideouts-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Adresse</th><th>Code Postal</th><th>Ville</th><th>Nationalité</th><th>Type de Planque</th>';
    echo '</tr></thead>';
    foreach ($hideouts as $hideout) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $hideout->getIdHideout() . '">Modifier</td>';
        echo '<td>' . $hideout->getIdHideout() . '</td>';
        echo '<td>' . $hideout->getAdress() . '</td>';
        echo '<td>' . $hideout->getCode() . '</td>';
        echo '<td>' . $hideout->getCity() . '</td>';
        echo '<td>' . alimenteComboNationality($nationalities, $hideout->getNationality()->getIdNationality(), 'hideouts') . '</td>';
        echo '<td>' . alimenteComboHideoutTypes($hideoutTypes, $hideout->getHideoutType()->getIdHideoutType(), 'hideouts') . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';

    echo '<h2>Cibles</h2>';
    echo '<div><table id="targets-list">';
    echo '<thead><tr>';
    echo ' <th></th><th>Id Table (PK)</th><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Nom de code</th><th>Nationalité</th>';
    echo '</tr></thead>';
    foreach ($targets as $target) {
        echo '<tr>';
        echo '<td><a href="./?controller=admin&action=modify&mission=' . $target->getIdTarget() . '">Modifier</td>';
        echo '<td>' . $target->getIdTarget() . '</td>';
        echo '<td>' . $target->getName() . '</td>';
        echo '<td>' . $target->getFirstName() . '</td>';
        echo '<td>' . $target->getDateOfBirth()->format('Y-m-d') . '</td>';
        echo '<td>' . $target->getCodeName() . '</td>';
        echo '<td>' . alimenteComboNationality($nationalities, $target->getNationality()->getIdNationality(), 'targets') . '</td>';
        echo '</tr>';
        $index++;
    }
    echo '</table></div>';
}
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