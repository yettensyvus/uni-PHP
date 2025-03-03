<?php
$nume = 'Amariei';
$prenume = 'Petru';
echo 'Numele de familie al clientului este '.$nume. ', iar prenumele este ' .$prenume . '.';

$varsta = 30;
print '<br />Varsta clientului este ' .$varsta .'.';

// Verificăm ziua curentă
$d = date("D"); //returneaza ziua curenta in format text prescurtat
if ($d == "Fri") {
    echo "<br />Un weekend placut in continuare!";
} elseif ($d == "Sun") {
    echo "<br />De maine incepe o saptamana de lucru...dar azi va mai odihniti!";
} else {
    echo "<br />O zi de munca placuta sa aveti!!";
}

//Am înlocuit structura if...else cu operatorul ternar, care este mai compact și eficient. 
// ? fiind valoarea adevarata, dupa : este valoarea falsa

echo ($d == "Fri") ? "<br />Un weekend placut in continuare!" : "<br />O zi de munca placuta sa aveti!!";


//Înlocuim date("D") cu date("w"), care returnează un număr între 0 și 6 (0 = duminică, 6 = sâmbătă):

$d = date("w"); //returneaza ziua curenta in format numeric 
if ($d == 5) { // Vineri
    echo "<br />Un weekend placut in continuare!";
} elseif ($d == 0) { // Duminică
    echo "<br />De maine incepe o saptamana de lucru...dar azi va mai odihniti!";
} else {
    echo "<br />O zi de munca placuta sa aveti!!";
}
?>
