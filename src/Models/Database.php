<?php

namespace App\Models;

use App\Exceptions\QueryException;
use PDO;

class Database
{
    protected function connect(): PDO
    {
        try {
            $username = 'root';
            $password = '';
            $host = 'localhost';
            $db = 'spy_site';
            $pdo = new PDO('mysql:host='.$host.';dbname='.$db, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }

    /**
     * @throws QueryException
     */
    protected function fetchData(string $query, array $bindParams): array
    {
        $statement = $this->connect()->prepare($query);
        if (!$statement->execute($bindParams)) {
            $statement = null;
            $message = 'La requête a échoué';
            throw new QueryException($message);
        }
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($data === false) {
            $statement = null;
            $message = 'La requête ne retourne aucun résultat';
            throw new QueryException($message);
        }
        $statement = null;
        return $data;
    }

    /**
     * @throws QueryException
     */
    protected function fetchAllData(string $query, array $bindParams): array
    {
        $statement = $this->connect()->prepare($query);
        if (!$statement->execute($bindParams)) {
            $statement = null;
            $message = 'La requête a échoué';
            throw new QueryException($message);
        }
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if (count($data) === 0) {
            $statement = null;
            $message = 'La requête ne retourne aucun résultat';
            throw new QueryException($message);
        }
        $statement = null;
        return $data;
    }

    /**
     * @throws QueryException
     */
    protected function dbQuery(string $query, array $bindParams): void
    {
        $statement = $this->connect()->prepare($query);
        if (!$statement->execute($bindParams)) {
            $statement = null;
            $message = 'La requête a échoué';
            throw new QueryException($message);
        }
        $statement = null;
    }

    protected function queryLastInsertedId(string $query, array $bindParams): string
    {
        $dbh = $this->connect();
        $statement = $dbh->prepare($query);

        try{
            $dbh->beginTransaction();
            $statement->execute($bindParams);
            $insertedId = $dbh->lastInsertId();
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollBack();
            throw new \PDOException();
        }
        $statement = null;
        return $insertedId;
    }
}