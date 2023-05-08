<?php ob_start();?>

<p class="my-5 text-center">
    -- Dans l'éventualité où la guerre froide se réchaufferait au point d'atteindre le niveau de la crise des missiles de
    Cuba, cette interface permettra de déployer des agents pour accomplir leur devoir au nom de la Mère-Patrie. --
</p>

<?php   include 'missionTable.php';?>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
