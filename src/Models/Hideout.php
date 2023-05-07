<?php

namespace App\Models;

use App\Exceptions\QueryException;

class Hideout extends Database
{
    private ?int $id;
    private ?string $code;
    private ?string $address;
    private ?string $type;
    private ?int $country_id;

    /**
     * @throws QueryException
     */
    protected function add($code, $address, $type, $country_id)
    {
        $query = 'INSERT INTO hideout (code, address, type, country_id) VALUES (:code, :address, :type, :country_id)';
        $params = ['code' => $code, 'address' => $address, 'type' => $type, 'country_id' => $country_id];
        $this->dbQuery($query, $params);
        header('location: hideout-manage');
    }

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM hideout ORDER BY country_id';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function getHideout($id): array
    {
        $query = 'SELECT * FROM hideout WHERE id = :id';
        $params = ['id' => $id];
        return $this->fetchData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function update($id, $code, $address, $type, $country_id)
    {
        $query = '
            UPDATE hideout SET 
                code = :code, 
                address = :address,
                type = :type,
                country_id = :country_id
            WHERE
                id = :id
        ';
        $params = [
            'id' => $id,
            'code' => $code,
            'address' => $address,
            'type' => $type,
            'country_id' => $country_id
        ];
        $this->dbQuery($query, $params);
        header('location: hideout-manage');
    }

    /**
     * @throws QueryException
     */
    public function delete($id)
    {
        $query = 'DELETE FROM hideout WHERE id = :id';
        $params = ['id' => $id];
        $this->dbQuery($query, $params);
        header('location: hideout-manage');
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    /**
     * @param int|null $country_id
     */
    public function setCountryId(?int $country_id): void
    {
        $this->country_id = $country_id;
    }

}