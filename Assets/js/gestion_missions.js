const typeAddButton = document.getElementById("typeMissionAdd");
const typeUpdateButton = document.getElementById("typeMissionUpdate");

typeAddButton.addEventListener("click", addTypeLine);
typeUpdateButton.addEventListener("click", updateType);

function addTypeLine() {
  let tbodyRef = document
    .getElementById("missions-types-list")
    .getElementsByTagName("tbody")[0];
  let nbLine = tbodyRef.rows.length;

  // Insert a row at the end of table
  let newRow = tbodyRef.insertRow();

  // Insert a cell at the end of the row
  // let idCell = newRow.insertCell();
  // idCell.style="display:none;";
  // idCell.innerHTML = '<input type="hidden" id="typeNb_'+nbLine+'" name="typeNb_'+nbLine+'" value="typeNb_'+nbLine+'_new" />';
  let pkCell = newRow.insertCell();
  pkCell.innerHTML = "À définir";
  let idCell = newRow.insertCell();
  idCell.style = "display:none;";
  let inputCell = newRow.insertCell();
  inputCell.innerHTML =
    '<input type="text" id="typename_' +
    nbLine +
    '" name="typename_' +
    nbLine +
    '" value="" />';
  let suppressCell = newRow.insertCell();
  suppressCell.innerHTML =
    '<input type="checkbox" id="typeMissionSuppr_' +
    nbLine +
    '" name="typeMissionSuppr_' +
    nbLine +
    '" />';
}

function updateType() {
  // alert(
  //   "+Traite les lignes pour définir les ordres SQL (Update/delete/insert)"
  // );
  let idASupprimer = [];
  let ligneAAjouter = [];
  let ligneAModifier = [];
  let tbodyRef = document
    .getElementById("missions-types-list")
    .getElementsByTagName("tbody")[0];
  let nbLine = tbodyRef.rows.length;
  for (let i = 0; i < nbLine; i++) {
    //gets cells of current row
    let cells = tbodyRef.rows.item(i).cells;
    const aSupprimer = document.getElementById("typeMissionSuppr_" + i).checked;
    const valeur = document.getElementById("typename_" + i).value;
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
          ligneAModifier.push('{"'+cells.item(0).innerHTML+'":"'+valeur+'"}');
        }
    }
  }

  if (ligneAAjouter.length !== 0 || idASupprimer.length !== 0 || ligneAModifier.length !== 0) {
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
    fetch("/index.php?controller=ajax&action=data", {
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
