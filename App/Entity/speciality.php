<?php
namespace App\Entity;

class Speciality
{
    protected string $labelOfSpeciality;

    public function __construct($labelOfSpeciality)
    {
        $this->labelOfSpeciality = $labelOfSpeciality;
    }

    /**
     * Get the value of labelOfSpeciality
     */
    public function getLabelOfSpeciality()
    {
        return $this->labelOfSpeciality;
    }

    /**
     * Set the value of labelOfSpeciality
     *
     * @return  self
     */
    public function setLabelOfSpeciality($labelOfSpeciality)
    {
        $this->labelOfSpeciality = $labelOfSpeciality;

        return $this;
    }
};
