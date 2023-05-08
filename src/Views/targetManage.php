<?php
use App\Controllers\CountryController;
use App\Controllers\TargetController;
$targets = new TargetController();
$countries = new CountryController();
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
    <h2>Gestion des cibles</h2>
    <h3>Liste des cibles répertoriées</h3>
    <table class="m-auto">
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
                <td><?php echo date_format(new DateTime($target['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($target['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around">
        <div>
            <h3>Ajouter une nouvelle cible</h3>
            <form method="POST" action="add-target">
                <input type="text" name="codename" id="target-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="target-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="target-lastname" placeholder="Nom" aria-label="Nom">
                <label for="target-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="target-birthdate">
                <label for="target-country_id">Nationalité : </label>
                <select name ="country_id" id="target-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="submitTarget">Ajouter</button>
            </form>
        </div>
        <div>
            <h3>Supprimer une cible existante</h3>
            <div class="text-center">
                <form method="POST" action="delete-target">
                    <select name ="delete-target" id="delete-target" aria-label="Cible">
                        <?php
                        foreach ($targets->showTargets() as $target) {
                            echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteTarget" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <h3>Modifier une cible existante</h3>
            <form method="POST" action="update-target">
                <select name ="existing-target" id="existing-target" aria-label="Cible">
                    <?php
                    foreach ($targets->showTargets() as $target) {
                        echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                    }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="codename" id="target-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="target-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="target-lastname" placeholder="Nom" aria-label="Nom">
                <label for="target-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="target-birthdate">
                <label for="target-country_id">Nationalité : </label>
                <select name ="country_id" id="target-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="updateTarget">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>
