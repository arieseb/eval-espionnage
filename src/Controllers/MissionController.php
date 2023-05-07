<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Mission;

class MissionController extends Mission
{
    public function addMission()
    {
        try {
            if (isset($_POST['submitMission'])) {
                $this->add(
                    $_POST['codename'],
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['type'],
                    $_POST['start_date'],
                    $_POST['end_date'],
                    $_POST['country_id'],
                    $_POST['specialty_id'],
                    $_POST['agent_id'],
                    $_POST['target_id'],
                    $_POST['contact_id']
                );
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function deleteMission()
    {
        try {
            if (isset($_POST['deleteMission'])) {
                $this->delete($_POST['delete-mission']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showMissions()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function addMissionHideout()
    {
        try {
            if (isset($_POST['addMissionHideout'])) {
                $this->addHideout($_POST['existing-mission'], $_POST['hideout_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function addMissionTarget()
    {
        try {
            if (isset($_POST['addMissionTarget'])) {
                $this->addTarget($_POST['existing-mission'], $_POST['target_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function addMissionAgent()
    {
        try {
            if (isset($_POST['addMissionAgent'])) {
                $this->addAgent($_POST['existing-mission'], $_POST['agent_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function addMissionContact()
    {
        try {
            if (isset($_POST['addMissionContact'])) {
                $this->addContact($_POST['existing-mission'], $_POST['contact_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateMissionStatus()
    {
        try {
            if (isset($_POST['updateMissionStatus'])) {
                $this->updateStatus($_POST['existing-mission'], $_POST['status_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateMissionHideout()
    {
        try {
            if (isset($_POST['updateMissionHideout'])) {
                $this->updateHideout($_POST['existing-mission'], $_POST['hideout_id']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function render(): void
    {
        $title = 'Gestion des missions';
        $content = require('src/Views/missionManage.php');
    }
}