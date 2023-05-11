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
                    htmlspecialchars($validation->stringValidation($_POST['codename'])),
                    htmlspecialchars($validation->stringValidation($_POST['firstname'])),
                    htmlspecialchars($validation->stringValidation($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: target-manage');
        }
    }

    public function showTargets()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function fetchTargets()
    {
        $data = $this->showTargets();
        $response = ['data' => $data];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function showTarget($id)
    {
        try {
            return $this->getTarget($id);
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function updateTarget()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateTarget'])) {
                $this->update(
                    $_POST['existing-target'],
                    htmlspecialchars($validation->stringValidation($_POST['codename'])),
                    htmlspecialchars($validation->stringValidation($_POST['firstname'])),
                    htmlspecialchars($validation->stringValidation($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: target-manage');
        }
    }
    public function deleteTarget()
    {
        try {
            if (isset($_POST['deleteTarget'])) {
                $this->delete($_POST['delete-target']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: target-manage');
        }
    }
    public function render(): void
    {
        $title = 'Gestion des cibles';
        $content = require('src/Views/targetManage.php');
    }
}