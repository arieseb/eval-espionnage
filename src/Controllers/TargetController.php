<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Target;

class TargetController extends Target
{
    public function addTarget()
    {
        try {
            if (isset($_POST['submitTarget'])) {
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
        try {
            if (isset($_POST['updateTarget'])) {
                $this->update(
                    $_POST['existing-target'],
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