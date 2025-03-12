<body>
<?php if (!isset($_REQUEST['start'])) { ?>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
        <p><label>Prenumele dvoastră: <input name="prenume" type="text" size="30" required /></label></p>
        <p><label>Vârsta: <input name="varsta" type="number" min="1" max="120" required /></label></p>
        <p><label>E-mail: <input name="email" type="email" size="30" required /></label></p>
        <p><label>Lasati mai jos mesajul dvoastra:<br />
        <textarea name="mes" cols="40" rows="4" placeholder="Aici..." required></textarea></label></p>
        <p>
            <input type="reset" value="Anulează" />
            <input type="submit" value="Transmite" name="start" />
        </p>
    </form>
<?php 
} else {
    // Preluarea datelor din formular
    $pren = isset($_POST['prenume']) ? $_POST['prenume'] : "";
    $varsta = isset($_POST['varsta']) ? $_POST['varsta'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $mesaj = isset($_POST['mes']) ? $_POST['mes'] : "";

    // Deschiderea fișierului pentru adăugarea datelor
    $file = fopen('mesaje.txt', 'a+') or die("Fisier inaccesibil!");
    fwrite($file, "$pren\t$varsta\t$email\t$mesaj\n");
    fclose($file);

    echo "<h3>Datele au fost salvate! Iată ce este în fișier:</h3>";

    // Afișarea datelor într-un tabel
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Prenume</th><th>Vârsta</th><th>Email</th><th>Mesaj</th></tr>";

    $file = fopen("mesaje.txt", "r") or die("Fisier inaccesibil!");
    while (($line = fgets($file)) !== false) {
        $date = explode("\t", trim($line));
        if (count($date) == 4) {
            echo "<tr>";
            foreach ($date as $data) {
                echo "<td>" . htmlspecialchars($data) . "</td>";
            }
            echo "</tr>";
        }
    }
    fclose($file);

    echo "</table>";
}
?>
</body>
