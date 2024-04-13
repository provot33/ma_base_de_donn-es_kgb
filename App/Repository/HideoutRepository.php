<?php

namespace App\Repository;

use App\Entity\Hideout;
use App\Entity\HideoutType;
use App\Entity\Nationality;

class HideoutRepository extends Repository
{
    public function findAllByMissionId(int $id_mission): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM hideout h
                JOIN hideoutForMission hfm ON hfm.id_hideout = h.id_hideout
                JOIN hideoutType ht ON ht.id_hideoutType = h.id_hideoutType
                JOIN nationality n ON n.id_nationality = h.id_nationality
                WHERE hfm.id_mission = :id_mission
                ORDER BY h.adress, h.code ASC");
        $query->bindParam(':id_mission', $id_mission, $this->pdo::PARAM_STR);
        $query->execute();
        $hideouts = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $hideoutsArray = [];

        if ($hideouts) {
            foreach ($hideouts as $hideout) {
                $hideoutsArray[] = new Hideout($hideout['adress'], $hideout['code'],
                    $hideout['city'], new Nationality($hideout['country']), 
                    new HideoutType($hideout['hideoutType']));
            }
        }

        return $hideoutsArray;
    }
}