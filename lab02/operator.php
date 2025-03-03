<?php
//un exemplu cu if
$varsta = 22;
if (($varsta > 12) && ($varsta < 20)) { //verifica daca vasrta este intre 12 si 20
    $mesaj = " sunteti adolescent";
} elseif ($varsta > 40) { //verifica daca vasrta este mai mare ca 40
    $mesaj = " sunteti om matur!";
} else {
    $mesaj = " sunteti in floarea varstei ...repede la munca!"; //mesaj daca nu satisface nici o conditie
}
//operatorul tertiar
//$nume = "Anisoara";
echo ($nume) ? $nume . ', ' . $mesaj : 'Anonymous,' . $mesaj;

?>