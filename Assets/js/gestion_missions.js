document
  .getElementById("typeMissionAdd")
  .addEventListener("click", addTypeLine);
document
  .getElementById("typeMissionUpdate")
  .addEventListener("click", updateTypeTable);

function addTypeLine() {
  addLine("missions-types-list", ["typename_"], "typeMissionSuppr_");
}
function updateTypeTable() {
  updateTable(
    "missionType",
    "missions-types-list",
    "typename_",
    "typeMissionSuppr_"
  );
}

document
  .getElementById("statutMissionAdd")
  .addEventListener("click", addStatusLine);
document
  .getElementById("statutMissionUpdate")
  .addEventListener("click", updateStatusTable);

function addStatusLine() {
  addLine("missions-status-list", ["statusname_"], "statusMissionSuppr_");
}
function updateStatusTable() {
  updateTable(
    "missionStatus",
    "missions-status-list",
    "statusname_",
    "statusMissionSuppr_"
  );
}

document
  .getElementById("specialityAdd")
  .addEventListener("click", addSpecialityLine);
document
  .getElementById("specialityUpdate")
  .addEventListener("click", updateSpecialityTable);

function addSpecialityLine() {
  addLine("specialities-list", ["specialityname_"], "specialitySuppr_");
}
function updateSpecialityTable() {
  updateTable(
    "specialities",
    "specialities-list",
    "specialityname_",
    "specialitySuppr_"
  );
}

document
  .getElementById("hideoutTypeAdd")
  .addEventListener("click", addHideoutTypeLine);
document
  .getElementById("hideoutTypeUpdate")
  .addEventListener("click", updateHideoutTypeTable);

function addHideoutTypeLine() {
  addLine("hideout-types-list", ["hideoutTypename_"], "hideoutSuppr_");
}
function updateHideoutTypeTable() {
  updateTable(
    "hideoutType",
    "hideout-types-list",
    "hideoutTypename_",
    "hideoutSuppr_"
  );
}

document
  .getElementById("nationalityAdd")
  .addEventListener("click", addNationalityLine);
document
  .getElementById("nationalityUpdate")
  .addEventListener("click", updateNationalityTable);

function addNationalityLine() {
  addLine("nationalities-list", ["nationalityname_"], "nationalitySuppr_");
}
function updateNationalityTable() {
  updateTable(
    "nationality",
    "nationalities-list",
    "nationalityname_",
    "nationalitySuppr_"
  );
}

document
  .getElementById("administratorAdd")
  .addEventListener("click", addAdministratorLine);
document
  .getElementById("adminstratorUpdate")
  .addEventListener("click", updateAdministratorTable);

function addAdministratorLine() {
  addLine(
    "administrators-list",
    [
      "adminstratorName_",
      "adminstratorFirstname_",
      "adminstratorEmail_",
      "adminstratorPwd_",
      "adminstratorDate_",
    ],
    "adminstratorSuppr_"
  );
}
function updateAdministratorTable() {
  // updateTable("nationality", "nationalities-list", "nationalityname_", "nationalitySuppr_");
  alert("On veut déclencher la mise à jour de la table Administrateurs");
  updateComplexTable(
    "administrator",
    "administrators-list",
    [
      "adminstratorName_",
      "adminstratorFirstname_",
      "adminstratorEmail_",
      "adminstratorPwd_",
      "adminstratorDate_",      
    ],
    "adminstratorSuppr_"
  );
}

function addLine(nomListe, params, nomSupression) {
  let tbodyRef = document
    .getElementById(nomListe)
    .getElementsByTagName("tbody")[0];
  let nbLine = tbodyRef.rows.length;

  // Insert a row at the end of table
  let newRow = tbodyRef.insertRow();

  let pkCell = newRow.insertCell();
  pkCell.innerHTML = "À définir";
  for (let i = 0; i < params.length; i++) {
    let idCell = newRow.insertCell();
    idCell.style = "display:none;";
    let inputCell = newRow.insertCell();
    inputCell.innerHTML =
      '<input type="text" id="' +
      params[i] +
      nbLine +
      '" name="' +
      params[i] +
      nbLine +
      '" value="" />';
  }

  let suppressCell = newRow.insertCell();
  suppressCell.innerHTML =
    '<input type="checkbox" id="' +
    nomSupression +
    nbLine +
    '" name="' +
    nomSupression +
    nbLine +
    '" />';
}

