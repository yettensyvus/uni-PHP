<?php
// Obținem ziua săptămânii în format numeric
$ziua = date("N");

// Stabilim intervalele orare pentru fiecare medic
$orar1 = ($ziua == 1 || $ziua == 3 || $ziua == 5) ? "08:00-12:00" : "Liber"; 
$orar2 = ($ziua == 2 || $ziua == 4 || $ziua == 6) ? "12:00-16:00" : "Liber"; 
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th colspan="3">Orar medici</th>
    </tr>
    <tr>
        <th>Nr.o</th>
        <th>Nume, Prenume</th>
        <th>Orar</th>
    </tr>
    <tr>
        <td>1.</td>
        <td>Axenti Ecaterina</td>
        <td><?php echo $orar1; ?></td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Ailoaiei Elina</td>
        <td><?php echo $orar2; ?></td>
    </tr>
</table>

</body>
</html>
