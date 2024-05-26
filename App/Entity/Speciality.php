<?php
namespace App\Entity;

class Speciality
{
    protected string $idSpeciality;
    protected string $labelOfSpeciality;

    public function __construct($idSpeciality, $labelOfSpeciality)
    {
        $this->idSpeciality = $idSpeciality;
        $this->labelOfSpeciality = $labelOfSpeciality;
    }

    /**
     * Get the value of labelOfSpeciality
     */
    public function getIdSpeciality()
    {
        return $this->idSpeciality;
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
