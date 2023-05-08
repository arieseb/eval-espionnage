<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Target;
use App\Validation\Validation;

class TargetController extends Target
{
    public function addTarget()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitTarget'])) {
                $this->add(
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showTargets()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showTarget($id)
    {
        try {
            return $this->getTarget($id);
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateTarget()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateTarget'])) {
                $this->update(
                    $_POST['existing-target'],
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function deleteTarget()
    {
        try {
            if (isset($_POST['deleteTarget'])) {
                $this->delete($_POST['delete-target']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function render(): void
    {
        $title = 'Gestion des cibles';
        $content = require('src/Views/targetManage.php');
    }
}