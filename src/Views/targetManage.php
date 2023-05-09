<?php
use App\Controllers\CountryController;
use App\Controllers\TargetController;
$targets = new TargetController();
$countries = new CountryController();
ob_start();
?>
<?php if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN'): ?>
    <div class="text-center">
        <h1>-- CONFIDENTIEL --</h1>
        <p>Vous n'êtes pas autorisé à consulter cette page</p>
    </div>
<?php else: ?>
<?php include 'adminHeader.php'?>
<div class="text-center mt-3">
    <h2>-- Gestion des cibles --</h2>
    <h3>Liste des cibles répertoriées</h3>
    <table class="m-auto">
        <thead>
        <tr>
            <th>Nom de code</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th class="hidden-int">Date de naissance</th>
            <th>Nationalité</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($targets->showTargets() as $target): ?>
            <tr>
                <td><?php echo $target['codename'] ?></td>
                <td><?php echo $target['firstname'] ?></td>
                <td><?php echo $target['lastname'] ?></td>
                <td class="hidden-int"><?php echo date_format(new DateTime($target['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($target['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3>Ajouter une nouvelle cible</h3>
            <form method="POST" action="add-target" class="flex-column-fhd">
                <input type="text" name="codename" id="target-codename" placeholder="Nom de code" aria-label="Nom de code"class="mb-1-fhd">
                <input type="text" name="firstname" id="target-firstname" placeholder="Prénom" aria-label="Prénom"class="mb-1-fhd">
                <input type="text" name="lastname" id="target-lastname" placeholder="Nom" aria-label="Nom"class="mb-1-fhd">
                <span>
                    <label for="target-birthdate">Date de naissance : </label>
                    <input type="date" name="birthdate" id="target-birthdate"class="mb-1-fhd">
                </span>
                <span>
                    <label for="target-country_id">Nationalité : </label>
                    <select name ="country_id" id="target-country_id"class="mb-1-fhd">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                        }
                        ?>
                    </select>
                </span>
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
            <form method="POST" action="update-target" class="flex-column-hd">
                <select name ="existing-target" id="existing-target" aria-label="Cible" class="mb-1-hd">
                    <?php
                    foreach ($targets->showTargets() as $target) {
                        echo '<option value="'.$target['id'].'">'.$target['codename'].'</option>';
                    }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="codename" id="target-codename" placeholder="Nom de code" aria-label="Nom de code" class="mb-1-hd">
                <input type="text" name="firstname" id="target-firstname" placeholder="Prénom" aria-label="Prénom" class="mb-1-hd">
                <input type="text" name="lastname" id="target-lastname" placeholder="Nom" aria-label="Nom" class="mb-1-hd">
                <span>
                    <label for="target-birthdate">Date de naissance : </label>
                    <input type="date" name="birthdate" id="target-birthdate"class="mb-1-hd">
                </span>
                <span>
                    <label for="target-country_id">Nationalité : </label>
                    <select name ="country_id" id="target-country_id"class="mb-1-hd">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                        }
                        ?>
                    </select>
                </span>
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
