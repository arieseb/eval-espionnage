<div class=" flex-column-xl flex-between">
    <h1 id="site-title">Site d'espionnage/</h1>
    <nav>
        <?php require_once 'login.php' ?>
    </nav>
</div>
<div class="flex-column-md">
    <a href="index" class="index">Retour à l'index</a>
    <?php if(isset($_SESSION['email'])): ?>
    <span id="dashboard-link">
        <span class="hidden-md index"> -- </span>
        <a href="dashboard">Accéder au panneau d'administration</a>
    </span>
    <?php endif; ?>
</div>



