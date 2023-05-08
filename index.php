<?php

use App\Exceptions\RouteNotFoundException;

session_start();
require 'vendor/autoload.php';

$router = new \App\Routing\Router();

$router->addRoute(
    'index',
    '/spy_site/',
    'GET',
    \App\Controllers\IndexController::class,
    'render'
);

$router->addRoute(
    'index',
    '/spy_site/index',
    'GET',
    \App\Controllers\IndexController::class,
    'render'
);

$router->addRoute(
    'index',
    '/spy_site/home',
    'GET',
    \App\Controllers\IndexController::class,
    'render'
);

$router->addRoute(
    'dashboard',
    '/spy_site/dashboard',
    'GET',
    \App\Controllers\DashboardController::class,
    'render'
);

$router->addRoute(
    'hideout-manage',
    '/spy_site/hideout-manage',
    'GET',
    \App\Controllers\HideoutController::class,
    'render'
);

$router->addRoute(
    'contact-manage',
    '/spy_site/contact-manage',
    'GET',
    \App\Controllers\ContactController::class,
    'render'
);

$router->addRoute(
    'agent-manage',
    '/spy_site/agent-manage',
    'GET',
    \App\Controllers\AgentController::class,
    'render'
);

$router->addRoute(
    'target-manage',
    '/spy_site/target-manage',
    'GET',
    \App\Controllers\TargetController::class,
    'render'
);

$router->addRoute(
    'mission-manage',
    '/spy_site/mission-manage',
    'GET',
    \App\Controllers\MissionController::class,
    'render'
);

$router->addRoute(
    'login',
    '/spy_site/login',
    'POST',
    \App\Controllers\LoginController::class,
    'loginUser'
);

$router->addRoute(
    'logout',
    '/spy_site/logout',
    'GET',
    \App\Controllers\LoginController::class,
    'logoutUser'
);

$router->addRoute(
    'add-country',
    '/spy_site/add-country',
    'POST',
    \App\Controllers\CountryController::class,
    'addCountry'
);

$router->addRoute(
    'update-country',
    '/spy_site/update-country',
    'POST',
    \App\Controllers\CountryController::class,
    'updateCountry'
);

$router->addRoute(
    'delete-country',
    '/spy_site/delete-country',
    'POST',
    \App\Controllers\CountryController::class,
    'deleteCountry'
);

$router->addRoute(
    'add-hideout',
    '/spy_site/add-hideout',
    'POST',
    \App\Controllers\HideoutController::class,
    'addHideout'
);

$router->addRoute(
    'update-hideout',
    '/spy_site/update-hideout',
    'POST',
    \App\Controllers\HideoutController::class,
    'updateHideout'
);

$router->addRoute(
    'delete-hideout',
    '/spy_site/delete-hideout',
    'POST',
    \App\Controllers\HideoutController::class,
    'deleteHideout'
);

$router->addRoute(
    'add-contact',
    '/spy_site/add-contact',
    'POST',
    \App\Controllers\ContactController::class,
    'addContact'
);

$router->addRoute(
    'update-contact',
    '/spy_site/update-contact',
    'POST',
    \App\Controllers\ContactController::class,
    'updateContact'
);
$router->addRoute(
    'delete-contact',
    '/spy_site/delete-contact',
    'POST',
    \App\Controllers\ContactController::class,
    'deleteContact'
);

$router->addRoute(
    'add-target',
    '/spy_site/add-target',
    'POST',
    \App\Controllers\TargetController::class,
    'addTarget'
);

$router->addRoute(
    'update-target',
    '/spy_site/update-target',
    'POST',
    \App\Controllers\TargetController::class,
    'updateTarget'
);

$router->addRoute(
    'delete-target',
    '/spy_site/delete-target',
    'POST',
    \App\Controllers\TargetController::class,
    'deleteTarget'
);

$router->addRoute(
    'add-specialty',
    '/spy_site/add-specialty',
    'POST',
    \App\Controllers\SpecialtyController::class,
    'addSpecialty'
);

$router->addRoute(
    'delete-specialty',
    '/spy_site/delete-specialty',
    'POST',
    \App\Controllers\SpecialtyController::class,
    'deleteSpecialty'
);

$router->addRoute(
    'add-agent',
    '/spy_site/add-agent',
    'POST',
    \App\Controllers\AgentController::class,
    'addAgent'
);

$router->addRoute(
    'update-agent',
    '/spy_site/update-agent',
    'POST',
    \App\Controllers\AgentController::class,
    'updateAgent'
);

$router->addRoute(
    'delete-agent',
    '/spy_site/delete-agent',
    'POST',
    \App\Controllers\AgentController::class,
    'deleteAgent'
);

$router->addRoute(
    'add-agent-specialty',
    '/spy_site/add-agent-specialty',
    'POST',
    \App\Controllers\AgentSpecialtyController::class,
    'addAgentSpecialty'
);

$router->addRoute(
    'delete-agent-specialty',
    '/spy_site/delete-agent-specialty',
    'POST',
    \App\Controllers\AgentSpecialtyController::class,
    'deleteAgentSpecialty'
);

$router->addRoute(
    'add-mission-hideout',
    '/spy_site/add-mission-hideout',
    'POST',
    \App\Controllers\MissionController::class,
    'addMissionHideout'
);

$router->addRoute(
    'add-mission',
    '/spy_site/add-mission',
    'POST',
    \App\Controllers\MissionController::class,
    'addMission'
);

$router->addRoute(
    'delete-mission',
    '/spy_site/delete-mission',
    'POST',
    \App\Controllers\MissionController::class,
    'deleteMission'
);

$router->addRoute(
    'add-mission-target',
    '/spy_site/add-mission-target',
    'POST',
    \App\Controllers\MissionController::class,
    'addMissionTarget'
);

$router->addRoute(
    'add-mission-contact',
    '/spy_site/add-mission-contact',
    'POST',
    \App\Controllers\MissionController::class,
    'addMissionContact'
);

$router->addRoute(
    'add-mission-agent',
    '/spy_site/add-mission-agent',
    'POST',
    \App\Controllers\MissionController::class,
    'addMissionAgent'
);

$router->addRoute(
    'update-mission-status',
    '/spy_site/update-mission-status',
    'POST',
    \App\Controllers\MissionController::class,
    'updateMissionStatus'
);

$router->addRoute(
    'update-mission-hideout',
    '/spy_site/update-mission-hideout',
    'POST',
    \App\Controllers\MissionController::class,
    'updateMissionHideout'
);

$router->addRoute(
    'delete-mission-target',
    '/spy_site/delete-mission-target',
    'POST',
    \App\Controllers\MissionController::class,
    'deleteMissionTarget'
);

$router->addRoute(
    'delete-mission-contact',
    '/spy_site/delete-mission-contact',
    'POST',
    \App\Controllers\MissionController::class,
    'deleteMissionContact'
);

$router->addRoute(
    'delete-mission-agent',
    '/spy_site/delete-mission-agent',
    'POST',
    \App\Controllers\MissionController::class,
    'deleteMissionAgent'
);

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    $router->execute($requestUri, $requestMethod);
} catch (RouteNotFoundException $e) {
    http_response_code(404);
    echo '<p>404 - Page non trouvée</p>';
    echo '<p>' . $e->getMessage() . '</p>';
}