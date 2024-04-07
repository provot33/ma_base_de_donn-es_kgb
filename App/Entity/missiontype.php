<?php
namespace App\Entity;

class MissionType
{
    protected string $typeName;

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
