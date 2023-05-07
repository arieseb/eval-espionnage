<?php
    use App\Controllers\CountryController;
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
    <div>
        <h1>Panneau d'administration</h1>
    </div>
    <div>
        <h2>Gestion des pays</h2>
        <h3>Liste des pays répertoriés</h3>
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Nationalité liée</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($countries->showCountries() as $country): ?>
                <tr>
                    <td><?php echo $country['name'] ?></td>
                    <td><?php echo $country['nationality'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Ajouter un nouveau pays</h3>
        <form method="POST" action="add-country">
            <input type="text" name="name" id="country-name" placeholder="Nom du pays">
            <input type="text" name="nationality" id="nationality" placeholder="Nationalité liée">
            <button type="submit" name="submitCountry">Ajouter</button>
        </form>
        <h3>Modifier un pays existant</h3>
        <form method="POST" action="update-country">
            <select name ="existing-country" id="existing-country">
                <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                    }
                // TODO Placeholder dynamique en JS
                ?>
            </select>
            <input type="text" name="name" id="country-name" placeholder="Nom du pays">
            <input type="text" name="nationality" id="country-nationality" placeholder="Nationalité liée">
            <button type="submit" name="updateCountry">Modifier</button>
        </form>
        <h3>Supprimer un pays existant</h3>
        <form method="POST" action="delete-country">
            <select name ="delete-country" id="delete-country">
                <?php
                foreach ($countries->showCountries() as $country) {
                    echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                }
                ?>
            </select>
            <button type="submit" name="deleteCountry">Supprimer</button>
        </form>
        <a href="hideout-manage">Gérer les planques</a>
        <a href="contact-manage">Gérer les contacts</a>
        <a href="target-manage">Gérer les cibles</a>
        <a href="agent-manage">Gérer les agents et leurs spécialités</a>
        <a href="mission-manage">Gérer les missions</a>
    </div>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>

