<?php

namespace App\Controllers;

class DashboardController
{
    public function render(): void
    {
        $title = 'Panneau d\'administration';
        $content = require('src/Views/dashboard.php');
    }
}