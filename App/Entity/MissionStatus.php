<?php
namespace App\Entity;

class MissionStatus
{
    protected int $idStatus;
    protected string $statusName;

    public function __construct($idStatus, $statusName)
    {
        $this->idStatus = $idStatus;
        $this->statusName = $statusName;
    }

    /**
     * Get the value of typeName
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Get the value of statutName
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Set the value of statutName
     *
     * @return  self
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }
};

