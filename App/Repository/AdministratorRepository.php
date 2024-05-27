<?php

namespace App\Repository;

use App\Entity\Administrator;
use DateTime;

class AdministratorRepository extends Repository
{
    public function getAll() {
        $query = $this->pdo->prepare(
            "SELECT * FROM administrator a");
        $query->execute();
        $administrators = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $administratorArray = [];

        if ($administrators) {              
            foreach ($administrators as $administrator) {
                $administratorArray[] = new Administrator($administrator['id_administrator'], $administrator['name'], 
                    $administrator['firstname'], $administrator['email'], $administrator['password'], new DateTime($administrator['creationDate']));
            }
        }

        return $administratorArray;
    }

    public function findOneByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM administrator WHERE email = :email");
        $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
        $query->execute();
        $administrator = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($administrator) {
            return new Administrator($administrator['id_administrator'], $administrator['name'], $administrator['firstname'],
            $administrator['email'], $administrator['password'], 
            new DateTime($administrator['creationDate']));
        } else {
            return null;
        }
    }

    /**
     * Fonction de vérification du mot de passe
     * 
     * On doit vérifier le mot de passe encrypté en utilisant la même fonction
     * que celle utilisé à l'insertion en base, donc la fonction de la base de données.
     * 
     * @param userPassword le mot de passe rentré par l'utilisateur.
     * @param dbPassword le mot de passe en base qui sert de référence.
     * 
     * @return true si l'encryption du userPassword correspond au dbPassword, false sinon.
     */
    public function verifyPassword(string $userPassword, string $dbPassword)
    {
        $requete ="SELECT PASSWORD('".$userPassword."') AS PASSCRYPT";
        $passEncrypt = $this->pdo->query($requete)->fetch()['PASSCRYPT'];
        return $dbPassword == $passEncrypt;
    }
};