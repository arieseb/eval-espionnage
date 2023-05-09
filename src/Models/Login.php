<?php

namespace App\Models;

use App\Exceptions\LoginException;

class Login extends Database
{
    /**
     * @throws LoginException
     */
    protected function login($email, $password): void
    {
        $statement = $this->connect()->prepare('SELECT password FROM admin WHERE email = :email');

        if(!$statement->execute(['email' => $email])) {
            $statement = null;
            $message = 'La requête a échoué';
            throw new LoginException($email, $message);
        }

        $hashedPassword = $statement->fetch(\PDO::FETCH_ASSOC);
        if($hashedPassword === false) {
            $statement = null;
            $message = 'Aucun compte ne correspond à cette adresse';
            throw new LoginException($email, $message);
        }

        $checkPassword = password_verify($password, $hashedPassword['password']);
        if($checkPassword === false) {
            $statement = null;
            $message = 'Mot de passe incorrect';
            throw new LoginException($email, $message);
        } else {
            $statement = $this->connect()->prepare('SELECT * FROM admin WHERE email = :email');
            if(!$statement->execute(['email' => $email])) {
                $statement = null;
                $message = 'La requête a échoué';
                throw new LoginException($email, $message);
            }

            $data = $statement->fetch(\PDO::FETCH_ASSOC);
            if(count($data) === 0) {
                $statement = null;
                $message = 'Aucun compte ne correspond à cette adresse';
                throw new LoginException($email, $message);
            }

            session_start();
            $_SESSION['email'] = $data['email'];
            $_SESSION['firstname'] = $data['firstname'];
            $_SESSION['lastname'] = $data['lastname'];
            $_SESSION['role'] = $data['role'];
            header('location: dashboard');

            $statement = null;
        }
    }
}