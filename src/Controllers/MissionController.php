<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Mission;
use App\Validation\Validation;

class MissionController extends Mission
{
    public function addMission()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitMission'])) {
                $this->add(
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['title'])),
                    htmlspecialchars($_POST['description']),
                    $validation->stringValidation(htmlspecialchars($_POST['type'])),
                    $_POST['start_date'],
                    $_POST['end_date'],
                    $_POST['country_id'],
                    $_POST['specialty_id'],
                    $_POST['agent_id'],
                    $_POST['target_id'],
                    $_POST['contact_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function deleteMission()
    {
        try {
            if (isset($_POST['deleteMission'])) {
                $this->delete($_POST['delete-mission']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function showMissions()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function addMissionHideout()
    {
        try {
            if (isset($_POST['addMissionHideout'])) {
                $this->addHideout($_POST['existing-mission'], $_POST['hideout_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function addMissionTarget()
    {
        try {
            if (isset($_POST['addMissionTarget'])) {
                $this->addTarget($_POST['existing-mission'], $_POST['target_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function addMissionAgent()
    {
        try {
            if (isset($_POST['addMissionAgent'])) {
                $this->addAgent($_POST['existing-mission'], $_POST['agent_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function addMissionContact()
    {
        try {
            if (isset($_POST['addMissionContact'])) {
                $this->addContact($_POST['existing-mission'], $_POST['contact_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function updateMissionStatus()
    {
        try {
            if (isset($_POST['updateMissionStatus'])) {
                $this->updateStatus($_POST['existing-mission'], $_POST['status_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function updateMissionHideout()
    {
        try {
            if (isset($_POST['updateMissionHideout'])) {
                $this->updateHideout($_POST['existing-mission'], $_POST['hideout_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function deleteMissionTarget()
    {
        try {
            if (isset($_POST['deleteMissionTarget'])) {
                $this->deleteTarget($_POST['existing-mission'], $_POST['target_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');;
        }
    }

    public function deleteMissionContact()
    {
        try {
            if (isset($_POST['deleteMissionContact'])) {
                $this->deleteContact($_POST['existing-mission'], $_POST['contact_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function deleteMissionAgent()
    {
        try {
            if (isset($_POST['deleteMissionAgent'])) {
                $this->deleteAgent($_POST['existing-mission'], $_POST['agent_id']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: mission-manage');
        }
    }

    public function render(): void
    {
        $title = 'Gestion des missions';
        $content = require('src/Views/missionManage.php');
    }
}