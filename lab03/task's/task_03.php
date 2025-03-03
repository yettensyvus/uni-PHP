<?php
/*
$adaos = 7;
$pret = 120;
do {
    $pret = $pret + $adaos;
    $adaos++;
}
while ($adaos < 10);
echo ("<br />Pretul nou va fi -- $pret");
*/


$adaos = 7;
$pret = 120;

do {
    echo "Înainte de modificare: pret = $pret, adaos = $adaos <br />";
    $pret = $pret + $adaos;
    $adaos++;
    echo "După modificare: pret = $pret, adaos = $adaos <br /><br />";
} while ($adaos < 10);

echo "<br />Pretul nou va fi -- $pret";
?>