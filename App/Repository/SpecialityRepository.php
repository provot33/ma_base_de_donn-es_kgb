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
}