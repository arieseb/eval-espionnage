<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Contact;

class ContactController extends Contact
{
    public function addContact()
    {
        try {
            if (isset($_POST['submitContact'])) {
                $this->add(
                    $_POST['codename'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showContacts()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateContact()
    {
        try {
            if (isset($_POST['updateContact'])) {
                $this->update(
                    $_POST['existing-contact'],
                    $_POST['codename'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function deleteContact()
    {
        try {
            if (isset($_POST['deleteContact'])) {
                $this->delete($_POST['delete-contact']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function render(): void
    {
        $title = 'Gestion des contacts';
        $content = require('src/Views/contactManage.php');
    }
}