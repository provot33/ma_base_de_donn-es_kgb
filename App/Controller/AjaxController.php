<?php

namespace App\Controller;

use App\Repository\MissionTypeRepository;

class AjaxController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'data':
                        $this->applyData();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function applyData()
    {
        try {
            // $contenuPost = "";

            if (isset($_POST['ajout']) && !empty($_POST['ajout'])) {
                $ajouts = explode(',', $_POST['ajout']);
                // $contenuPost.= "<br/>Nb d'éléments à ajouter : ".count($ajouts);
                $this->ajouteMissionType($ajouts);
            }
            if (isset($_POST['suppression']) && !empty($_POST['suppression'])) {
                $suppressions = explode(',', $_POST['suppression']);
                // $contenuPost.= "<br/>Nb d'éléments à supprimer : ".count($suppressions);
                $this->supprimeMissionType($suppressions);    
            }
            if (isset($_POST['modification']) && !empty($_POST['modification'])) {
                // $contenuPost.= "<br/>Modification : ".$_POST['modification'];
                $modifications = explode(',', $_POST['modification']);
                $modificationArray = [];
                // $i=0;
                foreach ($modifications as $modification) {
                    // $contenuPost.= "<br/>Type élément : ".gettype($modification);
                    // $contenuPost.= "<br/>Contenu élément : ".$modification;
                    $modificationArray[] = json_decode($modification, true);
                    // $contenuPost.= "<br/>Type modificationArray[] : ".gettype($modificationArray[$i]);
                    // $contenuPost.= "<br/>Ligne modificationArray[] : ".print_r($modificationArray[$i], true);;
                    // $contenuPost.= "<br/>Ligne du tableau en chaîne - version 1 : ".var_dump(json_decode($modification, true));
                    // $contenuPost.= "<br/>Ligne du tableau en chaîne - version 2 : ".var_dump(json_decode($modification));      
                    // $i++;
                }
                // $contenuPost.= "<br/>Nb d'éléments à modifier : ".count($modifications);
                foreach ($modificationArray as $modification) {
                    $key = array_keys($modification);
                    // $contenuPost.= "<br/>Clé : ". $key[0] . ", Element : ".$modification[$key[0]];
                }

                $this->modifieMissionType($modificationArray);
            }

            //throw new \Exception("Effet Traitement : ".$contenuPost);
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function ajouteMissionType($ajouts): void {
        try {
            $missionTypeRepository = new MissionTypeRepository();

            // Ajout de chaque ligne
            foreach($ajouts as $ajout) {
                $missionTypeRepository->insert($ajout);
            }
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    private function supprimeMissionType($suppressions): void {
        try {
            $missionTypeRepository = new MissionTypeRepository();
         
            // Suppression de chaque ligne
            foreach($suppressions as $suppression) {
                $missionTypeRepository->delete($suppression);
            }

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    private function modifieMissionType($modifications): void {
        try {
            $missionTypeRepository = new MissionTypeRepository();

            // Mise à jour de chaque ligne
            foreach ($modifications as $modification) {
                $key = array_keys($modification);
                $missionTypeRepository->update($key[0], $modification[$key[0]]);
            }

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

}
