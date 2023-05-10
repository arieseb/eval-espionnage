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
        <div id="mission-list"></div>
        <div class="overflow-xxl">
            <table>
                <thead>
                <tr>
                    <th>Nom de code</th>
                    <th class="hidden-xl">Titre</th>
                    <th class="hidden-lg">Type de mission</th>
                    <th class="hidden-lg">Date de début</th>
                    <th class="hidden-lg">Date de fin</th>
                    <th class="hidden-md">Pays</th>
                    <th class="hidden-xl">Planque</th>
                    <th>Cible(s)</th>
                    <th class="hidden-xl">Contact(s)</th>
                    <th>Agent(s)</th>
                    <th class="hidden-xxl">Spécialité requise</th>
                    <th class="hidden-xxl">Description</th>
                    <th>Statut de la mission</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($missions->showMissions() as $mission): ?>
                    <tr data-id="<?php echo $mission['id'] ?>">
                        <td><?php echo $mission['codename'] ?></td>
                        <td class="hidden-xl"><?php echo $mission['title'] ?></td>
                        <td class="hidden-lg"><?php echo $mission['type'] ?></td>
                        <td class="hidden-lg"><?php echo date_format(new DateTime($mission['start_date']), 'd/m/Y') ?></td>
                        <td class="hidden-lg"><?php echo date_format(new DateTime($mission['end_date']), 'd/m/Y') ?></td>
                        <td class="hidden-md">
                            <?php echo $countries->showCountry($mission['country_id']); ?>
                        </td>
                        <td class="hidden-xl">
                            <?php echo $hideouts->showHideout($mission['hideout_id']); ?>
                        </td>
                        <td class="list">
                            <?php
                            foreach ($missionTargets->getMissionTarget($mission['id']) as $missionTarget){
                                $targetList = $targets->getTarget($missionTarget['target_id']);
                                echo $targetList['codename'] . ' / ';
                            }
                            ?>
                        </td>
                        <td class="hidden-xl list">
                            <?php
                            foreach ($missionContacts->getMissionContact($mission['id']) as $missionContact){
                                $contactList = $contacts->getContact($missionContact['contact_id']);
                                echo $contactList['codename'] . ' / ';
                            }
                            ?>
                        </td>
                        <td class="list">
                            <?php
                            foreach ($missionAgents->getMissionAgent($mission['id']) as $missionAgent){
                                $agentList = $agents->getAgent($missionAgent['agent_id']);
                                echo $agentList['codename'] . ' / ';
                            }
                            ?>
                        </td>
                        <td  class="hidden-xxl">
                            <?php echo $specialties->showSpecialty($mission['required_specialty'])['name']; ?>
                        </td>
                        <td class="hidden-xxl"><?php echo $mission['description'] ?></td>
                        <td><?php echo $missionStatus->showStatus($mission['mission_status_id'])['name']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p>Ce tableau affiche un maximum d'informations sur un terminal adapté. Donnez-vous les moyens de vous renseigner convenablement pour la Mère-Patrie.</p>
    </div>
<script src="./scripts/missionTable.js"></script>
<script src="./scripts/trimLists.js"></script>
<?php
?>
