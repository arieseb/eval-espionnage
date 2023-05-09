<div class=" flex-column-xl flex-between">
    <h1>Site d'espionnage/</h1>
    <nav>
        <?php require_once 'login.php' ?>
    </nav>
</div>
<div class="flex-column-md">
    <a href="index">Retour à l'index</a>
    <?php
    // TODO Cacher le lien quand on se trouve sur le dashboard en JS
    if(isset($_SESSION['email'])): ?>
        <span class="hidden-md"> -- </span>
        <a href="dashboard">Accéder au panneau d'administration</a>
    <?php endif; ?>
</div>


