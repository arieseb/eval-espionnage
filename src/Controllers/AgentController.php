<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Agent;

class AgentController extends Agent
{
    public function addAgent()
    {
        try {
            if (isset($_POST['submitAgent'])) {
                $this->add(
                    $_POST['codename'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['birthdate'],
                    $_POST['country_id'],
                    $_POST['specialty_id']
                );
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function showAgents()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateAgent()
    {
        try {
            if (isset($_POST['updateAgent'])) {
                $this->update(
                    $_POST['existing-agent'],
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

    public function deleteAgent()
    {
        try {
            if (isset($_POST['deleteAgent'])) {
                $this->delete($_POST['delete-agent']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function render(): void
    {
        $title = 'Gestion des agents';
        $content = require('src/Views/agentManage.php');
    }
}