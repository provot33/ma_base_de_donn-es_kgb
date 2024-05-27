<?php
namespace App\Entity;

class HideoutType
{
    protected int $idHideoutType;
    protected string $hideoutType;

    public function __construct($idHideoutType, $hideoutType)
    {
        $this->idHideoutType = $idHideoutType;
        $this->hideoutType = $hideoutType;
    }
    
    /**
     * Get the value of typeName
     */
    public function getIdHideoutType()
    {
        return $this->idHideoutType;
    }

    /**
     * Get the value of typeName
     */
    public function getHideoutType()
    {
        return $this->hideoutType;
    }

    /**
     * Set the value of typeName
     *
     * @return  self
     */
    public function setHideoutType($hideoutType)
    {
        $this->hideoutType = $hideoutType;

        return $this;
    }
}
