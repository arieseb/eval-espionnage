<?php

namespace App\Models;

use App\Exceptions\QueryException;

class MissionTarget extends Database
{
    private ?int $id;
    private ?int $target_id;
    private ?int $mission_id;

    /**
     * @throws QueryException
     */
    public function getMissionTarget($mission_id): array
    {
        $query = 'SELECT * FROM mission_target WHERE mission_id = :mission_id';
        $params = ['mission_id' => $mission_id];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getTargetId(): ?int
    {
        return $this->target_id;
    }

    /**
     * @param int|null $target_id
     */
    public function setTargetId(?int $target_id): void
    {
        $this->target_id = $target_id;
    }

    /**
     * @return int|null
     */
    public function getMissionId(): ?int
    {
        return $this->mission_id;
    }

    /**
     * @param int|null $mission_id
     */
    public function setMissionId(?int $mission_id): void
    {
        $this->mission_id = $mission_id;
    }

}