<?php
    use App\Controllers\CountryController;
    use App\Controllers\ContactController;
    $contacts = new ContactController();
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
    <h2>Gestion des contacts</h2>
    <h3>Liste des contacts répertoriés</h3>
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
        <?php foreach ($contacts->showContacts() as $contact): ?>
            <tr>
                <td><?php echo $contact['codename'] ?></td>
                <td><?php echo $contact['firstname'] ?></td>
                <td><?php echo $contact['lastname'] ?></td>
                <td><?php echo date_format(new DateTime($contact['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($contact['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around">
        <div>
            <h3 class="text-center">Ajouter un nouveau contact</h3>
            <form method="POST" action="add-contact">
                <input type="text" name="codename" id="contact-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="contact-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="contact-lastname" placeholder="Nom" aria-label="Nom">
                <label for="contact-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="contact-birthdate">
                <label for="contact-country_id">Nationalité : </label>
                <select name ="country_id" id="contact-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="submitContact">Ajouter</button>
            </form>
        </div>
        <div>
            <h3>Supprimer un contact existant</h3>
            <div class="text-center">
                <form method="POST" action="delete-contact">
                    <select name ="delete-contact" id="delete-contact" aria-label="Contact">
                        <?php
                        foreach ($contacts->showContacts() as $contact) {
                            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" name="deleteContact" class="danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-3 flex-around">
        <div>
            <h3 class="text-center">Modifier un contact existant</h3>
            <form method="POST" action="update-contact">
                <select name ="existing-contact" id="existing-contact" aria-label="Contact">
                    <?php
                    foreach ($contacts->showContacts() as $contact) {
                        echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                    }
                    // TODO Placeholder dynamique en JS
                    ?>
                </select>
                <input type="text" name="codename" id="contact-codename" placeholder="Nom de code" aria-label="Nom de code">
                <input type="text" name="firstname" id="contact-firstname" placeholder="Prénom" aria-label="Prénom">
                <input type="text" name="lastname" id="contact-lastname" placeholder="Nom" aria-label="Nom">
                <label for="contact-birthdate">Date de naissance : </label>
                <input type="date" name="birthdate" id="contact-birthdate">
                <label for="contact-country_id">Nationalité : </label>
                <select name ="country_id" id="contact-country_id">
                    <?php
                    foreach ($countries->showCountries() as $country) {
                        echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="updateContact">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>
