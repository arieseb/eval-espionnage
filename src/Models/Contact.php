<?php

namespace App\Models;

use App\Exceptions\QueryException;

class Contact extends Database
{
    private ?int $id;
    private ?string $codename;
    private ?string $firstname;
    private ?string $lastname;
    private ?\DateTimeInterface $birthdate;

    private ?int $country_id;

    /**
     * @throws QueryException
     */
    protected function add($codename, $firstname, $lastname, $birthdate, $country_id)
    {
        $query = '
            INSERT INTO 
                contact (codename, firstname, lastname,birthdate, country_id) 
            VALUES 
                (:codename, :firstname, :lastname, :birthdate, :country_id)
        ';
        $params = [
            'codename' => $codename,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthdate' => $birthdate,
            'country_id' => $country_id
        ];
        $this->dbQuery($query, $params);
        header('location: contact-manage');
    }

    /**
     * @throws QueryException
     */
    public function readAll(): bool|array
    {
        $query = 'SELECT * FROM contact ORDER BY codename';
        $params = [];
        return $this->fetchAllData($query, $params);
    }

    /**
     * @throws QueryException
     */
    public function update($id, $codename, $firstname, $lastname, $birthdate, $country_id)
    {
        $query = '
            UPDATE contact SET 
                codename = :codename, 
                firstname = :firstname,
                lastname = :lastname,
                birthdate = :birthdate,
                country_id = :country_id
            WHERE
                id = :id
            ';
        $params = [
            'id' => $id,
            'codename' => $codename,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthdate' => $birthdate,
            'country_id' => $country_id
        ];
        $this->dbQuery($query, $params);
        header('location: contact-manage');
    }

    /**
     * @throws QueryException
     */
    public function delete($id)
    {
        $query = 'DELETE FROM contact WHERE id = :id';
        $params = ['id' => $id];
        $this->dbQuery($query, $params);
        header('location: contact-manage');
    }

    /**
     * @throws QueryException
     */
    public function getContact($id): array
    {
        $query = 'SELECT * FROM contact WHERE id = :id';
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
    public function getCodename(): ?string
    {
        return $this->codename;
    }

    /**
     * @param string|null $codename
     */
    public function setCodename(?string $codename): void
    {
        $this->codename = $codename;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTimeInterface|null $birthdate
     */
    public function setBirthdate(?\DateTimeInterface $birthdate): void
    {
        $this->birthdate = $birthdate;
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