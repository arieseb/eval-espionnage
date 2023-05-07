<?php

use App\Controllers\AgentController;
use App\Controllers\ContactController;
use App\Controllers\CountryController;
use App\Controllers\HideoutController;
use App\Controllers\MissionAgentController;
use App\Controllers\MissionContactController;
use App\Controllers\MissionController;
use App\Controllers\MissionStatusController;
use App\Controllers\MissionTargetController;
use App\Controllers\SpecialtyController;
use App\Controllers\TargetController;

$hideouts = new HideoutController();
$countries = new CountryController();
$targets = new TargetController();
$contacts = new ContactController();
$agents = new AgentController();
$specialties = new SpecialtyController();
$missions = new MissionController();
$missionStatus = new MissionStatusController();
$missionTargets = new MissionTargetController();
$missionContacts = new MissionContactController();
$missionAgents = new MissionAgentController();
ob_start();
?>
    <div>
        <a href="index">Retour à l'index</a>
    </div>
<?php if (!isset($_SESSION['email'])): ?>
    <div>
        <h1>CONFIDENTIEL</h1>
        <p>Vous n'êtes pas autorisé à consulter cette page</p>
    </div>
<?php else: ?>
    <h1>Gestion des missions</h1>
    <?php include 'missionTable.php' ?>
    <h2>Ajouter une nouvelle mission</h2>
    <form method="POST" action="add-mission">
        <input type="text" name="codename" id="codename" placeholder="Nom de code">
        <input type="text" name="title" id="title" placeholder="Titre de la mission">
        <input type="text" name="type" id="type" placeholder="Type de mission">
        <input type="date" name="start_date" id="start_date">
        <input type="date" name="end_date" id="end_date">
        <select name ="country_id" id="country_id">
            <?php
            foreach ($countries->showCountries() as $country) {
                echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
            }
            ?>
        </select>
        </select>
        <select name ="target_id" id="target_id">
            <?php
            foreach ($targets->showTargets() as $target) {
                echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="contact_id" id="contact_id">
            <?php
            foreach ($contacts->showContacts() as $contact) {
                echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
            }
            ?>
        </select>
        <select name ="agent_id" id="agent_id">
        <?php
        foreach ($agents->showAgents() as $agent) {
            echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
        }
        ?>
        </select>
        <select name ="specialty_id" id="specialty_id">
            <?php
            foreach ($specialties->showSpecialties() as $specialty) {
                echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
            }
            ?>
        </select>
        <textarea name="description" id="description" placeholder="Description de la mission"></textarea>
        <button type="submit" name="submitMission">Ajouter</button>
    </form>
    <h2>Ajouter une planque à une mission</h2>
    <form method="POST" action="add-mission-hideout">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="hideout_id" id="hideout_id">
            <?php
            foreach ($hideouts->showHideouts() as $hideout) {
                echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="addMissionHideout">Ajouter</button>
    </form>
    <h2>Changer la planque d'une mission</h2>
    <form method="POST" action="update-mission-hideout">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="hideout_id" id="hideout_id">
            <?php
            foreach ($hideouts->showHideouts() as $hideout) {
                echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="updateMissionHideout">Ajouter</button>
    </form>
    <h2>Ajouter une cible à une mission</h2>
    <form method="POST" action="add-mission-target">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="target_id" id="target_id">
            <?php
            foreach ($targets->showTargets() as $target) {
                echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="addMissionTarget">Ajouter</button>
    </form>
    <h2>Ajouter un contact à une mission</h2>
    <form method="POST" action="add-mission-contact">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="contact_id" id="contact_id">
            <?php
            foreach ($contacts->showContacts() as $contact) {
                echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="addMissionContact">Ajouter</button>
    </form>
    <h2>Ajouter un agent à une mission</h2>
    <form method="POST" action="add-mission-agent">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="agent_id" id="agent_id">
            <?php
            foreach ($agents->showAgents() as $agent) {
                echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="addMissionAgent">Ajouter</button>
    </form>
    <h2>Changer le statut d'une mission</h2>
    <form method="POST" action="update-mission-status">
        <select name ="existing-mission" id="existing-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <select name ="status_id" id="status_id">
            <?php
            foreach ($missionStatus->showMissionStatus() as $status) {
                echo '<option value="'.$status['id'].'">'.$status['name'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <button type="submit" name="updateMissionStatus">Mettre à jour</button>
    </form>
    <h2>Annuler une mission existante</h2>
    <form method="POST" action="delete-mission">
        <select name ="delete-mission" id="delete-mission">
            <?php
            foreach ($missions->showMissions() as $mission) {
                echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <button type="submit" name="deleteMission">Supprimer</button>
    </form>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>