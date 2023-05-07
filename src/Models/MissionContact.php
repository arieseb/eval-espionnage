<?php

namespace App\Models;

use App\Exceptions\QueryException;

class MissionContact extends Database
{
    private ?int $id;
    private ?int $contact_id;
    private ?int $mission_id;

    /**
     * @throws QueryException
     */
    public function getMissionContact($mission_id): array
    {
        $query = 'SELECT * FROM mission_contact WHERE mission_id = :mission_id';
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
    public function getContactId(): ?int
    {
        return $this->contact_id;
    }

    /**
     * @param int|null $contact_id
     */
    public function setContactId(?int $contact_id): void
    {
        $this->contact_id = $contact_id;
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