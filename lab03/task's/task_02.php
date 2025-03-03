<?php
/*
$i = 0;
$num = 50;
while ($i < 10) {
    $num--;
    $i++;
}
echo ("<br />Ciclul s-a terminat la i = $i si num = $num");
*/

$i = 0;
$num = 50;

while ($i < 10) {
    echo "Înainte de modificare: i = $i, num = $num <br />";
    $num--;
    $i++;
    echo "După modificare: i = $i, num = $num <br /><br />";
}

echo "<br />Ciclul s-a terminat la i = $i si num = $num";
?>