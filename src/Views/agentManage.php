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
<div>
    <a href="index">Retour à l'index</a>
</div>
<?php if (!isset($_SESSION['email'])): ?>
    <div>
        <h1>CONFIDENTIEL</h1>
        <p>Vous n'êtes pas autorisé à consulter cette page</p>
    </div>
<?php else: ?>
    <h1>Gestion des agents</h1>
    <h2>Liste des agents répertoriés</h2>
    <table>
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
                <td><?php echo date_format(new \DateTime($agent['birthdate']), 'd/m/Y') ?></td>
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
    <h2>Ajouter un nouvel agent</h2>
    <form method="POST" action="add-agent">
        <input type="text" name="codename" id="agent-codename" placeholder="Nom de code">
        <input type="text" name="firstname" id="agent-firstname" placeholder="Prénom">
        <input type="text" name="lastname" id="agent-lastname" placeholder="Nom">
        <input type="date" name="birthdate" id="agent-birthdate">
        <select name ="country_id" id="agent-country_id">
            <?php
            foreach ($countries->showCountries() as $country) {
                echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
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
        <button type="submit" name="submitAgent">Ajouter</button>
    </form>
    <h2>Modifier un agent existant</h2>
    <form method="POST" action="update-agent">
        <select name ="existing-agent" id="existing-agent">
            <?php
            foreach ($agents->showAgents() as $agent) {
                echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <input type="text" name="codename" id="agent-codename" placeholder="Nom de code">
        <input type="text" name="firstname" id="agent-firstname" placeholder="Prénom">
        <input type="text" name="lastname" id="agent-lastname" placeholder="Nom">
        <input type="date" name="birthdate" id="agent-birthdate">
        <select name ="country_id" id="agent-country_id">
            <?php
            foreach ($countries->showCountries() as $country) {
                echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="updateAgent">Modifier</button>
    </form>
    <h2>Supprimer un agent existant</h2>
    <form method="POST" action="delete-agent">
        <select name ="delete-agent" id="delete-agent">
            <?php
            foreach ($agents->showAgents() as $agent) {
                echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="deleteAgent">Supprimer</button>
    </form>
    <h2>Ajouter une spécialité à un agent</h2>
    <form method="POST" action="add-agent-specialty">
        <select name ="existing-agent" id="existing-agent">
            <?php
            foreach ($agents->showAgents() as $agent) {
                echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
            }
            ?>
        </select>
        <select name ="existing-specialty" id="existing-specialty">
            <?php
            foreach ($specialties->showSpecialties() as $specialty) {
                echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="addAgentSpecialty">Ajouter</button>
    </form>
    <h2>Retirer une spécialité à un agent</h2>
    <form method="POST" action="delete-agent-specialty">
        <select name ="existing-agent" id="existing-agent">
            <?php
            foreach ($agents->showAgents() as $agent) {
                echo '<option value="'.$agent['id'].'">'.$agent['codename'].'</option>';
            }
            ?>
        </select>
        <select name ="existing-specialty" id="existing-specialty">
            <?php
            foreach ($specialties->showSpecialties() as $specialty) {
                echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="deleteAgentSpecialty">Retirer</button>
    </form>
<!-- Gestion des spécialités -->
    <h2>Gestion des spécialités</h2>
    <h3>Liste des spécialités répertoriées</h3>
    <table>
        <thead>
        <tr>
            <th>Nom</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($specialties->showSpecialties() as $speciality): ?>
            <tr>
                <td><?php echo $speciality['name'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Ajouter une nouvelle spécialité</h3>
    <form method="POST" action="add-specialty">
        <input type="text" name="name" id="specialty-name" placeholder="Nom">
        <button type="submit" name="submitSpecialty">Ajouter</button>
    </form>
    <h3>Modifier une spécialité existante</h3>
    <form method="POST" action="update-specialty">
        <select name ="existing-specialty" id="existing-specialty">
            <?php
            foreach ($specialties->showSpecialties() as $specialty) {
                echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <input type="text" name="name" id="specialty-name" placeholder="Nom">
        <button type="submit" name="updateSpecialty">Modifier</button>
    </form>
    <h3>Supprimer une spécialité existante</h3>
    <form method="POST" action="delete-specialty">
        <select name ="delete-specialty" id="delete-specialty">
            <?php
            foreach ($specialties->showSpecialties() as $specialty) {
                echo '<option value="'.$specialty['id'].'">'.$specialty['name'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="deleteSpecialty">Supprimer</button>
    </form>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>