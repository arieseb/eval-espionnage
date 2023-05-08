<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Exceptions\ValidationException;
use App\Models\Agent;
use App\Validation\Validation;

class AgentController extends Agent
{
    public function addAgent()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['submitAgent'])) {
                $this->add(
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id'],
                    $_POST['specialty_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
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

    public function showAgent($id)
    {
        try {
            return $this->getAgent($id);
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function updateAgent()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateAgent'])) {
                $this->update(
                    $_POST['existing-agent'],
                    $validation->codenameValidation(htmlspecialchars($_POST['codename'])),
                    $validation->stringValidation(htmlspecialchars($_POST['firstname'])),
                    $validation->stringValidation(htmlspecialchars($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
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