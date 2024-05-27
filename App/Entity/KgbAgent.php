<?php
namespace App\Entity;

use App\Entity\Nationality;
use App\Entity\Speciality;
use DateTime;

class KgbAgent
{
    protected int $idAgent;
    protected string $name;
    protected string $firstName;
    protected DateTime $dateOfBirth;
    protected string $identificationCode;
    protected Nationality $nationality;
    protected array $specialities;

    public function __construct($idAgent, $name,
        $firstName, $dateOfBirth, $identificationCode, $nationality, $specialities) {
        $this->idAgent = $idAgent;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->dateOfBirth = $dateOfBirth;
        $this->identificationCode = $identificationCode;
        $this->nationality = $nationality;
        $this->specialities = $specialities;
    }

    /**
     * Get the value of name
     */
    public function getIdAgent()
    {
        return $this->idAgent;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of dateOfBirth
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the value of dateOfBirth
     *
     * @return  self
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get the value of identificationCode
     */
    public function getIdentificationCode()
    {
        return $this->identificationCode;
    }

    /**
     * Set the value of identificationCode
     *
     * @return  self
     */
    public function setIdentificationCode($identificationCode)
    {
        $this->identificationCode = $identificationCode;

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
     * Get the value of speciality,
     *
     * @return  array
     */
    public function getSpecialities()
    {
        return $this->specialities;
    }

    /**
     * Set the value of speciality
     *
     * @return  self
     */
    public function setSpecialities(array $specialities)
    {
        $this->specialities = $specialities;

        return $this;
    }

    /**
     * Add one Speciality to the agent's specialities
     *
     * @return  self
     */
    public function addSpeciality(Speciality $speciality)
    {
        $this->specialities[] = $speciality;

        return $this;
    }
};
