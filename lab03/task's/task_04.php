<html>

<body>

    <?php
    $noteInfo = array(
        array(1, "Ivanov", "Ivan", 7),
        array(2, "Covaliov", "Catalina", 9),
        array(3, "Avanesov", "Tatiana", 8),
        array(4, "Gurau", "Ana", 10),
        array(5, "Dedin", "Catalin", 9),
        array(6, "Chitoroaga", "Vera", 8),
        array(7, "Josan", "Caterina", 7),
        array(8, "Popescu", "Mihai", 10),
        array(9, "Rusu", "Daniel", 6)
    );
    ?>

    <table border="1">
        <tr style="background-color: green; color: white">
            <th colspan="4">Notele elevilor clasei a 10-a, la informatică</th>
        </tr>
        <tr style="background-color: green; color: white">
            <th>Nr.</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Nota</th>
        </tr>

        <?php
        for ($linie = 0; $linie < count($noteInfo); $linie++) {
            echo "<tr>";
            for ($coloana = 0; $coloana < count($noteInfo[$linie]); $coloana++) {
                echo "<td>" . $noteInfo[$linie][$coloana] . "</td>";
            }
            echo "</tr>";
        }
        ?>

    </table>

    <?php
    // Funcție pentru calculul mediei
    function calculMedie($noteInfo)
    {
        $suma = 0;
        $nrElevi = count($noteInfo);

        foreach ($noteInfo as $elev) {
            $suma += $elev[3];
        }

        $medie = $suma / $nrElevi;
        echo "<br/>Media notelor elevilor este: " . number_format($medie, 2);
    }

    // Funcție pentru numărarea elevilor cu nota >= 8
    function numaraEleviDeNotaMare($noteInfo)
    {
        $nrElevi = 0;

        foreach ($noteInfo as $elev) {
            if ($elev[3] >= 8) {
                $nrElevi++;
            }
        }

        echo "<br/>Numărul de elevi cu nota ≥ 8: " . $nrElevi;
    }

    // Apelarea funcțiilor
    calculMedie($noteInfo);
    numaraEleviDeNotaMare($noteInfo);
    ?>

</body>

</html>