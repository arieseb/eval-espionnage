<?php

use App\Controllers\AgentController;
use App\Controllers\ContactController;
use App\Controllers\CountryController;
use App\Controllers\HideoutController;
use App\Controllers\MissionAgentController;
use App\Controllers\MissionContactController;
use App\Controllers\MissionDetailController;
use App\Controllers\MissionStatusController;
use App\Controllers\MissionTargetController;
use App\Controllers\SpecialtyController;
use App\Controllers\TargetController;

$agents = new AgentController();
$contacts = new ContactController();
$countries = new CountryController();
$hideouts = new HideoutController();
$mission = new MissionDetailController();
$missionAgents = new MissionAgentController();
$missionDetail = $mission->showDetail();
$missionContacts = new MissionContactController();
$missionStatus = new MissionStatusController();
$missionTargets = new MissionTargetController();
$specialties = new SpecialtyController();
$targets = new TargetController();

ob_start();
;?>

<h1 class="text-center">
    <span class="hidden-lg">-- </span>
        Détail de la mission : <span class="show-inline-lg hidden"><br></span><?php echo $missionDetail['codename'] ?>
    <span class="hidden-lg"> --</span>
</h1>
<div class="flex-center">
<ul class="hidden-lg">
    <li>Nom de code :</li>
    <li>Titre :</li>
    <li>Type de mission :</li>
    <li>Date de début :</li>
    <li>Date de fin :</li>
    <li>Pays de l'opération :</li>
    <li>Planque allouée :</li>
    <li>Cible(s) de la mission :</li>
    <li>Contact(s) sur place :</li>
    <li>Agent(s) déployé(s) :</li>
    <li>Spécialité requise :</li>
    <li>Description de la mission :</li>
    <li>Statut de la mission :</li>
</ul>
<ul>
    <li><?php echo $missionDetail['codename'] ?></li>
    <li><?php echo $missionDetail['title'] ?></li>
    <li><?php echo $missionDetail['type'] ?></li>
    <li><?php echo date_format(new DateTime($missionDetail['start_date']), 'd/m/Y') ?></li>
    <li><?php echo date_format(new DateTime($missionDetail['end_date']), 'd/m/Y') ?></li>
    <li><?php echo $countries->showCountry($missionDetail['country_id']); ?></li>
    <li><?php echo $hideouts->showHideout($missionDetail['hideout_id']); ?></li>
    <li class="list">
        <?php
        foreach ($missionTargets->getMissionTarget($missionDetail['id']) as $missionTarget){
            $targetList = $targets->getTarget($missionTarget['target_id']);
            echo $targetList['codename'] . ' / ';
        }
        ?>
    </li>
    <li class="list">
        <?php
        foreach ($missionContacts->getMissionContact($missionDetail['id']) as $missionContact){
            $contactList = $contacts->getContact($missionContact['contact_id']);
            echo $contactList['codename'] . ' / ';
        }
        ?>
    </li>
    <li class="list">
        <?php
        foreach ($missionAgents->getMissionAgent($missionDetail['id']) as $missionAgent){
            $agentList = $agents->getAgent($missionAgent['agent_id']);
            echo $agentList['codename'] . ' / ';
        }
        ?>
    </li>
    <li><?php echo $specialties->showSpecialty($missionDetail['required_specialty'])['name']; ?></li>
    <li><?php echo $missionDetail['description'] ?></li>
    <li><?php echo $missionStatus->showStatus($missionDetail['mission_status_id'])['name']; ?></li>
</ul>
</div>
<script src="./scripts/trimLists.js"></script>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>
