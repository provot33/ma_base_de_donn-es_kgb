<?php

namespace App\Repository;

use App\Entity\MissionStatus;

class MissionStatusRepository extends Repository
{
    public function getAll(): array {
        $query = $this->pdo->prepare(
            "SELECT * FROM missionStatus ms");
        $query->execute();
        $missionStatus = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $missionStatusArray = [];

        if ($missionStatus) {              
            foreach ($missionStatus as $missionStatu) {
                $missionStatusArray[] = new MissionStatus($missionStatu['id_status'], $missionStatu['statusName']);
            }
        }

        return $missionStatusArray;
    }
}