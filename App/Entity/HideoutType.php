<?php
namespace App\Entity;

class typeName
{
    protected int $idHideoutType;
    protected string $hideoutYpe;

    public function __construct($idHideoutType, $hideoutYpe)
    {
        $this->idHideoutType = $idHideoutType;
        $this->hideoutYpe = $hideoutYpe;
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
    public function getHideoutYpe()
    {
        return $this->hideoutYpe;
    }

    /**
     * Set the value of typeName
     *
     * @return  self
     */
    public function setHideoutYpe($hideoutYpe)
    {
        $this->hideoutYpe = $hideoutYpe;

        return $this;
    }
}
