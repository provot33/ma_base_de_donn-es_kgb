<?php
namespace App\Entity;

use App\Entity\Nationality;
use DateTime;

class Contact
{
    protected string $name;
    protected string $firstName;
    protected DateTime $dateOfBirth;
    protected string $codeName;
    protected Nationality $nationality;

    public function __construct(
        $name, $firstName, $dateOfBirth, $codeName, $nationality
    ) {
        $this->name = $name;
        $this->name = $firstName;
        $this->name = $dateOfBirth;
        $this->name = $codeName;
        $this->name = $nationality;
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
     * Get the value of nationalite
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationalite
     *
     * @return  self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }
};
