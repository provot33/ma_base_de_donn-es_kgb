function prepareListing() {
    document.getElementById("liste_mission").innerHTML = "";
    // let marqueSelectionnee = document.getElementById("type_marque");
    // let energieSelectionnee = document.getElementById("type_energie");
    // let nbPortesSelectionnee = document.getElementById("type_nbPortes");
    // let prixMin = formatPrix.from(document.getElementById("prix-min").value);
    // let prixMax = formatPrix.from(document.getElementById("prix-max").value);
    // let kilometrageMin = formatKilometre.from(document.getElementById("kilometre-min").value);
    // let kilometrageMax = formatKilometre.from(document.getElementById("kilometre-max").value);
    missions.forEach(mission => {
        ajouteMission(mission);
    });
    // vehicules.forEach(vehicule => {
    //     let ajouteVehicule = true;
    //     if (vehicule.prix < prixMin || vehicule.prix > prixMax ) {
    //         ajouteVehicule = false;
    //     }
    //     if (vehicule.kilometrage < kilometrageMin || vehicule.kilometrage > kilometrageMax ) {
    //         ajouteVehicule = false;
    //     }
    //     if (ajouteVehicule && marqueSelectionnee.value !== "0"  ) {
    //         if (marqueSelectionnee.options[marqueSelectionnee.selectedIndex].text !== vehicule.marque){
    //             ajouteVehicule = false;
    //         }
    //     }
    //     if (ajouteVehicule && energieSelectionnee.value !== "0") {
    //         if (energieSelectionnee.options[energieSelectionnee.selectedIndex].text !== vehicule.motorisation){
    //             ajouteVehicule = false;
    //         }
    //     }
    //     if (ajouteVehicule && nbPortesSelectionnee.value !== "0") {
    //         if (nbPortesSelectionnee.value !== vehicule.nbPortes){
    //             ajouteVehicule = false;
    //         }
    //     }
    //     if (ajouteVehicule) {
    //         callback.apply(this, [vehicule]);
    //     }
    // });
};

function ajouteAgent(agent) {
    let dossier = '<h3>Agent : ' + agent.identificationCode + '</h3>';
    dossier += '<div>Nom : ' + agent.name + ' Prénom : ' + agent.firstName + '</div>';
    dossier += '<div>Né le : ' + agent.dateOfBirth + '</div>';
    dossier += '<div>Pays : ' + agent.nationality + '</div>';
    dossier += '<div>Domaine d\'expertise : </div>';
    dossier += '<div><table>';
    agent.specialities.forEach(speciality => {
        dossier += '<tr><td>' + speciality.labelOfSpeciality + '</td></tr>';
    });
    dossier += '</table></div>';
    return dossier;
};

function ajouteTarget(target) {
    let dossier = '<h3>Cible : ' + target.codeName + '</h3>';
    dossier += '<div>Nom : ' + target.name + ' Prénom : ' + target.firstName + '</div>';
    dossier += '<div>Né le : ' + target.dateOfBirth + '</div>';
    dossier += '<div>Pays : ' + target.nationality + '</div>';
    return dossier;
};

function ajouteContact(contact) {
    let dossier = '<h3>Contact : ' + contact.codeName + '</h3>';
    dossier += '<div>Nom : ' + contact.name + ' Prénom : ' + contact.firstName + '</div>';
    dossier += '<div>Né le : ' + contact.dateOfBirth + '</div>';
    dossier += '<div>Pays : ' + contact.nationality + '</div>';
    return dossier;
};

function ajouteHideout(hideout) {
    let dossier = '<h3>Type de planque : ' + hideout.hideoutType + '</h3>';
    dossier += '<div>Située : ' + hideout.adress + '</div>';
    dossier += '<div>' + hideout.code + ' ' + hideout.city + '</div>';
    dossier += '<div>Pays : ' + hideout.nationality + '</div>';
    return dossier;
};

function ajouteMission(mission) {
    let carte = ''; //'<div class="card"><div class="card-inner"><div class="card-front"><div class="card-content">';
    carte += '<h2>Titre de la mission : ' + mission.titre + '</h2>';
    carte += '<div>Description : ' + mission.description + '</div>';
    carte += '<h3>Nom de Code : ' + mission.codeName + '</h3>';
    carte += '<div>De : ' + mission.startDate + ' à ' + mission.finishDate + '</div>';
    carte += '<div>Spécialité requise : ' + mission.speciality + '</div>';
    carte += '<div>Localisation : ' + mission.nationality + '</div>';
    carte += '<div>Type de mission : ' + mission.missionType + '</div>';
    carte += '<div>Statut de la mission : ' + mission.missionStatus + ' </div>';

    mission.agents.forEach(agent => {
        carte += ajouteAgent(agent);
    });

    mission.targets.forEach(target => {
        carte += ajouteTarget(target);
    })

    mission.contacts.forEach(contact => {
        carte += ajouteContact(contact);
    })

    mission.hideouts.forEach(hideout => {
        carte += ajouteHideout(hideout);
    })

    carte += '<hr></hr>';
    // carte += '<p>' + vehicule.miseEnAvant2 + '</p>';
    // carte += '<p>' + vehicule.miseEnAvant3 + '</p>';
    // if (vehicule.miseEnAvant4 !== null){
    //     carte += '<p>' + vehicule.miseEnAvant4 + '</p>';
    // }
    // if (vehicule.miseEnAvant5 !== null){
    //     carte += '<p>' + vehicule.miseEnAvant5 + '</p>';
    // }
    // carte += '<p>' + vehicule.annee + '</p>';
    // carte += '<a href="/php/detail_vehicule.php?vehicule=' + vehicule.identifiant + '">Plus de détails</a>';
    // carte += '</div></div></div>';

    document.getElementById("liste_mission").innerHTML += carte;
};

prepareListing();