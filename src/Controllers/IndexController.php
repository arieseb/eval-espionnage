<?php

namespace App\Controllers;

class IndexController
{
    public function render(): void
    {
        $title = 'Site d\'espionnage';
        $content = include('src/Views/home.php');
    }
}