<?php
// Obtinem ziua saptamanii în format numeric
$ziua_num = date("w");

// Obtinem data curenta în format zi.luna.an
$data = date("d.m.Y");

// Folosim switch pentru a seta valoarea zilei
switch ($ziua_num) {
    case 0:
        $ziua = "Duminica";
        break;
    case 1:
        $ziua = "Luni";
        break;
    case 2:
        $ziua = "Marti";
        break;
    case 3:
        $ziua = "Miercuri";
        break;
    case 4:
        $ziua = "Joi";
        break;
    case 5:
        $ziua = "Vineri";
        break;
    case 6:
        $ziua = "Sambata";
        break;
    default:
        $ziua = "Zi necunoscuta";
}

// Afisăm mesajul final
echo "Azi este $ziua, $data.";
?>
