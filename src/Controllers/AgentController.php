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
                    htmlspecialchars($validation->stringValidation($_POST['codename'])),
                    htmlspecialchars($validation->stringValidation($_POST['firstname'])),
                    htmlspecialchars($validation->stringValidation($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id'],
                    $_POST['specialty_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: agent-manage');
        }
    }

    public function showAgents()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function fetchAgents()
    {
        $data = $this->showAgents();
        $response = ['data' => $data];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function showAgent($id)
    {
        try {
            return $this->getAgent($id);
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function updateAgent()
    {
        $validation = new Validation();
        try {
            if (isset($_POST['updateAgent'])) {
                $this->update(
                    $_POST['existing-agent'],
                    htmlspecialchars($validation->stringValidation($_POST['codename'])),
                    htmlspecialchars($validation->stringValidation($_POST['firstname'])),
                    htmlspecialchars($validation->stringValidation($_POST['lastname'])),
                    $_POST['birthdate'],
                    $_POST['country_id']
                );
            }
        } catch (QueryException|ValidationException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: agent-manage');
        }
    }

    public function deleteAgent()
    {
        try {
            if (isset($_POST['deleteAgent'])) {
                $this->delete($_POST['delete-agent']);
            }
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
            header('location: agent-manage');
        }
    }

    public function render(): void
    {
        $title = 'Gestion des agents';
        $content = require('src/Views/agentManage.php');
    }
}