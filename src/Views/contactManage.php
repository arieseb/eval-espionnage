<?php
    use App\Controllers\CountryController;
    use App\Controllers\ContactController;
    $contacts = new ContactController();
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
<h1>Gestion des contacts</h1>
<h2>Liste des contacts répertoriés</h2>
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
    <?php foreach ($contacts->showContacts() as $contact): ?>
        <tr>
            <td><?php echo $contact['codename'] ?></td>
            <td><?php echo $contact['firstname'] ?></td>
            <td><?php echo $contact['lastname'] ?></td>
            <td><?php echo date_format(new \DateTime($contact['birthdate']), 'd/m/Y') ?></td>
            <td>
                <?php echo $countries->showNationality($contact['country_id']); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h2>Ajouter un nouveau contact</h2>
<form method="POST" action="add-contact">
    <input type="text" name="codename" id="contact-codename" placeholder="Nom de code">
    <input type="text" name="firstname" id="contact-firstname" placeholder="Prénom">
    <input type="text" name="lastname" id="contact-lastname" placeholder="Nom">
    <input type="date" name="birthdate" id="contact-birthdate">
    <select name ="country_id" id="contact-country_id">
        <?php
        foreach ($countries->showCountries() as $country) {
            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="submitContact">Ajouter</button>
</form>
<h2>Modifier un contact existant</h2>
<form method="POST" action="update-contact">
    <select name ="existing-contact" id="existing-contact">
        <?php
        foreach ($contacts->showContacts() as $contact) {
            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
        }
        // TODO Placeholder dynamique en JS
        ?>
    </select>
    <input type="text" name="codename" id="contact-codename" placeholder="Nom de code">
    <input type="text" name="firstname" id="contact-firstname" placeholder="Prénom">
    <input type="text" name="lastname" id="contact-lastname" placeholder="Nom">
    <input type="date" name="birthdate" id="contact-birthdate">
    <select name ="country_id" id="contact-country_id">
        <?php
        foreach ($countries->showCountries() as $country) {
            echo '<option value="'.$country['id'].'">'.$country['nationality'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="updateContact">Modifier</button>
</form>
<h2>Supprimer un contact existant</h2>
<form method="POST" action="delete-contact">
    <select name ="delete-contact" id="delete-contact">
        <?php
        foreach ($contacts->showContacts() as $contact) {
            echo '<option value="'.$contact['id'].'">'.$contact['codename'].'</option>';
        }
        ?>
    </select>
    <button type="submit" name="deleteContact">Supprimer</button>
</form>
<?php endif; ?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
