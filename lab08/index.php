<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = trim($_POST['nume']);
    $email = trim($_POST['email']);
    $mesaj = trim($_POST['mesaj']);

    if (!empty($nume) && !empty($email) && !empty($mesaj) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $data = "$nume, $mesaj\n";

        file_put_contents('date.txt', $data, FILE_APPEND | LOCK_EX);

        include 'form1.html';
        include 'output.php';
    } else {
        echo "Vă rugăm să completați toate câmpurile corect!";
        include 'form.html';
    }
} else {
    include 'form.html';
}
?>