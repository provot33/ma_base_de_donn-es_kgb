<?php

namespace App\Repository;

use App\Entity\Target;
use App\Entity\Nationality;
use DateTime;

class TargetRepository extends Repository
{
    public function findAllByMissionId(int $id_mission): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM target t
                JOIN missionOnTarget mot ON mot.id_target = t.id_target
                JOIN nationality n ON n.id_nationality = t.id_nationality
                WHERE mot.id_mission = :id_mission
                ORDER BY t.name, t.firstName, t.codeName ASC");
        $query->bindParam(':id_mission', $id_mission, $this->pdo::PARAM_STR);
        $query->execute();
        $targets = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $targetsArray = [];

        if ($targets) {
            foreach ($targets as $target) {
                $targetsArray[] = new Target($target['name'], $target['firstname'],
                    new DateTime($target['dateOfBirth']), $target['codeName'], 
                    new Nationality($target['country']));
            }
        }

        return $targetsArray;
    }
}