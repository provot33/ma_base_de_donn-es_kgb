<?php

namespace App\Repository;

use App\Entity\Administrator;
use DateTime;

class AdministratorRepository extends Repository
{
    public function findOneByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM administrator WHERE email = :email");
        $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
        $query->execute();
        $administrator = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($administrator) {
            return new Administrator($administrator['name'], $administrator['firstname'],
            $administrator['email'], $administrator['password'], 
            new DateTime($administrator['creationDate']));
        } else {
            return null;
        }
    }
};