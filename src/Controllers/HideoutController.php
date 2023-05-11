<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Hideout;
use App\Validation\Validation;

class HideoutController extends Hideout
{
    public function addHideout()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitHideout'])) {
                $this->add(
                    $validation->codenameValidation(htmlspecialchars($_POST['code'])),
                    htmlspecialchars($_POST['address']),
                    $validation->stringValidation(htmlspecialchars($_POST['type'])),
                    $_POST['country_id'])
                ;
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: hideout-manage');
        }
    }

    public function showHideouts()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function fetchHideouts()
    {
        $data = $this->showHideouts();
        $response = ['data' => $data];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function showHideout($id)
    {
        try {
            return $this->getHideout($id)['code'];
        } catch (QueryException) {
            echo 'Pas de planque définie';
        }
    }

    public function updateHideout()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateHideout'])) {
                $this->update(
                    $_POST['existing-hideout'],
                    $validation->codenameValidation(htmlspecialchars($_POST['code'])),
                    htmlspecialchars($_POST['address']),
                    $validation->stringValidation(htmlspecialchars($_POST['type'])),
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: hideout-manage');
        }
    }

    public function deleteHideout()
    {
        try {
            if (isset($_POST['deleteHideout'])) {
                $this->delete($_POST['delete-hideout']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: hideout-manage');
        }
    }

    public function render(): void
    {
        $title = 'Gestion des planques';
        $content = require('src/Views/hideoutManage.php');
    }
}