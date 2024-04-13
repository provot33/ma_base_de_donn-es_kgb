<?php

namespace App\Repository;

use App\Entity\KgbAgent;
use App\Entity\Nationality;
use DateTime;

class KgbAgentRepository extends Repository
{
    public function findAllByMissionId(int $id_mission): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM kgbAgent ka
                JOIN agentOnMission aom ON aom.id_kgb_agent = ka.id_kgb_agent
                JOIN nationality n ON n.id_nationality = ka.id_nationality
                WHERE aom.id_mission = :id_mission
                ORDER BY ka.name, ka.firstName, ka.identificationCode ASC");
        $query->bindParam(':id_mission', $id_mission, $this->pdo::PARAM_STR);
        $query->execute();
        $kgbAgents = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $kgbAgentsArray = [];

        if ($kgbAgents) {
            foreach ($kgbAgents as $kgbAgent) {
                $specialityRepository = new SpecialityRepository();
                $specialitiesArray = $specialityRepository->findAllByKgbAgentId($kgbAgent['id_kgb_agent']);
                $kgbAgentsArray[] = new KgbAgent($kgbAgent['name'], $kgbAgent['firstname'],
                    new DateTime($kgbAgent['dateOfBirth']), $kgbAgent['identificationCode'], 
                    new Nationality($kgbAgent['country']), $specialitiesArray);
            }
        }

        return $kgbAgentsArray;
    }
}
