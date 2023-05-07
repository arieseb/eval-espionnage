<?php
use App\Controllers\CountryController;
use App\Controllers\TargetController;
$targets = new TargetController();
$countries = new CountryController();
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
    <h1>Gestion des cibles</h1>
    <h2>Liste des cibles répertoriées</h2>
    <table>
        <thead>
        <tr>
            <th>Nom de code</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Nationalité</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($targets->showTargets() as $target): ?>
            <tr>
                <td><?php echo $target['codename'] ?></td>
                <td><?php echo $target['firstname'] ?></td>
                <td><?php echo $target['lastname'] ?></td>
                <td><?php echo date_format(new \DateTime($target['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($target['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Ajouter une nouvelle cible</h2>
    <form method="POST" action="add-target">
        <input type="text" name="codename" id="target-codename" placeholder="Nom de code">
        <input type="text" name="firstname" id="target-firstname" placeholder="Prénom">
        <input type="text" name="lastname" id="target-lastname" placeholder="Nom">
        <input type="date" name="birthdate" id="target-birthdate">
        <select name ="country_id" id="hideout-country_id">
            <?php
            foreach ($countries->showCountries() as $country) {
                echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="submitTarget">Ajouter</button>
    </form>
    <h2>Modifier une cible existante</h2>
    <form method="POST" action="update-target">
        <select name ="existing-target" id="existing-target">
            <?php
            foreach ($targets->showTargets() as $target) {
                echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
            }
            // TODO Placeholder dynamique en JS
            ?>
        </select>
        <input type="text" name="codename" id="target-codename" placeholder="Nom de code">
        <input type="text" name="firstname" id="target-firstname" placeholder="Prénom">
        <input type="text" name="lastname" id="target-lastname" placeholder="Nom">
        <input type="date" name="birthdate" id="target-birthdate">
        <select name ="country_id" id="target-country_id">
            <?php
            foreach ($countries->showCountries() as $country) {
                echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="updateTarget">Modifier</button>
    </form>
    <h2>Supprimer une cible existante</h2>
    <form method="POST" action="delete-target">
        <select name ="delete-target" id="delete-target">
            <?php
            foreach ($targets->showTargets() as $target) {
                echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
            }
            ?>
        </select>
        <button type="submit" name="deleteTarget">Supprimer</button>
    </form>
<?php endif; ?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
