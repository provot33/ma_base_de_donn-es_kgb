<?php

namespace App\Repository;

use App\Entity\Nationality;

class NationalityRepository extends Repository
{
    public function getAll(): array {
        $query = $this->pdo->prepare(
            "SELECT * FROM nationality n");
        $query->execute();
        $nationalities = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $nationalitiesArray = [];

        if ($nationalities) {              
            foreach ($nationalities as $nationality) {
                $nationalitiesArray[] = new Nationality($nationality['id_nationality'], $nationality['country']);
            }
        }

        return $nationalitiesArray;
    }

    public function insert($country): void {
        $query = $this->pdo->prepare(
            "INSERT INTO nationality
                (country)
                VALUES
                (:country)");
        $query->bindParam(':country', $country, $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($id_nationality, $country): void {
        $query = $this->pdo->prepare(
            "UPDATE nationality
                SET country = :country
                WHERE id_nationality = :id_nationality");
        $query->bindParam(':country', $country, $this->pdo::PARAM_STR);
        $query->bindParam(':id_nationality', $id_nationality, $this->pdo::PARAM_INT);
        $query->execute();
    }

    public function delete($id_nationality): void {
        $query = $this->pdo->prepare(
            "DELETE FROM nationality
                WHERE id_nationality = :id_nationality");
        $query->bindParam(':id_nationality', $id_nationality, $this->pdo::PARAM_INT);
        $query->execute();
    }
}