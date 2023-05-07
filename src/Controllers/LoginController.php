<?php

namespace App\Controllers;

use App\Exceptions\LoginException;
use App\Models\Login;

class LoginController extends Login
{
    private ?string $email;
    private ?string $password;

    public function __construct()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    public function logoutUser()
    {
        session_unset();
        session_destroy();
        header('location: index');
    }

    public function loginUser()
    {
        try {
            if(isset($_POST['submit'])) {

                if ($this->emptyInput() === false) {
                    $message = 'Veuillez remplir tous les champs';
                    throw new LoginException($this->email, $message);
                }
                if ($this->invalidEmail() === false) {
                    $message = 'L\'adresse n\'est pas une adresse e-mail valide';
                    throw new LoginException($this->email, $message);
                }
                $this->login($this->email, $this->password);
            }
        } catch (LoginException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    private function emptyInput(): bool
    {
        if (empty($this->email) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}