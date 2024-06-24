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
    
    public function insert($hideoutType): void {
        $query = $this->pdo->prepare(
            "INSERT INTO hideoutType
                (hideoutType)
                VALUES
                (:hideoutType)");
        $query->bindParam(':hideoutType', $hideoutType, $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($id_hideoutType, $hideoutType): void {
        $query = $this->pdo->prepare(
            "UPDATE hideoutType
                SET hideoutType = :hideoutType
                WHERE id_hideoutType = :id_hideoutType");
        $query->bindParam(':hideoutType', $hideoutType, $this->pdo::PARAM_STR);
        $query->bindParam(':id_hideoutType', $id_hideoutType, $this->pdo::PARAM_INT);
        $query->execute();
    }

    public function delete($id_hideoutType): void {
        $query = $this->pdo->prepare(
            "DELETE FROM hideoutType
                WHERE id_hideoutType = :id_hideoutType");
        $query->bindParam(':id_hideoutType', $id_hideoutType, $this->pdo::PARAM_INT);
        $query->execute();
    }
}