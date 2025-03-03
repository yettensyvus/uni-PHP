<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Cultură Generală</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d3d3d3;
            text-align: center;
            padding: 20px;
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
            text-align: left;
        }
        .error { color: red; font-size: 14px; }
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
    </style>
</head>
<body>

<?php
$scor = 0;
$nume = "";
$correctAnswers = ["Paris", "7", ["Roșu", "Albastru"]];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nume"])) {
        $errors[] = "Introduceți numele!";
    } else {
        $nume = htmlspecialchars($_POST["nume"]);
    }

    if (empty($_POST["intrebare1"])) {
        $errors[] = "Selectați un răspuns pentru întrebarea 1!";
    } elseif ($_POST["intrebare1"] == $correctAnswers[0]) {
        $scor++;
    }
    
    if (empty($_POST["intrebare2"])) {
        $errors[] = "Selectați un răspuns pentru întrebarea 2!";
    } elseif ($_POST["intrebare2"] == $correctAnswers[1]) {
        $scor++;
    }
    
    if (empty($_POST["intrebare3"])) {
        $errors[] = "Selectați cel puțin un răspuns pentru întrebarea 3!";
    } else {
        $r3 = $_POST["intrebare3"];
        if (count(array_intersect($r3, $correctAnswers[2])) == count($correctAnswers[2])) {
            $scor++;
        }
    }
}
?>

<div class="stilDiv">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Test de Cultură Generală</legend>
            <label>Nume:</label>
            <input type="text" name="nume" value="<?php echo $nume; ?>">
            <br><br>
            
            <label>1. Care este capitala Franței?</label><br>
            <input type="radio" name="intrebare1" value="Berlin"> Berlin<br>
            <input type="radio" name="intrebare1" value="Madrid"> Madrid<br>
            <input type="radio" name="intrebare1" value="Paris"> Paris<br>
            <br>
            
            <label>2. Câte continente există pe Pământ?</label><br>
            <input type="radio" name="intrebare2" value="5"> 5<br>
            <input type="radio" name="intrebare2" value="6"> 6<br>
            <input type="radio" name="intrebare2" value="7"> 7<br>
            <br>
            
            <label>3. Care sunt culorile primare?</label><br>
            <input type="checkbox" name="intrebare3[]" value="Roșu"> Roșu<br>
            <input type="checkbox" name="intrebare3[]" value="Verde"> Verde<br>
            <input type="checkbox" name="intrebare3[]" value="Albastru"> Albastru<br>
            <br>
            
            <button type="submit" class="submit-btn">Verifică răspunsurile</button>
        </fieldset>
    </form>
</div>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="rezultat">
        <?php if (!empty($errors)): ?>
            <p class="error"><strong>Erori:</strong></p>
            <ul>
                <?php foreach ($errors as $error) echo "<li class='error'>$error</li>"; ?>
            </ul>
        <?php else: ?>
            <p><strong>Nume:</strong> <?php echo $nume; ?></p>
            <p><strong>Scor obținut:</strong> <?php echo $scor; ?>/3</p>
            <p><strong>Răspunsurile corecte:</strong></p>
            <p>1. Paris</p>
            <p>2. 7</p>
            <p>3. Roșu, Albastru</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

</body>
</html>