<?php
    use App\Controllers\AgentController;
    use App\Controllers\AgentSpecialtyController;
    use App\Controllers\CountryController;
    use App\Controllers\SpecialtyController;
    $agents = new AgentController();
    $specialties = new SpecialtyController();
    $countries = new CountryController();
    $agentSpecialties = new AgentSpecialtyController();
    ob_start();
?>
<?php if (!isset($_SESSION['email'])): ?>
    <div>
        <h1>CONFIDENTIEL</h1>
        <p>Vous n'êtes pas autorisé à consulter cette page</p>
    </div>
<?php else: ?>
    <?php include 'adminHeader.php'?>
<div class="text-center mt-3">
    <h2>Gestion des agents</h2>
    <h3>Liste des agents répertoriés</h3>
    <table class="m-auto">
        <thead>
        <tr>
            <th>Nom de code</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Nationalité</th>
            <th>Spécialité(s)</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($agents->showAgents() as $agent): ?>
            <tr>
                <td><?php echo $agent['codename'] ?></td>
                <td><?php echo $agent['firstname'] ?></td>
                <td><?php echo $agent['lastname'] ?></td>
                <td><?php echo date_format(new DateTime($agent['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($agent['country_id']); ?>
                </td>
                <td>
                    <?php
                        foreach ($agentSpecialties->getAgentSpecialty($agent['id']) as $agentSpecialty){
                            $specialityList = $specialties->getSpecialty($agentSpecialty['specialty_id']);
                            echo $specialityList['name'] . ' ';
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around">
        <div>
            <h3 class="text-center">Ajouter un nouvel agent</h3>
            <form method="POST" action="add-agent">
                <input type="text" name="codename" id="agent-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="agent-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="agent-lastname" placeholder="Nom" aria-label="Nom">
                <label for="agent-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="agent-birthdate">
                <label for="agent-country_id">Nationalité : </label>
                <select name ="country_id" id="agent-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <label for="specialty_id">Spécialité : </label>
                <select name ="specialty_id" id="specialty_id" aria-label="Spécialité">
                    <?php
                    foreach ($specialties->showSpecialties() as $specialty) {
                        echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="submitAgent">Ajouter</button>
            </form>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <h3 class="text-center">Modifier un agent existant</h3>
            <form method="POST" action="update-agent">
                <select name ="existing-agent" id="existing-agent" aria-label="Agent">
                    <?php
                    foreach ($agents->showAgents() as $agent) {
                        echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                    }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="codename" id="agent-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="agent-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="agent-lastname" placeholder="Nom" aria-label="Nom">
                <label for="agent-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="agent-birthdate">
                <label for="agent-country_id">Nationalité : </label>
                <select name ="country_id" id="agent-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="updateAgent">Modifier</button>
            </form>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <h3 class="text-center">Ajouter une spécialité à un agent</h3>
            <form method="POST" action="add-agent-specialty">
                <select name ="existing-agent" id="existing-agent" aria-label="Agent">
                    <?php
                    foreach ($agents->showAgents() as $agent) {
                        echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                    }
                    ?>
                </select>
                <select name ="existing-specialty" id="existing-specialty" aria-label="Spécialité">
                    <?php
                    foreach ($specialties->showSpecialties() as $specialty) {
                        echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="addAgentSpecialty">Ajouter</button>
            </form>
        </div>
        <div>
            <h3 class="text-center">Retirer une spécialité à un agent</h3>
            <form method="POST" action="delete-agent-specialty">
                <select name ="existing-agent" id="existing-agent" aria-label="Agent">
                    <?php
                    foreach ($agents->showAgents() as $agent) {
                        echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                    }
                    ?>
                </select>
                <select name ="existing-specialty" id="existing-specialty" aria-label="Spécialité">
                    <?php
                    foreach ($specialties->showSpecialties() as $specialty) {
                        echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="deleteAgentSpecialty" class="danger">Retirer</button>
            </form>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <div>
                <h3 class="text-center">Supprimer un agent existant</h3>
                <form method="POST" action="delete-agent">
                    <select name ="delete-agent" id="delete-agent" aria-label="Agent">
                        <?php
                        foreach ($agents->showAgents() as $agent) {
                            echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteAgent" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="text-center mt-3">
    <h2>Gestion des spécialités</h2>
    <h3>Liste des spécialités répertoriées</h3>
    <div class="flex-column-center">
        <ul>
            <?php foreach ($specialties->showSpecialties() as $speciality): ?>
                <li  class="text-left">- <?php echo $speciality['name'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div>
    <div class="flex-around">
        <div>
            <h3>Ajouter une nouvelle spécialité</h3>
            <div class="text-center">
                <form method="POST" action="add-specialty">
                    <input type="text" name="name" id="specialty-name" placeholder="Nom" aria-label="Nom">
                    <button type="submit" name="submitSpecialty">Ajouter</button>
                </form>
            </div>
        </div>
        <div>
            <h3>Supprimer une spécialité existante</h3>
            <div class="text-center">
                <form method="POST" action="delete-specialty">
                    <select name ="delete-specialty" id="delete-specialty" aria-label="Spécialité">
                        <?php
                        foreach ($specialties->showSpecialties() as $specialty) {
                            echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteSpecialty" class="danger">Supprimer</button>
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