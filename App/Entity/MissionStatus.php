<?php
namespace App\Entity;

class MissionStatus
{
    protected string $statusName;

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

