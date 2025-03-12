<?php
session_start();
$cale = "/homework"; // Ajustați calea după necesități

if (isset($_REQUEST['ok'])) {
    if (isset($_POST["login"]) && !empty($_POST['login']) && 
        isset($_POST["pass"]) && !empty($_POST['pass'])) {
        
        $login = $_POST["login"];
        $password = md5($_POST["pass"]);
        
        $file = fopen("rez.txt", "r") or die("Fișier inaccesibil!");
        $exist = false;
        while (!feof($file)) {
            $line = trim(fgets($file));
            if ($line) {
                list($stored_login, $stored_pass) = explode(" ", $line);
                if ($stored_login == $login && $stored_pass == $password) {
                    $exist = true;
                    $_SESSION['user'] = $login;
                    break;
                }
            }
        }
        fclose($file);

        if ($exist) {
            header("Location: http://" . $_SERVER['SERVER_NAME'] . $cale . "/menu.php");
            exit();
        } else {
            $mesaj = "Date de autentificare incorecte!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Autentificare</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            height: 100vh; /* Full viewport height */
            display: flex; /* Use flexbox for centering */
            flex-direction: column; /* Stack children vertically */
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
        }
        .form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text inside form */
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensure padding doesn't affect width */
        }
        input[type="submit"], input[type="reset"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="reset"] {
            background-color: #d9534f;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        input[type="reset"]:hover {
            background-color: #c9302c;
        }
        .link {
            margin-top: 20px;
            text-align: center; /* Center the link */
        }
        .optiuni {
            color: #337ab7;
            text-decoration: none;
        }
        .optiuni:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="form">
    <p>Pentru a avea acces la date, autentificați-vă!</p>
    <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']?>">
        <p><input type="text" placeholder="Log-in" name="login" /></p>
        <p><input type="password" placeholder="Parolă" name="pass" size="12" maxlength="10" /></p>
        <input type="submit" value="Acces" name="ok" />
        <input type="reset" value="Ieșire" />
        <?php if (isset($mesaj)) echo "<br /><span style='color:red;'>$mesaj</span>"; ?>
    </form>
</div>
<div class="link">
    <a href="login.php" class="optiuni">Înregistrare</a>
</div>
</body>
</html>