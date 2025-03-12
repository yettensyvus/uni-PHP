<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/homework");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            height: 100vh; /* Full viewport height */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text inside container */
        }
        table {
            margin: 20px auto; /* Center the table */
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #5cb85c;
            color: white;
        }
        .logout-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .logout-link:hover {
            background-color: #c9302c;
        }
        img {
            max-width: 300px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bun venit, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <h2>Utilizatori înregistrați:</h2>
        <?php
        $file = fopen("rez.txt", "r") or die("Fișier inaccesibil!");
        echo "<table>";
        echo "<tr><th>Login</th></tr>";
        while (!feof($file)) {
            $line = trim(fgets($file));
            if ($line) {
                $data = explode(" ", $line);
                echo "<tr><td>" . htmlspecialchars($data[0]) . "</td></tr>";
            }
        }
        fclose($file);
        echo "</table>";
        ?>
        <img src="images/giphy.gif" alt="Bun venit!">
        <br>
        <a href="logout.php" class="logout-link">Deconectare</a>
    </div>
</body>
</html>