<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Specialty;
use App\Validation\Validation;

class SpecialtyController extends Specialty
{
    public function addSpecialty()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitSpecialty'])) {
                $this->add($validation->stringValidation(htmlspecialchars($_POST['name'])));
            }
        } catch (QueryException|ValidationException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showSpecialties()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showSpecialty($id)
    {
        try {
            return $this->getSpecialty($id);
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function deleteSpecialty()
    {
        try {
            if (isset($_POST['deleteSpecialty'])) {
                $this->delete($_POST['delete-specialty']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}