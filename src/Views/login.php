<?php if (!isset($_SESSION['email'])): ?>
    <form method="POST" action="login" class="flex-column-lg">
        <span class="mb-1-lg">Connexion<span class="hidden-lg"> --></span></span>
        <input type="text" name="email" id="email" placeholder="E-mail" aria-label="E-mail" class="mb-1-lg">
        <input type="password" name="password" id="password" class="password mb-1-lg" placeholder="Mot de passe" aria-label="Mot de passe">
        <button type="submit" name="submit" class="mb-1-lg">Se connecter</button>
    </form>
<?php endif; ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN'): ?>
    <p class="flex-column-lg">
        <span>Vous êtes connecté en tant que "<?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'] ?>"</span>
        <span><span class="hidden-lg">--> </span><a href="logout">Se déconnecter ?</a></span>
    </p>
<?php endif; ?>