<?php

namespace App\Controller;

use App\Repository\AdministratorRepository;
use App\Repository\ContactRepository;
use App\Repository\HideoutRepository;
use App\Repository\HideoutTypeRepository;
use App\Repository\KgbAgentRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionStatusRepository;
use App\Repository\MissionTypeRepository;
use App\Repository\NationalityRepository;
use App\Repository\SpecialityRepository;
use App\Repository\TargetRepository;

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
                    case 'modify':
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
            if (! isset($_SESSION['user']) ){
                header('location: index.php?controller=mission&action=list');
            }
            // Récupérer toutes les missions
            $missionRepository = new MissionRepository();
            $missions = $missionRepository->getAll();

            // Récupérer les constantes qui seront affichés sur la page
            $specialityRepository = new SpecialityRepository();
            $specialities = $specialityRepository->getAll();

            $missionTypeRepository = new MissionTypeRepository();
            $missionTypes = $missionTypeRepository->getAll();

            $missionStatusRepository = new MissionStatusRepository();
            $missionStatus = $missionStatusRepository->getAll();

            $hideoutTypeRepository = new HideoutTypeRepository();
            $hideoutTypes = $hideoutTypeRepository->getAll();

            $nationalityRepository = new NationalityRepository();
            $nationalities = $nationalityRepository->getAll();

            $administratorRepository = new AdministratorRepository();
            $administrators = $administratorRepository->getAll();

            $kgbAgentRepository = new KgbAgentRepository();
            $kgbAgents = $kgbAgentRepository->getAll();

            $contactRepository = new ContactRepository();
            $contacts = $contactRepository->getAll();

            $hideoutRepository = new HideoutRepository();
            $hideouts = $hideoutRepository->getAll();

            $targetRepository = new TargetRepository();
            $targets = $targetRepository->getAll();

            $this->render('/authent/list', [
                'missions' => $missions,
                'specialities' => $specialities,
                'missionTypes' => $missionTypes,
                'missionStatus' => $missionStatus,
                'hideoutTypes' => $hideoutTypes,
                'nationalities' => $nationalities,
                'administrators' => $administrators,
                'kgbAgents' => $kgbAgents,
                'contacts' => $contacts,
                'hideouts' => $hideouts,
                'targets' => $targets,
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