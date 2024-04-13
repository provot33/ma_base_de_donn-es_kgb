<?php
namespace App\Entity;

class Nationality
{
    protected string $country;

    public function __construct($country)
    {
        $this->country = $country;
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

