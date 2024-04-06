<?php

namespace App\Repository;

use App\Entity\Hideout;
use App\Entity\Mission;
use App\Entity\MissionStatus;
use App\Entity\MissionType;
use App\Entity\Nationality;
use App\Entity\Speciality;
use DateTime;

class MissionRepository extends Repository
{
    public function getAll(): array
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM mission m
                JOIN speciality s ON s.id_speciality = m.id_speciality
                JOIN nationality n ON n.id_nationality = m.id_nationality
                JOIN missionType mt ON mt.id_type = m.id_type
                JOIN missionStatus ms ON ms.id_status = m.id_status");
        //$query->bindParam(':movie_id', $movie_id, $this->pdo::PARAM_STR);
        $query->execute();
        $missions = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $missionsArray = [];

        if ($missions) {
            foreach ($missions as $mission) {
                $kgbAgentRepository = new KgbAgentRepository();
                $kgbAgentsArray = $kgbAgentRepository->findAllByMissionId($mission['id_mission']);
                $targetRepository = new TargetRepository();
                $targetsArray = $targetRepository->findAllByMissionId($mission['id_mission']);
                $contactRepository = new ContactRepository();
                $contactsArray = $contactRepository->findAllByMissionId($mission['id_mission']);
                $hideoutRepository = new HideoutRepository();
                $hideoutsArray = $hideoutRepository->findAllByMissionId($mission['id_mission']);
                $missionToAdd = new Mission($mission['title'], $mission['description'], $mission['codeName'],
                    new DateTime($mission['startDate']), new DateTime($mission['finishDate']),
                    new Speciality($mission['labelOfSpeciality']),
                    new Nationality($mission['country']), new MissionType($mission['typeName']),
                    new MissionStatus($mission['statusName']));
                $missionToAdd->setKgbAgents($kgbAgentsArray);
                $missionToAdd->setTargets($targetsArray);
                $missionToAdd->setContacts($contactsArray);
                $missionToAdd->setHideouts($hideoutsArray);
                $missionsArray[] = $missionToAdd;
            }
        }

        return $missionsArray;
    }
}
