<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Country;

class CountryController extends Country
{
    public function addCountry()
    {
        try {
            if (isset($_POST['submitCountry'])) {
                $this->add($_POST['name'], $_POST['nationality']);
            }
        } catch (QueryException $e) {
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
        try {
            if (isset($_POST['updateCountry'])) {
                $this->update($_POST['existing-country'], $_POST['name'], $_POST['nationality']);
            }
        } catch (QueryException $e) {
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