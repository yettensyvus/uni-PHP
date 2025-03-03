<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Șah</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }
        td, th {
            width: 50px;
            height: 50px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid black;
        }
        .black {
            background-color: black;
        }
        .white {
            background-color: white;
        }
        .header, .side {
            background-color: gray;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

<table>
    <!-- Rândul cu literele A-H -->
    <tr>
        <th class="header"></th>
        <?php 
        for ($col = 0; $col < 8; $col++) {
            echo "<th class='header'>" . chr(65 + $col) . "</th>"; 
        }
        echo "<th class='header'></th>";
        ?>
    </tr>

    <!-- Generarea tablei de șah -->
    <?php
    for ($row = 1; $row <= 8; $row++) {
        echo "<tr>";
        echo "<th class='side'>$row</th>"; // Numerotarea din stânga (1 -> 8)

        for ($col = 0; $col < 8; $col++) {
            $color = ($row + $col) % 2 == 0 ? "black" : "white";
            echo "<td class='$color'></td>";
        }

        echo "<th class='side'>" . (9 - $row) . "</th>"; // Numerotarea din dreapta (8 -> 1)
        echo "</tr>";
    }
    ?>

    <!-- Rândul de jos cu literele H-A -->
    <tr>
        <th class="header"></th>
        <?php 
        for ($col = 7; $col >= 0; $col--) {
            echo "<th class='header'>" . chr(65 + $col) . "</th>";
        }
        echo "<th class='header'></th>";
        ?>
    </tr>
</table>

</body>
</html>
