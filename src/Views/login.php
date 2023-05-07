<?php if (!isset($_SESSION['email'])): ?>
    <form method="POST" action="login">
        <input type="text" name="email" id="email" placeholder="E-mail">
        <input type="text" name="password" id="password" placeholder="Mot de passe">
        <button type="submit" name="submit">Se connecter</button>
    </form>
<?php endif; ?>

<?php if(isset($_SESSION['email'])): ?>
    <p>
        Vous êtes connecté en tant que "<?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'] ?>"
        <a href="logout">Se déconnecter</a>
    </p>
<?php endif; ?>

<?php
// TODO Cacher le lien quand on se trouve sur le dashboard en JS
if(isset($_SESSION['email'])): ?>
    <a href="dashboard">Accéder au panneau d'administration</a>
<?php endif; ?>