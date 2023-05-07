<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Specialty;

class SpecialtyController extends Specialty
{
    public function addSpecialty()
    {
        try {
            if (isset($_POST['submitSpecialty'])) {
                $this->add($_POST['name']);
            }
        } catch (QueryException $e) {
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

    public function updateSpecialty()
    {
        try {
            if (isset($_POST['updateSpecialty'])) {
                $this->update($_POST['existing-specialty'], $_POST['name']);
            }
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