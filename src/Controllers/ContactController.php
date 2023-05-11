<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Contact;
use App\Validation\Validation;

class ContactController extends Contact
{
    public function addContact()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitContact'])) {
                $this->add(
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: contact-manage');
        }
    }

    public function showContacts()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function fetchContacts()
    {
        $data = $this->showContacts();
        $response = ['data' => $data];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function showContact($id)
    {
        try {
            return $this->getContact($id);
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function updateContact()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateContact'])) {
                $this->update(
                    $_POST['existing-contact'],
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: contact-manage');
        }
    }
    public function deleteContact()
    {
        try {
            if (isset($_POST['deleteContact'])) {
                $this->delete($_POST['delete-contact']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: contact-manage');
        }
    }

    public function render(): void
    {
        $title = 'Gestion des contacts';
        $content = require('src/Views/contactManage.php');
    }
}