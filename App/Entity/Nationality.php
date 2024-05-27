<?php
namespace App\Entity;

class Nationality
{
    protected int $idNationality;
    protected string $country;

    public function __construct($idNationality, $country)
    {
        $this->idNationality = $idNationality;
        $this->country = $country;
    }

    /**
     * Get the value of typeName
     */
    public function getIdNationality()
    {
        return $this->idNationality;
    }
    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
};

