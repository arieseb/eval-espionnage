<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Hideout;

class HideoutController extends Hideout
{
    public function addHideout()
    {
        try {
            if (isset($_POST['submitHideout'])) {
                $this->add($_POST['code'], $_POST['address'], $_POST['type'], $_POST['country_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showHideouts()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
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
        try {
            if (isset($_POST['updateHideout'])) {
                $this->update(
                    $_POST['existing-hideout'],
                    $_POST['code'],
                    $_POST['address'],
                    $_POST['type'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function deleteHideout()
    {
        try {
            if (isset($_POST['deleteHideout'])) {
                $this->delete($_POST['delete-hideout']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function render(): void
    {
        $title = 'Gestion des planques';
        $content = require('src/Views/hideoutManage.php');
    }
}