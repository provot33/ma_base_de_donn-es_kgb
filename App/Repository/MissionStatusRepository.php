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

    public function insert($statusName): void {
        $query = $this->pdo->prepare(
            "INSERT INTO missionStatus
                (statusName)
                VALUES
                (:statusName)");
        $query->bindParam(':statusName', $statusName, $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($id_status, $statusName): void {
        $query = $this->pdo->prepare(
            "UPDATE missionStatus
                SET statusName = :statusName
                WHERE id_status = :id_status");
        $query->bindParam(':typeName', $statusName, $this->pdo::PARAM_STR);
        $query->bindParam(':id_status', $id_status, $this->pdo::PARAM_INT);
        $query->execute();
    }

    public function delete($id_status): void {
        $query = $this->pdo->prepare(
            "DELETE FROM missionStatus
                WHERE id_status = :id_status");
        $query->bindParam(':id_status', $id_status, $this->pdo::PARAM_INT);
        $query->execute();
    }
}