<?php
    use App\Controllers\CountryController;
    use App\Controllers\HideoutController;
    $hideouts = new HideoutController();
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
<h1>Gestion des planques</h1>
<h2>Liste des planques répertoriées</h2>
<table>
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
<h2>Ajouter une nouvelle planque</h2>
<form method="POST" action="add-hideout">
    <input type="text" name="code" id="hideout-code" placeholder="Nom de code">
    <input type="text" name="type" id="hideout-type" placeholder="Type de planque">
    <input type="text" name="address" id="hideout-address" placeholder="Adresse">
    <select name ="country_id" id="hideout-country_id">
        <?php
        foreach ($countries->showCountries() as $country) {
            echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="submitHideout">Ajouter</button>
</form>
<h2>Modifier une planque existante</h2>
<form method="POST" action="update-hideout">
    <select name ="existing-hideout" id="existing-hideout">
        <?php
        foreach ($hideouts->showHideouts() as $hideout) {
            echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
        }
        // TODO Placeholder dynamique en JS
        ?>
    </select>
    <input type="text" name="code" id="hideout-code" placeholder="Nom de code">
    <input type="text" name="type" id="hideout-type" placeholder="Type de planque">
    <input type="text" name="address" id="hideout-address" placeholder="Adresse">
    <select name ="country_id" id="hideout-country_id">
        <?php
        foreach ($countries->showCountries() as $country) {
            echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="updateHideout">Modifier</button>
</form>
<h2>Supprimer une planque existante</h2>
<form method="POST" action="delete-hideout">
    <select name ="delete-hideout" id="delete-hideout">
        <?php
        foreach ($hideouts->showHideouts() as $hideout) {
            echo '<option value="'.$hideout['id'].'">'.$hideout['code'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="deleteHideout">Supprimer</button>
</form>
<?php endif; ?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
