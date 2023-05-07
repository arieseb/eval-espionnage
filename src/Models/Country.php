<?php

namespace App\Models;

use App\Exceptions\QueryException;

class Country extends Database
{
    private ?int $id;
    private ?string $name;
    private ?string $nationality;


    /**
     * @throws QueryException
     */
    protected function add($name, $nationality)
    {
        $query = 'INSERT INTO country (name, nationality) VALUES (:name, :nationality)';
        $params = ['name' => $name, 'nationality' => $nationality];
        $this->dbQuery($query, $params);
        header('location: dashboard');
    }

    /**
     * @throws QueryException
     */
    public function delete($id)
    {
        $query = 'DELETE FROM country WHERE id = :id';
        $params = ['id' => $id];
        $this->dbQuery($query, $params);
        header('location: dashboard');
    }

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM country ORDER BY name';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function update($id, $name, $nationality)
    {
        $query = 'UPDATE country SET name = :name, nationality = :nationality WHERE id = :id';
        $params = ['id' => $id, 'name' => $name, 'nationality' => $nationality];
        $this->dbQuery($query, $params);
        header('location: dashboard');
    }

    /**
     * @throws QueryException
     */
    public function getCountry($id): array
    {
        $query = 'SELECT * FROM country WHERE id = :id';
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

    /**
     * @return string|null
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @param string|null $nationality
     */
    public function setNationality(?string $nationality): void
    {
        $this->nationality = $nationality;
    }
}