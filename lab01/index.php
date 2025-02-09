<?php

//1. Afișați la ecran propoziția „Perioada concediilor!” folosind instrucțiunea echo și print.
echo "Perioada concediilor!" . "<br>";

print "Perioada concediilor!";

// ! Folosim operatorul . pentru a concatena și "<br>" afișa din rand nou.

// 2. Definiți două variabile în PHP: una de tip întreg cu valoarea 222 și una de tip șir de caractere – ”Toti pleaca la odihna!”

$nr = 222; // Variabilă de tip întreg
$str = "Toti pleaca la odihna!"; // Variabilă de tip șir de caractere

// 3. Afișați valorile variabilelor definite, la ecran, fiecare din rând nou.
echo "<br>" . $nr . "<br>";
echo $str;



/* 
4. Apoi, afișați la ecran șirul de caractere format din valoarea primei variabile concatenate cu cea de-a doua și încă
un text suplimentar, astfel încât să se afișeze la ecran textul ”Este aproximativ a 222 zi din an și ... Toti pleaca la
odihna!”.
*/
$str_concat = "<br>" . "Este aproximativ a " . $nr . " zi din an și ... " . $str;
echo $str_concat;


/* 5. Afișați la ecran, folosind instrucțiunea echo, suma numerelor 45+67, utilizând următoarea sintaxă: echo 45+67.
Apoi încercați să executați echo „45+67” și echo ‚45+67’. Observați diferențele de afișare.
*/

echo "<br>";

// Afișare sumă (calcul matematic)
echo 45+67; // Output: 112

echo "<br>";

// Afișare text ca șir de caractere (ghilimele duble)
echo "45+67"; // Output: 45+67

echo "<br>";

// Afișare text ca șir de caractere (ghilimele simple)
echo '45+67'; // Output: 45+67


//Explicație:
// echo 45+67 - PHP recunoaște expresia ca o operație matematică și afișează rezultatul 112.

// echo "45+67"; și echo '45+67';
// Deoarece valorile sunt încadrate în ghilimele, PHP le interpretează ca șiruri de caractere și afișează textul exact "45+67" fără a efectua adunarea.


// 6. Afișați la ecran Cartea “Eroul” va aparea in octombrie, acest an. Utilizați corect ghilimelele!

echo "<br>";

// Folosim ghilimele simple pentru șir și ghilimele duble în interior
echo 'Cartea “Eroul” va apărea în octombrie, acest an.';

echo "<br>";


// 8. Adăugați un vers și afișați-l:

echo "<h2> Cobori in jos Luceafar bland <br/> Alunecand pe-o raza …</h2>";

?>