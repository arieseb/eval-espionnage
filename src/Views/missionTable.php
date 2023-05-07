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

$countries = new CountryController();
$missions = new MissionController();
$missionTargets = new MissionTargetController();
$missionContacts = new MissionContactController();
$missionAgents = new MissionAgentController();
$targets = new TargetController();
$contacts = new ContactController();
$agents = new AgentController();
$specialties = new SpecialtyController();
$missionStatus = new MissionStatusController();
$hideouts = new HideoutController();
?>
    <div>
        <h2>Liste des missions</h2>
        <table>
            <thead>
            <tr>
                <th>Nom de code</th>
                <th>Titre</th>
                <th>Type de mission</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Pays</th>
                <th>Planque</th>
                <th>Cible(s)</th>
                <th>Contact(s)</th>
                <th>Agent(s)</th>
                <th>Spécialité requise</th>
                <th>Description</th>
                <th>Statut de la mission</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($missions->showMissions() as $mission): ?>
                <tr>
                    <td><?php echo $mission['codename'] ?></td>
                    <td><?php echo $mission['title'] ?></td>
                    <td><?php echo $mission['type'] ?></td>
                    <td><?php echo date_format(new \DateTime($mission['start_date']), 'd/m/Y') ?></td>
                    <td><?php echo date_format(new \DateTime($mission['end_date']), 'd/m/Y') ?></td>
                    <td>
                        <?php echo $countries->showCountry($mission['country_id']); ?>
                    </td>
                    <td>
                        <?php echo $hideouts->showHideout($mission['hideout_id']); ?>
                    </td>
                    <td>
                        <?php
                        foreach ($missionTargets->getMissionTarget($mission['id']) as $missionTarget){
                            $targetList = $targets->getTarget($missionTarget['target_id']);
                            echo $targetList['codename'] . ' ';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($missionContacts->getMissionContact($mission['id']) as $missionContact){
                            $contactList = $contacts->getContact($missionContact['contact_id']);
                            echo $contactList['codename'] . ' ';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($missionAgents->getMissionAgent($mission['id']) as $missionAgent){
                            $agentList = $agents->getAgent($missionAgent['agent_id']);
                            echo $agentList['codename'] . ' ';
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $specialties->showSpecialty($mission['required_specialty'])['name']; ?>
                    </td>
                    <td><?php echo $mission['description'] ?></td>
                    <td><?php echo $missionStatus->showStatus($mission['mission_status_id'])['name']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
?>
