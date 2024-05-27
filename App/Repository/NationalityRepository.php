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
}