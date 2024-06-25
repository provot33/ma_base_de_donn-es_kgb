<?php

namespace App\Repository;

use App\Entity\Administrator;
use DateTime;
use Exception;

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

    public function insert($administrator): void {
        $query = $this->pdo->prepare(
            "INSERT INTO administrator
                (name, firstname, email, password, creationDate)
                VALUES
                (:name, :firstname, :email, PASSWORD(:password), :creationDate)");
        $query->bindParam(':name', $administrator['administratorName_'], $this->pdo::PARAM_STR);
        $query->bindParam(':firstname', $administrator['administratorFirstname_'], $this->pdo::PARAM_STR);
        $query->bindParam(':email', $administrator['administratorEmail_'], $this->pdo::PARAM_STR);
        $query->bindParam(':password', $administrator['administratorPwd_'], $this->pdo::PARAM_STR);
        $query->bindParam(':creationDate', $administrator['administratorDate_'], $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function update($administrator): void {
        // $detailTraitement = "";
        $updateName = (isset($administrator['administratorName_']));
        $updateFirstname = (isset($administrator['administratorFirstname_']));
        $updateEmail = (isset($administrator['administratorEmail_']));
        $updatePassword = (isset($administrator['administratorPwd_']));
        $updateCreationDate = (isset($administrator['administratorDate_']));

        $nbValues = 0;
        $setValues = "";
        if ($updateName) {
            $setValues.="name = :name";
            $nbValues++;
            // $detailTraitement .= "<br/>Prise en compte de name";
        }
        if ($updateFirstname) {
            if ($nbValues > 0) {
                $setValues.=", ";
            }
            $setValues.="firstname = :firstname";
            $nbValues++;
            // $detailTraitement .= "<br/>Prise en compte de firstname";
        }
        if ($updateEmail) {
            if ($nbValues > 0) {
                $setValues.=", ";
            }
            $setValues.="email = :email";
            $nbValues++;
            // $detailTraitement .= "<br/>Prise en compte de email";
        }
        if ($updatePassword) {
            if ($nbValues > 0) {
                $setValues.=", ";
            }
            $setValues.="password = PASSWORD(:password)";
            $nbValues++;
            // $detailTraitement .= "<br/>Prise en compte de password";
        }
        if ($updateCreationDate) {
            if ($nbValues > 0) {
                $setValues.=", ";
            }
            $setValues.="creationDate = :creationDate";
            $nbValues++;
            // $detailTraitement .= "<br/>Prise en compte de creationDate";
        }

        // $detailTraitement .= "<br/>L'Update devrait être :<br/>SET " . $setValues;

        $query = $this->pdo->prepare(
            "UPDATE administrator
                SET " . $setValues . "
                WHERE id_administrator = :id_administrator");
        if ($updateName) {
            $query->bindParam(':name', $administrator['administratorName_'], $this->pdo::PARAM_STR);
            // $detailTraitement .= "<br/>Binding de name";
        }
        if ($updateFirstname) {
            $query->bindParam(':firstname', $administrator['administratorFirstname_'], $this->pdo::PARAM_STR);
            // $detailTraitement .= "<br/>Binding de firstname";
        }
        if ($updateEmail) {
            $query->bindParam(':email', $administrator['administratorEmail_'], $this->pdo::PARAM_STR);
            // $detailTraitement .= "<br/>Binding de email";
        }
        if ($updatePassword) {
            $query->bindParam(':password', $administrator['administratorPwd_'], $this->pdo::PARAM_STR);
            // $detailTraitement .= "<br/>Binding de password";
        }
        if ($updateCreationDate) {
            $query->bindParam(':creationDate', $administrator['administratorDate_'], $this->pdo::PARAM_STR);
            // $detailTraitement .= "<br/>Binding de creationDate";
        }
        $query->bindParam(':id_administrator', $administrator['administratorId_'], $this->pdo::PARAM_INT);
        // $detailTraitement .= "<br/>Binding de Id";

        // throw new Exception($detailTraitement);
        $query->execute();
    }

    public function delete($id_administrator): void {
        $query = $this->pdo->prepare(
            "DELETE FROM administrator
                WHERE id_administrator = :id_administrator");
        $query->bindParam(':id_administrator', $id_administrator, $this->pdo::PARAM_INT);
        $query->execute();
    }
};