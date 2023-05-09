<?php
    use App\Controllers\CountryController;
    use App\Controllers\HideoutController;
    $hideouts = new HideoutController();
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
    <h2>-- Gestion des planques --</h2>
    <h3>Liste des planques répertoriées</h3>
    <table class="m-auto">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($hideouts->showHideouts() as $hideout): ?>
            <tr>
                <td><?php echo $hideout['code'] ?></td>
                <td><?php echo $hideout['type'] ?></td>
                <td><?php echo $hideout['address'] ?></td>
                <td>
                    <?php echo $countries->showCountry($hideout['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-int">
        <div>
            <h3 class="text-center">Ajouter une nouvelle planque</h3>
            <form method="POST" action="add-hideout" class="flex-column-hd">
                <input type="text" name="code" id="hideout-code" placeholder="Nom de code" aria-label="Nom de code" class="mb-1-hd">
                <input type="text" name="type" id="hideout-type" placeholder="Type de planque" aria-label="Type de planque" class="mb-1-hd">
                <input type="text" name="address" id="hideout-address" placeholder="Adresse" aria-label="Adresse" class="mb-1-hd">
                <select name ="country_id" id="hideout-country_id" aria-label="Pays" class="mb-1-hd">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="submitHideout">Ajouter</button>
            </form>
        </div>
        <div>
            <h3>Supprimer une planque existante</h3>
            <div class="text-center">
                <form method="POST" action="delete-hideout">
                    <select name ="delete-hideout" id="delete-hideout" aria-label="Planque">
                        <?php
                        foreach ($hideouts->showHideouts() as $hideout) {
                            echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteHideout" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <h3 class="text-center">Modifier une planque existante</h3>
            <form method="POST" action="update-hideout" class="flex-column-xl">
                <select name ="existing-hideout" id="existing-hideout" aria-label="Planque" class="mb-1-hd">
                    <?php
                    foreach ($hideouts->showHideouts() as $hideout) {
                        echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
                    }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="code" id="hideout-code" placeholder="Nom de code" aria-label="Nom de code" class="mb-1-hd">
                <input type="text" name="type" id="hideout-type" placeholder="Type de planque" aria-label="Type de planque" class="mb-1-hd">
                <input type="text" name="address" id="hideout-address" placeholder="Adresse" aria-label="Adresse" class="mb-1-hd">
                <select name ="country_id" id="hideout-country_id" aria-label="Pays" class="mb-1-hd">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="updateHideout">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>
