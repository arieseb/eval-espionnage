<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header></header>
        <nav>
            <?php require_once 'login.php' ?>
        </nav>
        <main>
            <?php echo $content; ?>
        </main>
        <footer></footer>
    </body>
</html>
