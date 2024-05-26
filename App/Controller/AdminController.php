<?php

namespace App\Controller;

use App\Repository\HideoutTypeRepository;
use App\Repository\MissionRepository;
use App\Repository\SpecialityRepository;

class AdminController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
                        break;
                    case 'list_detail':
                        $this->list_detail();
                        break;
                    case 'detail':
                        $idMission = $_GET['mission'];
                        $this->detail($idMission);
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
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function list()
    {
        try {
            // Récupérer toutes les missions
            $missionRepository = new MissionRepository();
            $missions = $missionRepository->getAll();

            // Récupérer les constantes qui seront affichés sur la page
            $specialityRepository = new SpecialityRepository();
            $specialities = $specialityRepository->getAll();

            $hideoutTypeRepository = new HideoutTypeRepository();
            $hideoutTypes = $hideoutTypeRepository->getAll();

            $this->render('/mission/list', [
                'missions' => $missions,
                'specialities' => $specialities,
                'hideoutTypes' => $hideoutTypes,
            ]);

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    protected function list_detail()
    {
        try {
            // Récupérer toutes les missions
            $missionRepository = new MissionRepository();
            $missions = $missionRepository->getAll();

            $this->render('/mission/list_detail', [
                'missions' => $missions,
            ]);

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }

    protected function detail($idMission)
    {
        try {
            // Récupérer toutes les missions
            $missionRepository = new MissionRepository();
            $mission = $missionRepository->getMission($idMission);

            $this->render('/mission/detail', [
                'mission' => $mission,
            ]);

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }
}