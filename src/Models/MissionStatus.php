<?php

namespace App\Models;

use App\Exceptions\QueryException;

class MissionStatus extends Database
{
    private ?int $id;
    private ?string $name;

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM mission_status ORDER BY id';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function getStatus($id): array
    {
        $query = 'SELECT * FROM mission_status WHERE id = :id';
        $params = ['id' => $id];
        return $this->fetchData($query, $params);
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}