<?php
namespace kgbAgent;

use DateTime;
use nationality\Nationality;
use speciality\Speciality;

class KgbAgent
{
    protected string $name;
    protected string $firstName;
    protected DateTime $dateOfBirth;
    protected string $identificationCode;
    protected Nationality $nationality;
    protected array $speciality;

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
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set the value of speciality
     *
     * @return  self
     */ 
    public function setSpeciality(array $speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Add one Speciality to the agent's specialities
     *
     * @return  self
     */ 
    public function addSpeciality(Speciality $speciality)
    {
        $this->speciality[] = $speciality;

        return $this;
    }
};

$myKgbAgent = new KgbAgent();
