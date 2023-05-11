<?php

namespace App\Controllers;

use App\Exceptions\QueryException;
use App\Models\MissionStatus;

class MissionStatusController extends MissionStatus
{
    public function showMissionStatus()
    {
        try {
            return $this->readAll();
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }

    public function showStatus($id)
    {
        try {
            return $this->getStatus($id);
        } catch (QueryException $e) {
            $_SESSION['error']  = $e->getMessage();
        }
    }
}