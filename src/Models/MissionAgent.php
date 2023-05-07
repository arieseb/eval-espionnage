<?php

namespace App\Models;

use App\Exceptions\QueryException;

class MissionAgent extends Database
{
    private ?int $id;
    private ?int $agent_id;
    private ?int $mission_id;

    /**
     * @throws QueryException
     */
    public function getMissionAgent($mission_id): array
    {
        $query = 'SELECT * FROM mission_agent WHERE mission_id = :mission_id';
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
    public function getAgentId(): ?int
    {
        return $this->agent_id;
    }

    /**
     * @param int|null $agent_id
     */
    public function setAgentId(?int $agent_id): void
    {
        $this->agent_id = $agent_id;
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