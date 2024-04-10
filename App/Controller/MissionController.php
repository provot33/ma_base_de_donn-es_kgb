<?php

namespace App\Controller;

use App\Repository\MissionRepository;

class MissionController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
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

            $this->render('/mission/list', [
                'missions' => $missions,
            ]);

        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        } 
    }
}