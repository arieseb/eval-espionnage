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
                    $validation->stringValidation(htmlspecialchars($_POST['name'])),
                    $validation->stringValidation(htmlspecialchars($_POST['nationality']))
                );
            }
        } catch (QueryException|ValidationException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showCountries()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
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
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showNationality($id)
    {
        try {
            return $this->getCountry($id)['nationality'];
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateCountry()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateCountry'])) {
                $this->update(
                    $_POST['existing-country'],
                    $validation->stringValidation(htmlspecialchars($_POST['name'])),
                    $validation->stringValidation(htmlspecialchars($_POST['nationality']))
                );
            }
        } catch (QueryException|ValidationException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function deleteCountry()
    {
        try {
            if (isset($_POST['deleteCountry'])) {
                $this->delete($_POST['delete-country']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}