<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/style.css"
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php require_once 'header.php' ?>
        </header>
        <main>
            <?php
                if (!empty($_SESSION['error'])) {
                    echo '<div class="alert">' . $_SESSION['error'] . '</div>';
                    unset ($_SESSION['error']);
            }
            ?>
            <?php echo $content ?>
        </main>
        <footer>
            <?php require_once 'footer.php' ?>
        </footer>
        <script src="./scripts/home.js"></script>
    </body>
</html>
