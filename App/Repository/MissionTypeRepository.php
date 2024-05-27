<?php

namespace App\Repository;

use App\Entity\MissionType;

class MissionTypeRepository extends Repository
{
    public function getAll(): array {
        $query = $this->pdo->prepare(
            "SELECT * FROM missionType mt");
        $query->execute();
        $missionTypes = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $missionTypesArray = [];

        if ($missionTypes) {              
            foreach ($missionTypes as $missionType) {
                $missionTypesArray[] = new MissionType($missionType['id_type'], $missionType['typeName']);
            }
        }

        return $missionTypesArray;
    }
}