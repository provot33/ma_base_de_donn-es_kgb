<?php
namespace App\Entity;

use App\Entity\Contact;
use App\Entity\Hideout;
use App\Entity\KgbAgent;
use App\Entity\Nationality;
use App\Entity\Speciality;
use App\Entity\Target;
use DateTime;

class Mission
{
    protected string $title;
    protected string $description;
    protected string $codeName;
    protected DateTime $startDate;
    protected DateTime $finishDate;
    protected Speciality $speciality;
    protected Nationality $nationality;
    protected MissionType $missionType;
    protected MissionStatus $missionStatus;
    protected array $kgbAgents;
    protected array $contacts;
    protected array $targets;
    protected array $hideouts;

    public function __construct($title, $description, $codeName,
        $startDate, $finishDate, $speciality, $nationality, $missionType, $missionStatus) {
        $this->title = $title;
        $this->description = $description;
        $this->codeName = $codeName;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
        $this->speciality = $speciality;
        $this->nationality = $nationality;
        $this->missionType = $missionType;
        $this->missionStatus = $missionStatus;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of codeName
     */
    public function getCodeName()
    {
        return $this->codeName;
    }

    /**
     * Set the value of codeName
     *
     * @return  self
     */
    public function setCodeName($codeName)
    {
        $this->codeName = $codeName;

        return $this;
    }

    /**
     * Get the value of startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of finishDate
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * Set the value of finishDate
     *
     * @return  self
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * Get the value of speciality
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set the value of speciality
     *
     * @return  self
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get the value of nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @return  self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get the value of missionType
     */
    public function getMissionType()
    {
        return $this->missionType;
    }

    /**
     * Set the value of missionType
     *
     * @return  self
     */
    public function setMissionType($missionType)
    {
        $this->missionType = $missionType;

        return $this;
    }

    /**
     * Get the value of missionStatus
     */
    public function getMissionStatus()
    {
        return $this->missionStatus;
    }

    /**
     * Set the value of missionStatus
     *
     * @return  self
     */
    public function setMissionStatus($missionStatus)
    {
        $this->missionStatus = $missionStatus;

        return $this;
    }

    /**
     * Get the value of kgbAgent
     *
     * @return array
     */
    public function getKgbAgents()
    {
        return $this->kgbAgents;
    }

    /**
     * Set the value of kgbAgent
     *
     * @return  self
     */
    public function setKgbAgents($kgbAgents)
    {
        $this->kgbAgents = $kgbAgents;

        return $this;
    }

    /**
     * Add one agent to the mission's agents
     *
     * @return  self
     */
    public function addKgbAgent(KgbAgent $kgbAgent)
    {
        $this->kgbAgents[] = $kgbAgent;

        return $this;
    }

    /**
     * Get the value of contact
     *
     * @return array
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set the value of contact
     *
     * @return  self
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Add one contact to the mission's contacts
     *
     * @return  self
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Get the value of target
     *
     * @return array
     */
    public function getTargets()
    {
        return $this->targets;
    }

    /**
     * Set the value of target
     *
     * @return  self
     */
    public function setTargets($targets)
    {
        $this->targets = $targets;

        return $this;
    }

    /**
     * Add one contact to the mission's contacts
     *
     * @return  self
     */
    public function addTarget(Target $target)
    {
        $this->targets[] = $target;

        return $this;
    }

    /**
     * Get the value of hideout
     */
    public function getHideouts()
    {
        return $this->hideouts;
    }

    /**
     * Set the value of hideout
     *
     * @return  self
     */
    public function setHideouts($hideouts)
    {
        $this->hideouts = $hideouts;

        return $this;
    }

    /**
     * Add one hideout to the mission's hideouts
     *
     * @return  self
     */
    public function addHideout(Hideout $hideout)
    {
        $this->hideouts[] = $hideout;

        return $this;
    }
};

class MissionStatus
{
    protected string $statusName;

    public function __contruct($statusName)
    {
        $this->statusName = $statusName;
    }

    /**
     * Get the value of statutName
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Set the value of statutName
     *
     * @return  self
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }
};

class MissionType
{
    protected string $typeName;

    public function __contruct($typeName)
    {
        $this->typeName = $typeName;
    }
    /**
     * Get the value of typeName
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Set the value of typeName
     *
     * @return  self
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }
};
