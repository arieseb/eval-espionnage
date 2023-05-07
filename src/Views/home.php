<?php
    ob_start();
    include 'missionTable.php';
?>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
