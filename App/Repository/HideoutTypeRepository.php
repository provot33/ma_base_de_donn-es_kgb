<?php

namespace App\Repository;

use App\Entity\HideoutType;

class HideoutTypeRepository extends Repository
{
    public function getAll(): array {
        $query = $this->pdo->prepare(
            "SELECT * FROM hideoutType hs");
        $query->execute();
        $hideoutTypes = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $hideoutTypesArray = [];

        if ($hideoutTypes) {              
            foreach ($hideoutTypes as $hideoutType) {
                $hideoutTypesArray[] = new HideoutType($hideoutType['id_hideoutType'], $hideoutType['hideoutType']);
            }
        }

        return $hideoutTypesArray;
    }
}