<?php
    use App\Controllers\CountryController;
    use App\Controllers\ContactController;
    $contacts = new ContactController();
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
    <h2>-- Gestion des contacts --</h2>
    <h3>Liste des contacts répertoriés</h3>
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
        <?php foreach ($contacts->showContacts() as $contact): ?>
            <tr>
                <td><?php echo $contact['codename'] ?></td>
                <td><?php echo $contact['firstname'] ?></td>
                <td><?php echo $contact['lastname'] ?></td>
                <td class="hidden-int"><?php echo date_format(new DateTime($contact['birthdate']), 'd/m/Y') ?></td>
                <td>
                    <?php echo $countries->showNationality($contact['country_id']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="flex-around flex-column-lg-center">
        <div>
            <h3 class="text-center">Ajouter un nouveau contact</h3>
            <form method="POST" action="add-contact" class="flex-column-fhd">
                <input type="text" name="codename" id="contact-codename" placeholder="Nom de code" aria-label="Nom de code" class="mb-1-fhd">
                <input type="text" name="firstname" id="contact-firstname" placeholder="Prénom" aria-label="Prénom" class="mb-1-fhd">
                <input type="text" name="lastname" id="contact-lastname" placeholder="Nom" aria-label="Nom" class="mb-1-fhd">
                <span>
                    <label for="contact-birthdate">Date de naissance : </label>
                    <input type="date" name="birthdate" id="contact-birthdate" class="mb-1-fhd">
                </span>
                <span>
                    <label for="contact-country_id">Nationalité : </label>
                    <select name ="country_id" id="contact-country_id" class="mb-1-fhd">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                        }
                        ?>
                    </select>
                </span>
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
            <form method="POST" action="update-contact" class="flex-column-hd">
                <select name ="existing-contact" id="existing-contact-select" aria-label="Contact" class="mb-1-hd">
                    <?php
                    foreach ($contacts->showContacts() as $contact) {
                        echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
                    }
                    ?>
                </select>
                <input type="text" name="codename" id="contact-codename-input" aria-label="Nom de code"class="mb-1-hd">
                <input type="text" name="firstname" id="contact-firstname-input" aria-label="Prénom"class="mb-1-hd">
                <input type="text" name="lastname" id="contact-lastname-input" aria-label="Nom"class="mb-1-hd">
                <span>
                    <label for="contact-birthdate">Date de naissance : </label>
                    <input type="date" name="birthdate" id="contact-birthdate-input" class="mb-1-hd">
                </span>
                <span>
                    <label for="contact-country_id">Nationalité : </label>
                    <select name ="country_id" id="contact-country_id-select" class="mb-1-hd">
                        <?php
                        foreach ($countries->showCountries() as $country) {
                            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
                        }
                        ?>
                    </select>
                </span>
                <button type="submit" name="updateContact">Modifier</button>
            </form>
        </div>
    </div>
</div>
<script src="./scripts/contact.js"></script>
<?php endif; ?>
<?php
    $content = ob_get_clean();
    include 'layout.php';
?>
