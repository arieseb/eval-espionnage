<div class="flex-between">
    <h1>Site d'espionnage/</h1>
    <nav>
        <?php require_once 'login.php' ?>
    </nav>
</div>

<a href="index">Retour à l'index</a>
<span> -- </span>
<?php
// TODO Cacher le lien quand on se trouve sur le dashboard en JS
if(isset($_SESSION['email'])): ?>
    <a href="dashboard">Accéder au panneau d'administration</a>
<?php endif; ?>

