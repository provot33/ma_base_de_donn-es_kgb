<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Entity\Nationality;
use DateTime;

class ContactRepository extends Repository
{
    public function getAll(): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM contact c
                JOIN nationality n ON n.id_nationality = c.id_nationality");
        $query->execute();
        $contacts = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $contactsArray = [];

        if ($contacts) {              
            foreach ($contacts as $contact) {
                $contactsArray[] = new Contact($contact['id_contact'], $contact['name'], $contact['firstname'],
                new DateTime($contact['dateOfBirth']), $contact['codeName'], 
                new Nationality($contact['id_nationality'], $contact['country']));
            }
        }

        return $contactsArray;
    }

    public function findAllByMissionId(int $id_mission): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM contact c
                JOIN missionWithContact mwc ON mwc.id_contact = c.id_contact
                JOIN nationality n ON n.id_nationality = c.id_nationality
                WHERE mwc.id_mission = :id_mission
                ORDER BY c.name, c.firstName, c.codeName ASC");
        $query->bindParam(':id_mission', $id_mission, $this->pdo::PARAM_STR);
        $query->execute();
        $contacts = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $contactsArray = [];

        if ($contacts) {
            foreach ($contacts as $contact) {
                $contactsArray[] = new Contact($contact['id_contact'], $contact['name'], $contact['firstname'],
                    new DateTime($contact['dateOfBirth']), $contact['codeName'], 
                    new Nationality($contact['id_nationality'], $contact['country']));
            }
        }

        return $contactsArray;
    }
}