<!DOCTYPE html>
<html>
<head>
    <title>Înregistrare</title>
    <meta charset="utf-8">
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
    <p>Pentru a avea acces la date - înregistrați-vă!</p>
    <?php
    $mesaj = "";
    if (isset($_REQUEST['start'])) {
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
                    if ($stored_login == $login) {
                        $exist = true;
                        break;
                    }
                }
            }
            fclose($file);

            if ($exist) {
                $mesaj = "Acest login există deja! Alegeți altul!";
            } else {
                $file = fopen("rez.txt", "a") or die("Fișier inaccesibil!");
                fwrite($file, $login . " " . $password . "\n");
                fclose($file);
                $mesaj = "Contul a fost creat cu succes!";
            }
        } else {
            $mesaj = "Completați toate câmpurile!";
        }
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']?>">
        <p><input type="text" placeholder="Log-in" name="login" /></p>
        <p><input type="password" placeholder="Parolă" name="pass" size="12" maxlength="10" /></p>
        <input type="submit" value="Salvează" name="start" />
        <input type="reset" value="Șterge" />
        <?php echo "<br /><span style='color:red;'>$mesaj</span>"; ?>
    </form>
</div>
<div class="link">
    <a href="index.php" class="optiuni">Autentificare</a>
</div>
</body>
</html>