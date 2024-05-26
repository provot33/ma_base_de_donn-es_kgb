<?php
namespace App\Entity;

class MissionType
{
    protected int $idType;
    protected string $typeName;

    public function __construct($idType, $typeName)
    {
        $this->idType = $idType;
        $this->typeName = $typeName;
    }

    /**
     * Get the value of typeName
     */
    public function getIdType()
    {
        return $this->idType;
    }

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