function ligneModifiee(cells, params, numLigne) {
  let difference = false

  let j=0;
  const nbElements = (params.length * 2);
  for (let i = 1; i < nbElements && !difference; i = i+2) {
    const reference = cells.item(i).innerHTML;
    const value = document.getElementById(params[j] + numLigne).value;
    j++;
    if (reference !== value) {
      // alert ("Différence repérée : " + reference + " != " + value);
      difference = true;
    }
  }

  return difference;
}

function updateComplexTable(nomTable, nomListe, params, nomSupression) {
  // alert(
  //   "+Traite les lignes pour définir les ordres SQL (Update/delete/insert)"
  // );
  let idASupprimer = [];
  let ligneAAjouter = [];
  let ligneAModifier = [];
  let tbodyRef = document
    .getElementById(nomListe)
    .getElementsByTagName("tbody")[0];
  let nbLine = tbodyRef.rows.length;
  for (let i = 0; i < nbLine; i++) {
    //gets cells of current row
    let cells = tbodyRef.rows.item(i).cells;
    const aSupprimer = document.getElementById(nomSupression + i).checked;
    if (cells.item(0).innerHTML.includes("À définir") && !aSupprimer) {
      alert ('Ligne '+i+' est une nouvelle ligne : vérifier les champs saisi');
      let ligneDonnees = [];
      let elementsAjoutes = 0;
      for (let j = 0; j < params.length; j++) {
        // alert('On traite le paramètre ' + params[j]);
        const valeur = document.getElementById(params[j] + i).value;
        if (valeur) {
          // alert ('Ligne '+i+' à ajouter : valeur ' + valeur);
          // ligneDonnees.push({[params[j]]: valeur})
          ligneDonnees[params[j]] = valeur;
          elementsAjoutes++;
        // } else {
        //       alert ('Ligne '+i+' est vide. On ignore ');
        }
      }
      if (elementsAjoutes !== params.length) {
        // alert("Exception !!\n"+elementsAjoutes+" VS "+params.length);
        // for (let j = 0; j < params.length; j++) {
        //   alert('On parcours la ligneCréée : '+j+' = ' + ligneDonnees[params[j]]);
        // }
        // Gérer les erreurs.
        return;
      }
      ligneAAjouter.push('{' + i + ':' + ligneDonnees + '}');
      alert("Ligne Données ajoutés " + ligneDonnees);
      alert("Lignes à ajouter " + ligneAAjouter);
      ligneDonnees.forEach(function(item) {
        Object.keys(item).forEach(function(key) {
          alert("LigneDonnees key:" + key + "value:" + item[key]);
        });
      });
      // ligneAAjouter.forEach(function(item) {
      //   Object.keys(item).forEach(function(key) {
      //     alert("ligneAAjouter key:" + key + "value:" + item[key]);
      //   });
      // });
    } else if (aSupprimer && !cells.item(0).innerHTML.includes("À définir")) {
        // alert ('Ligne '+i+' à supprimer. Valeur de clé '+cells.item(0).innerHTML);
        idASupprimer.push(cells.item(0).innerHTML);
    } else if (ligneModifiee(cells, params, i)) {
      let ligneDonnees = [];
      let elementsValorises = 0;
      for (let j = 0; j < params.length; j++) {
        // alert('On traite le paramètre ' + params[j]);
        const valeur = document.getElementById(params[j] + i).value;
        if (valeur) {
          // alert ('Ligne '+i+' à modifier : valeur ' + valeur);
          ligneDonnees[params[j]] = valeur;
          elementsValorises++;
        // } else {
        //       alert ('Ligne '+i+' est vide. On ignore ');
        }
      }
      if (elementsValorises !== params.length) {
        // Cas particuliers de la table Administrator qui contient un mot de passe
        if (!(elementsValorises+1 === params.length && params[3] === "adminstratorPwd_" && document.getElementById("adminstratorPwd_" + i).value === "")) {
          alert("Exception !!\n"+elementsValorises+" VS "+params.length);
          // for (let j = 0; j < params.length; j++) {
          //   alert('On parcours la ligneCréee : '+j+' = ' + ligneDonnees[params[j]]);
          // }
          // Gérer les erreurs.
          return;
        }
      }
      ligneAModifier.push('{"' + cells.item(0).innerHTML + '":"' + ligneDonnees + '"}');


      //   if (valeur) {
      //     ligneAModifier.push(
      //       '{"' + cells.item(0).innerHTML + '":"' + valeur + '"}'
      //     );
      //   }
      // }
    }
  }

  if (
    ligneAAjouter.length !== 0 ||
    idASupprimer.length !== 0 ||
    ligneAModifier.length !== 0
  ) {
    alert("Mise à jour des tables - appel backOffice");
    alert("Données envoyés \n"+
      "\nElements ajoués : " + ligneAAjouter.length +
      "\nElements supprimés : " + idASupprimer.length +
      "\nElements modifiés : " + ligneAModifier.length
    );

    // const formMission = document.getElementById("typeMission");
    let formData = new FormData();
    formData.append("ajout", ligneAAjouter);
    formData.append("suppression", idASupprimer);
    formData.append("modification", ligneAModifier);

    let detailForm = "";
    for (var key in formData) {
      detailForm += "\nclé " + key + " a pour valeur " + formData[key];
    }
    // alert("Fetch de la ressource avec le formulaire : " + detailForm);
    fetch("/index.php?controller=ajax&action=" + nomTable, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // console.log("success!", response);
        if (response.ok) {
          // Lance un rechargement de la page pour mettre les données à jour
          // notamment en cas de DELETE CASCADE imposée par une suppression
          // location.reload();
          // alert("Reponse OK !");
        } else {
          // document.getElementById("formulaire_erreurs_adresse").innerHTML = "Impossible de modifier l'adresse - Réessayer ulétrieurement<br/>";
          alert("Reponse KO !");
          // Handle the error
        }
      })
      .catch((error) => {
        alert("Reponse Erreur !");
        // Handle the error
      });
  }
}

