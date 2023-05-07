<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\AgentSpecialty;

class AgentSpecialtyController extends AgentSpecialty
{
    public function addAgentSpecialty()
    {
        try {
            if (isset($_POST['addAgentSpecialty'])) {
                $this->add($_POST['existing-agent'], $_POST['existing-specialty']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function deleteAgentSpecialty()
    {
        try {
            if (isset($_POST['deleteAgentSpecialty'])) {
                $this->delete($_POST['existing-agent'], $_POST['existing-specialty']);
            }
        } catch (QueryException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

}