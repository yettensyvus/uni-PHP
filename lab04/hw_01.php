<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d3d3d3;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .stilDiv, .rezultat {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #a9a9a9;
            border-radius: 10px;
            background-color: #c0c0c0;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        fieldset {
            border: 2px solid #808080;
            border-radius: 5px;
            padding: 15px;
        }
        legend, label {
            font-weight: bold;
            color: #505050;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #808080;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
        .submit-btn {
            background-color: darkred;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
        }
        .submit-btn:hover {
            background-color: #a00000;
        }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>

<?php
$nume = $email = $subiect = $mesaj = "";
$numeErr = $emailErr = $subiectErr = $mesajErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nume"])) {
        $numeErr = "Numele este obligatoriu.";
    } else {
        $nume = htmlspecialchars($_POST["nume"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Emailul este obligatoriu.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email invalid.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["subiect"])) {
        $subiectErr = "Subiectul este obligatoriu.";
    } else {
        $subiect = htmlspecialchars($_POST["subiect"]);
    }

    if (empty($_POST["mesaj"])) {
        $mesajErr = "Mesajul este obligatoriu.";
    } else {
        $mesaj = htmlspecialchars($_POST["mesaj"]);
    }
}
?>

<div class="stilDiv">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Formular de Contact</legend>
            <label>Nume *</label>
            <input type="text" name="nume" value="<?php echo $nume; ?>">
            <span class="error"><?php echo $numeErr; ?></span>
            <br>
            <label>Email *</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
            <br>
            <label>Subiect *</label>
            <input type="text" name="subiect" value="<?php echo $subiect; ?>">
            <span class="error"><?php echo $subiectErr; ?></span>
            <br>
            <label>Mesaj *</label>
            <textarea name="mesaj"><?php echo $mesaj; ?></textarea>
            <span class="error"><?php echo $mesajErr; ?></span>
            <br>
            <button type="submit" class="submit-btn">Trimitere email</button>
        </fieldset>
    </form>
</div>

<?php if ($nume && $email && $subiect && $mesaj): ?>
    <div class="rezultat">
        <p><strong>Nume:</strong> <?php echo $nume; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Subiect:</strong> <?php echo $subiect; ?></p>
        <p><strong>Mesaj:</strong> <?php echo $mesaj; ?></p>
    </div>
<?php endif; ?>

</body>
</html>