function updateTable(nomTable, nomListe, nomDonnee, nomSupression) {
  // alert(
  //   "+Traite les lignes pour définir les ordres SQL (Update/delete/insert)"
  // );
  let idASupprimer = [];
  let ligneAAjouter = [];
  let ligneAModifier = [];
  let tbodyRef = document
    .getElementById(nomListe)
    .getElementsByTagName("tbody")[0];
  let nbLine = tbodyRef.rows.length;
  for (let i = 0; i < nbLine; i++) {
    //gets cells of current row
    let cells = tbodyRef.rows.item(i).cells;
    const aSupprimer = document.getElementById(nomSupression + i).checked;
    const valeur = document.getElementById(nomDonnee + i).value;
    if (cells.item(0).innerHTML.includes("À définir") && !aSupprimer) {
      // alert ('Ligne '+i+' est une nouvelle ligne : vérifier le champ saisi');
      if (valeur) {
        // alert ('Ligne '+i+' à ajouter : valeur ' + valeur);
        ligneAAjouter.push(valeur);
        // } else {
        //     alert ('Ligne '+i+' est vide. On ignore ');
      }
    } else if (aSupprimer && !cells.item(0).innerHTML.includes("À définir")) {
      // alert ('Ligne '+i+' à supprimer. Valeur de clé '+cells.item(0).innerHTML);
      idASupprimer.push(cells.item(0).innerHTML);
    } else if (!aSupprimer && cells.item(1).innerHTML != valeur) {
      // alert ('Ligne '+i+' à modifier \nClé : ' + cells.item(0).innerHTML +
      //     '\nValeur Ancienne : ' + cells.item(1).innerHTML +
      //     '\nValeur Ancienne : ' + valeur);
      if (valeur) {
        ligneAModifier.push(
          '{"' + cells.item(0).innerHTML + '":"' + valeur + '"}'
        );
      }
    }
  }

  if (
    ligneAAjouter.length !== 0 ||
    idASupprimer.length !== 0 ||
    ligneAModifier.length !== 0
  ) {
    // alert("Mise à jour des tables - appel backOffice");

    // const formMission = document.getElementById("typeMission");
    let formData = new FormData();
    formData.append("ajout", ligneAAjouter);
    formData.append("suppression", idASupprimer);
    formData.append("modification", ligneAModifier);

    let detailForm = "";
    for (var key in formData) {
      detailForm += "\nclé " + key + " a pour valeur " + formData[key];
    }
    // alert("Fetch de la ressource avec le formulaire : " + detailForm);
    fetch("/index.php?controller=ajax&action=" + nomTable, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // console.log("success!", response);
        if (response.ok) {
          // Lance un rechargement de la page pour mettre les données à jour
          // notamment en cas de DELETE CASCADE imposée par une suppression
          location.reload();
          // alert("Reponse OK !");
        } else {
          // document.getElementById("formulaire_erreurs_adresse").innerHTML = "Impossible de modifier l'adresse - Réessayer ulétrieurement<br/>";
          alert("Reponse KO !");
          // Handle the error
        }
      })
      .catch((error) => {
        alert("Reponse Erreur !");
        // Handle the error
      });
  }
}
