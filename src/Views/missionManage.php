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
<?php if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN'): ?>
    <div class="text-center">
        <h1>-- CONFIDENTIEL --</h1>
        <p>Vous n'êtes pas autorisé à consulter cette page</p>
    </div>
<?php else: ?>
<?php include 'adminHeader.php'?>
<h2 class="text-center">Gestion des missions</h2>
<?php include 'missionTable.php' ?>
<div class="mt-3">
    <h3 class="text-center">Ajouter une nouvelle mission</h3>
    <form method="POST" action="add-mission">
        <div class="grid-container grid-container-hd flex-column-lg-center">
            <div class="grid-item flex-column-center">
                <input type="text" name="codename" id="codename" placeholder="Nom de code" aria-label="Nom de code" class="mb-1-hd">
                <input type="text" name="title" id="title" placeholder="Titre de la mission" aria-label="Titre" class="mb-1-hd">
                <input type="text" name="type" id="type" placeholder="Type de mission" aria-label="Type" class="mb-1-hd">
            </div>
            <div class="grid-item flex-column-center">
                <div>
                    <label for="start_date">Date de début : </label>
                    <input type="date" name="start_date" id="start_date" class="mb-1-hd">
                </div>
                <div>
                    <label for="end_date">Date de fin : </label>
                    <input type="date" name="end_date" id="end_date" class="mb-1-hd">
                </div>
                <div>
                    <label for="country_id">Pays : </label>
                    <select name ="country_id" id="country_id">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="grid-item flex-column-center">
                <div>
                    <label for="target_id">Cible : </label>
                    <select name ="target_id" id="target_id" class="mb-1-lg">
                        <?php
                        foreach ($targets->showTargets() as $target) {
                            echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="contact_id">Contact : </label>
                    <select name ="contact_id" id="contact_id" aria-label="Contact" class="mb-1-lg">
                        <?php
                        foreach ($contacts->showContacts() as $contact) {
                            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="agent_id">Agent : </label>
                    <select name ="agent_id" id="agent_id" aria-label="Agent" class="mb-1-lg">
                        <?php
                        foreach ($agents->showAgents() as $agent) {
                            echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="specialty_id">Spécialité : </label>
                    <select name ="specialty_id" id="specialty_id" aria-label="Spécialité">
                        <?php
                        foreach ($specialties->showSpecialties() as $specialty) {
                            echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="grid-item flex-column-center">
                <textarea name="description" id="description" placeholder="Description de la mission" aria-label="Description"></textarea>
                <button type="submit" name="submitMission" class="align-self-right align-self-center-hd mt-3">Ajouter</button>
            </div>
        </div>
    </form>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3>Ajouter une planque à une mission</h3>
            <div class="text-center">
                <form method="POST" action="add-mission-hideout">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="hideout_id" id="hideout_id" aria-label="Planque">
                        <?php
                        foreach ($hideouts->showHideouts() as $hideout) {
                            echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="addMissionHideout">Ajouter</button>
                </form>
            </div>
        </div>
        <div>
            <h3>Changer la planque d'une mission</h3>
            <div class="text-center">
                <form method="POST" action="update-mission-hideout">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="hideout_id" id="hideout_id" aria-label="Planque">
                        <?php
                        foreach ($hideouts->showHideouts() as $hideout) {
                            echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="updateMissionHideout">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3>Ajouter une cible à une mission</h3>
            <div class="text-center">
                <form method="POST" action="add-mission-target">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="target_id" id="target_id" aria-label="Cible">
                        <?php
                        foreach ($targets->showTargets() as $target) {
                            echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="addMissionTarget">Ajouter</button>
                </form>
            </div>
        </div>
        <div>
            <h3>Retirer une cible d'une mission</h3>
            <div class="text-center">
                <form method="POST" action="delete-mission-target">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="target_id" id="target_id" aria-label="Cible">
                        <?php
                        foreach ($targets->showTargets() as $target) {
                            echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteMissionTarget" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3>Ajouter un contact à une mission</h3>
            <div class="text-center">
                <form method="POST" action="add-mission-contact">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="contact_id" id="contact_id" aria-label="Contact">
                        <?php
                        foreach ($contacts->showContacts() as $contact) {
                            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="addMissionContact">Ajouter</button>
                </form>
            </div>
        </div>
        <div>
            <h3>Retirer un contact d'une mission</h3>
            <div class="text-center">
                <form method="POST" action="delete-mission-contact">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="contact_id" id="contact_id" aria-label="Contact">
                        <?php
                        foreach ($contacts->showContacts() as $contact) {
                            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteMissionContact" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3 class="text-center">Ajouter un agent à une mission</h3>
            <div class="text-center">
                <form method="POST" action="add-mission-agent" aria-label="Mission">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="agent_id" id="agent_id" aria-label="Agent">
                        <?php
                        foreach ($agents->showAgents() as $agent) {
                            echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="addMissionAgent">Ajouter</button>
                </form>
            </div>
        </div>
        <div>
            <h3 class="text-center">Retirer un agent d'une mission</h3>
            <div class="text-center">
                <form method="POST" action="delete-mission-agent">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="agent_id" id=agent_id" aria-label="Agent">
                        <?php
                        foreach ($agents->showAgents() as $agent) {
                            echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteMissionAgent" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3>Changer le statut d'une mission</h3>
            <div class="text-center">
                <form method="POST" action="update-mission-status">
                    <select name ="existing-mission" id="existing-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <select name ="status_id" id="status_id" aria-label="Statut">
                        <?php
                        foreach ($missionStatus->showMissionStatus() as $status) {
                            echo '<option value="'.$status['id'].'">'.$status['name'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="updateMissionStatus">Mettre à jour</button>
                </form>
            </div>
        </div>
        <div>
            <h3>Annuler une mission existante</h3>
            <div class="text-center">
                <form method="POST" action="delete-mission">
                    <select name ="delete-mission" id="delete-mission" aria-label="Mission">
                        <?php
                        foreach ($missions->showMissions() as $mission) {
                            echo '<option value="'.$mission['id'].'">'.$mission['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteMission" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>