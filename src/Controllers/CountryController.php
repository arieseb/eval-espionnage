<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Country;
use App\Validation\Validation;

class CountryController extends Country
{
    public function addCountry()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitCountry'])) {
                $this->add(
                    htmlspecialchars($validation->stringValidation($_POST['name'])),
                    htmlspecialchars($validation->stringValidation($_POST['nationality'])),
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: dashboard');
        }
    }

    public function showCountries()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function fetchCountries()
    {
        $data = $this->showCountries();
        $response = ['data' => $data];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function showCountry($id)
    {
        try {
            return $this->getCountry($id)['name'];
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function showNationality($id)
    {
        try {
            return $this->getCountry($id)['nationality'];
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function updateCountry()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateCountry'])) {
                $this->update(
                    $_POST['existing-country'],
                    htmlspecialchars($validation->stringValidation($_POST['name'])),
                    htmlspecialchars($validation->stringValidation($_POST['nationality'])),
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: dashboard');
        }
    }

    public function deleteCountry()
    {
        try {
            if (isset($_POST['deleteCountry'])) {
                $this->delete($_POST['delete-country']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: dashboard');
        }
    }
}