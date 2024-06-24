<?php

namespace App\Controller;

use App\Repository\AdministratorRepository;
use App\Repository\HideoutTypeRepository;
use App\Repository\MissionStatusRepository;
use App\Repository\MissionTypeRepository;
use App\Repository\NationalityRepository;
use App\Repository\SpecialityRepository;

class AjaxController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'missionType':
                        $this->applyData(new MissionTypeRepository());
                        break;
                    case 'missionStatus':
                        $this->applyData(new MissionStatusRepository());
                        break;
                    case 'specialities':
                        $this->applyData(new SpecialityRepository());
                        break;
                    case 'hideoutType':
                        $this->applyData(new HideoutTypeRepository());
                        break;
                    case 'nationality':
                        $this->applyData(new NationalityRepository());
                        break;
                    case 'administrator':
                        $this->applyDataComplexe(new AdministratorRepository());
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

    protected function applyData($repository)
    {
        try {
            $contenuPost = "";

            if (isset($_POST['ajout']) && !empty($_POST['ajout'])) {
                $ajouts = explode(',', $_POST['ajout']);
                // $contenuPost.= "<br/>Nb d'éléments à ajouter : ".count($ajouts);
                $this->ajouteMissionType($ajouts, $repository);
            }
            if (isset($_POST['suppression']) && !empty($_POST['suppression'])) {
                $suppressions = explode(',', $_POST['suppression']);
                // $contenuPost.= "<br/>Nb d'éléments à supprimer : ".count($suppressions);
                $this->supprimeMissionType($suppressions, $repository);    
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
                // foreach ($modificationArray as $modification) {
                //     $key = array_keys($modification);
                //     $contenuPost.= "<br/>Clé : ". $key[0] . ", Element : ".$modification[$key[0]];
                // }

                $this->modifieMissionType($modificationArray, $repository);
            }

            throw new \Exception("Effet Traitement : ".$contenuPost);
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function applyDataComplexe($repository)
    {
        try {
            $contenuPost = "";

            if (isset($_POST['ajout']) && !empty($_POST['ajout'])) {
                $ajouts = explode(',', $_POST['ajout']);
                $contenuPost.= "<br/>Nb d'éléments à ajouter : ".count($ajouts);
                // $this->ajouteMissionType($ajouts, $repository);
            }
            if (isset($_POST['suppression']) && !empty($_POST['suppression'])) {
                $suppressions = explode(',', $_POST['suppression']);
                $contenuPost.= "<br/>Nb d'éléments à supprimer : ".count($suppressions);
                // $this->supprimeMissionType($suppressions, $repository);    
            }
            if (isset($_POST['modification']) && !empty($_POST['modification'])) {
                $contenuPost.= "<br/>Modification : ".$_POST['modification'];
                $modifications = explode(',', $_POST['modification']);
                $modificationArray = [];
                $i=0;
                foreach ($modifications as $modification) {
                    $contenuPost.= "<br/>Type élément : ".gettype($modification);
                    $contenuPost.= "<br/>Contenu élément : ".$modification;
                    $modificationArray[] = json_decode($modification, true);
                    $contenuPost.= "<br/>Type modificationArray[] : ".gettype($modificationArray[$i]);
                    $contenuPost.= "<br/>Ligne modificationArray[] : ".print_r($modificationArray[$i], true);;
                    $contenuPost.= "<br/>Ligne du tableau en chaîne - version 1 : ".var_dump(json_decode($modification, true));
                    $contenuPost.= "<br/>Ligne du tableau en chaîne - version 2 : ".var_dump(json_decode($modification));      
                    $i++;
                }
                $contenuPost.= "<br/>Nb d'éléments à modifier : ".count($modifications);
                foreach ($modificationArray as $modification) {
                    $key = array_keys($modification);
                    $contenuPost.= "<br/>Clé : ". $key[0] . ", Element : ".$modification[$key[0]];
                }

                // $this->modifieMissionType($modificationArray, $repository);
            }

            throw new \Exception("Effet Traitement : ".$contenuPost);
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage(),
            ]);
        }
    }
    
    private function ajouteMissionType($ajouts, $repository): void {
        try {
            //$missionTypeRepository = new MissionTypeRepository();

            // Ajout de chaque ligne
            foreach($ajouts as $ajout) {
                $repository->insert($ajout);
            }
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    private function supprimeMissionType($suppressions, $repository): void {
        try {
            // $missionTypeRepository = new MissionTypeRepository();
         
            // Suppression de chaque ligne
            foreach($suppressions as $suppression) {
                $repository->delete($suppression);
            }

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    private function modifieMissionType($modifications, $repository): void {
        try {
            // $missionTypeRepository = new MissionTypeRepository();

            // Mise à jour de chaque ligne
            foreach ($modifications as $modification) {
                $key = array_keys($modification);
                $repository->update($key[0], $modification[$key[0]]);
            }

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

}
