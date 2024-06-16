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

    public function insert($typeName): void {
        $query = $this->pdo->prepare(
            "INSERT INTO missionType
                (typeName)
                VALUES
                (:typeName)");
        $query->bindParam(':typeName', $typeName, $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($id_type, $typeName): void {
        $query = $this->pdo->prepare(
            "UPDATE missionType
                SET typeName = :typeName
                WHERE id_type = :id_type");
        $query->bindParam(':typeName', $typeName, $this->pdo::PARAM_STR);
        $query->bindParam(':id_type', $id_type, $this->pdo::PARAM_INT);
        $query->execute();
    }

    public function delete($id_type): void {
        $query = $this->pdo->prepare(
            "DELETE FROM missionType
                WHERE id_type = :id_type");
        $query->bindParam(':id_type', $id_type, $this->pdo::PARAM_INT);
        $query->execute();
    }

    // public function find($id_type): MissionType {
    //     $query = $this->pdo->prepare(
    //         "SELECT * FROM missionType mt
    //             WHERE mt.id_type = :id_type");
    //     $query->bindParam(':id_type', $id_type, $this->pdo::PARAM_INT);
    //     $query->execute();
    //     $record = $query->fetch($this->pdo::FETCH_ASSOC);

    //     $missionType = null;

    //     if ($record) {              
    //         $missionType = new MissionType($record['id_type'], $record['typeName']);
    //     }

    //     return $missionType;
    // }

}