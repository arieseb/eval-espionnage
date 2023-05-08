<?php

namespace App\Models;

use App\Exceptions\QueryException;

class Specialty extends Database
{
    private ?int $id;
    private ?string $name;

    /**
     * @throws QueryException
     */
    protected function add($name)
    {
        $query = 'INSERT INTO specialty (name) VALUES (:name)';
        $params = ['name' => $name];
        $this->dbQuery($query, $params);
        header('location: agent-manage');
    }

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM specialty ORDER BY name';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function delete($id)
    {
        $query = 'DELETE FROM specialty WHERE id = :id';
        $params = ['id' => $id];
        $this->dbQuery($query, $params);
        header('location: agent-manage');
    }
    /**
     * @throws QueryException
     */
    public function getSpecialty($id): array
    {
        $query = 'SELECT * FROM specialty WHERE id = :id';
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