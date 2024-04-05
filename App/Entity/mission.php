<?php
namespace mission;

use contact\Contact;
use DateTime;
use hideout\Hideout;
use kgbAgent\KgbAgent;
use nationality\Nationality;
use speciality\Speciality;
use target\Target;

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
    protected array $kgbAgent;
    protected array $contact;
    protected array $target;
    protected array $hideout;

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
    public function getKgbAgent()
    {
        return $this->kgbAgent;
    }

    /**
     * Set the value of kgbAgent
     *
     * @return  self
     */ 
    public function setKgbAgent($kgbAgent)
    {
        $this->kgbAgent = $kgbAgent;

        return $this;
    }

    /**
     * Add one agent to the mission's agents
     *
     * @return  self
     */ 
    public function addKgbAgent(KgbAgent $kgbAgent)
    {
        $this->kgbAgent[] = $kgbAgent;

        return $this;
    }

    /**
     * Get the value of contact
     * 
     * @return array
     */ 
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set the value of contact
     *
     * @return  self
     */ 
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Add one contact to the mission's contacts
     *
     * @return  self
     */ 
    public function addContact(Contact $contact)
    {
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * Get the value of target
     * 
     * @return array
     */ 
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set the value of target
     *
     * @return  self
     */ 
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Add one contact to the mission's contacts
     *
     * @return  self
     */ 
    public function addTarget(Target $target)
    {
        $this->target[] = $target;

        return $this;
    }

    /**
     * Get the value of hideout
     */ 
    public function getHideout()
    {
        return $this->hideout;
    }

    /**
     * Set the value of hideout
     *
     * @return  self
     */ 
    public function setHideout($hideout)
    {
        $this->hideout = $hideout;

        return $this;
    }

    /**
     * Add one hideout to the mission's hideouts
     *
     * @return  self
     */ 
    public function addHideout(Hideout $hideout)
    {
        $this->hideout[] = $hideout;

        return $this;
    }
};

class MissionStatus
{
    protected string $statutName;

    /**
     * Get the value of statutName
     */
    public function getStatutName()
    {
        return $this->statutName;
    }

    /**
     * Set the value of statutName
     *
     * @return  self
     */
    public function setStatutName($statutName)
    {
        $this->statutName = $statutName;

        return $this;
    }
};

class MissionType
{
    protected string $typeName;

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

$myMission = new Mission();
$myMissionStatus = new MissionStatus();
$myMissionType = new MissionType();
