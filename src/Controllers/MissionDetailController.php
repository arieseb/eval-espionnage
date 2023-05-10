<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\Mission;

class MissionDetailController extends Mission
{

    public function showDetail()
    {
        if (isset($_GET['id'])) {
            try {
                return $this->getMission($_GET['id']);
            } catch (QueryException $e) {
                echo '<p>' . $e->getMessage() . ' La mission n°' . $_GET['id'] . ' n\'existe pas.' . '</p>';
            }
        }
    }

    public function render(): void
    {
        $title = 'Détail de la mission n°' . $this->showDetail()['id'];
        $content = include('src/Views/missionDetail.php');
    }
}