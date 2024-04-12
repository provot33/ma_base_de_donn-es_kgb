// Index permettant de savoir quelle est la mission à afficher
let missionIndex = 0;

// Permet de se déplacer dans les missions
// n : le nombre de missions qu'on parcourt par rapport à celle en cours.
//     peut-être négatif pour faire marche arrière
function plusMissions(n) {
    afficheMission(missionIndex += n);
}

// Gère l'ouverture/fermeture des onglets dans les tabPanels
function openTabs(evt, idElement, tabType) {
    let i, tabcontent, tablinks;
  
    // On récupère tous les elements avec class="tabcontent_<type>" et on les cache
    tabcontent = document.getElementsByClassName("tabcontent_" + tabType);
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // On récupère tous les éléments avec class="tablinks_<type>" et on enlève la class "active"
    tablinks = document.getElementsByClassName("tablinks_"  + tabType);
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // On affiche l'onglet courant, et on ajout la class "active" sur le bouton qui a ouvert l'onglet
    document.getElementById(idElement).style.display = "block";
    evt.currentTarget.className += " active";
};

// Affiche la mission choisie
function afficheMission(index) {
    // On vide le conteneur liste_mission de son HTML
    document.getElementById("liste_mission").innerHTML = "";
    
    // On vérifie que l'index pointe vers une mission qui existe, sinon on replace l'index.
    if (index < 0) {index = missions.length - 1;}
    if (index >= missions.length) {index = 0;}
    missionIndex = index;
    // On ajoute la mission choisie
    ajouteMission(missions[missionIndex]);
};

// Ajoute la liste des agents à la mission et la met en forme
function ajouteAgent(agent, premierElement) {
    let dossier = '<div id="'+ agent.identificationCode +'" class="tabcontent_agent"' + (premierElement?" style=\"display: block;\"":"") + '>';
    dossier += '<h3>Agent : ' + agent.identificationCode + '</h3>';
    dossier += '<p>Nom : ' + agent.name + ' Prénom : ' + agent.firstName + '</p>';
    dossier += '<p>Né le : ' + agent.dateOfBirth + '</p>';
    dossier += '<p>Pays : ' + agent.nationality + '</p>';
    dossier += '<p>Domaine d\'expertise : </p>';    
    dossier += '<div><table>';
    agent.specialities.forEach(speciality => {
        dossier += '<tr><td>' + speciality.labelOfSpeciality + '</td></tr>';
    });
    dossier += '</table></div></div>';
    return dossier;
};

// Ajoute la liste des cibles à la mission et la met en forme
function ajouteTarget(target, premierElement) {
    let dossier = '<div id="'+ target.codeName +'" class="tabcontent_target"' + (premierElement?" style=\"display: block;\"":"") + '>';
    dossier += '<h3>Cible : ' + target.codeName + '</h3>';
    dossier += '<p>Nom : ' + target.name + ' Prénom : ' + target.firstName + '</p>';
    dossier += '<p>Né le : ' + target.dateOfBirth + '</p>';
    dossier += '<p>Pays : ' + target.nationality + '</p></div>';
    return dossier;
};

// Ajoute la liste des contacts à la mission et la met en forme
function ajouteContact(contact, premierElement) {
    let dossier = '<div id="'+ contact.codeName +'" class="tabcontent_contact"' + (premierElement?" style=\"display: block;\"":"") + '>';
    dossier += '<h3>Contact : ' + contact.codeName + '</h3>';
    dossier += '<p>Nom : ' + contact.name + ' Prénom : ' + contact.firstName + '</p>';
    dossier += '<p>Né le : ' + contact.dateOfBirth + '</p>';
    dossier += '<p>Pays : ' + contact.nationality + '</p></div>';
    return dossier;
};

// Ajoute la liste des planques à la mission et la met en forme
function ajouteHideout(hideout, premierElement) {
    let dossier = '<div id="'+ hideout.hideoutType +'" class="tabcontent_hideout"' + (premierElement?" style=\"display: block;\"":"") + '>';
    dossier += '<h3>Type de planque : ' + hideout.hideoutType + '</h3>';
    dossier += '<p>Située : ' + hideout.adress + '</p>';
    dossier += '<p>' + hideout.code + ' ' + hideout.city + '</p>';
    dossier += '<p>Pays : ' + hideout.nationality + '</p></div>';
    return dossier;
};

// Ajoute la mission et la met en forme
function ajouteMission(mission) {
    let carte = ''; 
    carte += '<h2>Titre de la mission : ' + mission.titre + '</h2>';
    carte += '<div>Description : ' + mission.description + '</div>';
    carte += '<h3>Nom de Code : ' + mission.codeName + '</h3>';
    carte += '<div>De : ' + mission.startDate + ' à ' + mission.finishDate + '</div>';
    carte += '<div>Spécialité requise : ' + mission.speciality + '</div>';
    carte += '<div>Localisation : ' + mission.nationality + '</div>';
    carte += '<div>Type de mission : ' + mission.missionType + '</div>';
    carte += '<div>Statut de la mission : ' + mission.missionStatus + ' </div>';

    let listeElements = '';
    let premierElement = true;
    carte += '<div class="tab">';
    mission.agents.forEach(agent => {
        carte += '<button class="tablinks_agent' + (premierElement?" active":"") + '" onclick="openTabs(event, \'' + agent.identificationCode + '\', \'agent\')">' + agent.identificationCode + '</button>';
        listeElements += ajouteAgent(agent, premierElement);
        premierElement = false;
    });
    carte += '</div>' + listeElements;

    listeElements = '';
    premierElement = true;
    carte += '<div class="tab">';
    mission.targets.forEach(target => {
        carte += '<button class="tablinks_target' + (premierElement?" active":"") + '"" onclick="openTabs(event, \'' + target.codeName + '\', \'target\')">' + target.codeName + '</button>';
        listeElements += ajouteTarget(target, premierElement);
        premierElement = false;
    })
    carte += '</div>' + listeElements;

    listeElements = '';
    premierElement = true;
    carte += '<div class="tab">';
    mission.contacts.forEach(contact => {
        carte += '<button class="tablinks_contact' + (premierElement?" active":"") + '"" onclick="openTabs(event, \'' + contact.codeName + '\', \'contact\')">' + contact.codeName + '</button>';
        listeElements += ajouteContact(contact, premierElement);
        premierElement = false;
    })
    carte += '</div>' + listeElements;

    listeElements = '';
    premierElement = true;
    carte += '<div class="tab">';
    mission.hideouts.forEach(hideout => {
        carte += '<button class="tablinks_hideout' + (premierElement?" active":"") + '"" onclick="openTabs(event, \'' + hideout.hideoutType + '\', \'hideout\')">' + hideout.hideoutType + '</button>';
        listeElements += ajouteHideout(hideout, premierElement);
        premierElement = false;
    })
    carte += '</div>' + listeElements;

    carte += '<hr></hr>';

    document.getElementById("liste_mission").innerHTML += carte;
};

// À l'ouverture de la page, on affiche la mission par défaut (la première de la liste)
afficheMission(missionIndex);