<?php

namespace App\Repository;
use App\Entity\Speciality;

class SpecialityRepository extends Repository
{
    public function getAll(): array {
        $query = $this->pdo->prepare(
            "SELECT * FROM speciality s");
        $query->execute();
        $specialities = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $specialitiesArray = [];

        if ($specialities) {              
            foreach ($specialities as $speciality) {
                $specialitiesArray[] = new Speciality($speciality['id_speciality'], $speciality['labelOfSpeciality']);
            }
        }

        return $specialitiesArray;
    }

    public function findAllByKgbAgentId(int $id_kgb_agent): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM speciality s
                JOIN agentSpeciality a ON a.id_speciality = s.id_speciality
                WHERE a.id_kgb_agent = :id_kgb_agent
                ORDER BY labelOfSpeciality ASC");
        $query->bindParam(':id_kgb_agent', $id_kgb_agent, $this->pdo::PARAM_STR);
        $query->execute();
        $specialities = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $specialitiesArray = [];

        if ($specialities) {
            foreach ($specialities as $speciality) {
                $specialitiesArray[] = new Speciality($speciality['id_speciality'], $speciality['labelOfSpeciality']);
            }
        }

        return $specialitiesArray;
    }

    public function insert($labelOfSpeciality): void {
        $query = $this->pdo->prepare(
            "INSERT INTO speciality
                (labelOfSpeciality)
                VALUES
                (:labelOfSpeciality)");
        $query->bindParam(':labelOfSpeciality', $labelOfSpeciality, $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($id_speciality, $labelOfSpeciality): void {
        $query = $this->pdo->prepare(
            "UPDATE speciality
                SET labelOfSpeciality = :labelOfSpeciality
                WHERE id_speciality = :id_speciality");
        $query->bindParam(':labelOfSpeciality', $labelOfSpeciality, $this->pdo::PARAM_STR);
        $query->bindParam(':id_speciality', $id_speciality, $this->pdo::PARAM_INT);
        $query->execute();
    }

    public function delete($id_speciality): void {
        $query = $this->pdo->prepare(
            "DELETE FROM speciality
                WHERE id_speciality = :id_speciality");
        $query->bindParam(':id_speciality', $id_speciality, $this->pdo::PARAM_INT);
        $query->execute();
    }
}