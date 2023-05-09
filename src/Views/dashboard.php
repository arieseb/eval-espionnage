<?php
    use App\Controllers\CountryController;
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
    <h2>-- Gestion des pays --</h2>
    <h3>Liste des pays répertoriés</h3>
    <table class="m-auto">
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
</div>
<div class="mt-3">
    <div class="flex-around flex-column-int">
        <div>
            <h3 class="text-center">Ajouter un nouveau pays</h3>
            <form method="POST" action="add-country" class="flex-column-hd">
                <input type="text" name="name" id="country-name" placeholder="Nom du pays" aria-label="Nom du pays" class="mb-1-hd">
                <input type="text" name="nationality" id="nationality" placeholder="Nationalité liée" aria-label="Nationalité liée" class="mb-1-hd">
                <button type="submit" name="submitCountry">Ajouter</button>
            </form>
        </div>
        <div>
            <h3 class="text-center">Modifier un pays existant</h3>
            <form method="POST" action="update-country" class="flex-column-hd">
                <select name ="existing-country" id="existing-country" aria-label="Pays" class="mb-1-hd">
                    <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                        }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="name" id="country-name" placeholder="Nom du pays" aria-label="Nom du pays" class="mb-1-hd">
                <input type="text" name="nationality" id="country-nationality" placeholder="Nationalité liée" aria-label="Nationalité liée" class="mb-1-hd">
                <button type="submit" name="updateCountry">Modifier</button>
            </form>
        </div>
        <div>
            <h3>Supprimer un pays existant</h3>
            <div class="text-center">
                <form method="POST" action="delete-country">
                    <select name ="delete-country" id="delete-country" aria-label="Nom du pays" class="mb-1-hd">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteCountry" class="danger">Supprimer</button>
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

