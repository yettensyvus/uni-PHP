<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form</title>
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
        input[type="text"], input[type="radio"], input[type="checkbox"] {
            margin-top: 5px;
            margin-bottom: 10px;
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
$nume = $intrebare1 = $intrebare2 = $intrebare3 = "";
$numeErr = $intrebare1Err = $intrebare2Err = $intrebare3Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nume"])) {
        $numeErr = "Numele este obligatoriu.";
    } else {
        $nume = htmlspecialchars($_POST["nume"]);
    }

    if (empty($_POST["intrebare1"])) {
        $intrebare1Err = "Trebuie să răspundeți la întrebare.";
    } else {
        $intrebare1 = htmlspecialchars($_POST["intrebare1"]);
    }

    if (empty($_POST["intrebare2"])) {
        $intrebare2Err = "Trebuie să răspundeți la întrebare.";
    } else {
        $intrebare2 = htmlspecialchars($_POST["intrebare2"]);
    }

    if (empty($_POST["intrebare3"])) {
        $intrebare3Err = "Trebuie să răspundeți la întrebare.";
    } else {
        $intrebare3 = implode(", ", $_POST["intrebare3"]);
    }
}
?>

<div class="stilDiv">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Test Form</legend>
            <label>Nume *</label>
            <input type="text" name="nume" value="<?php echo $nume; ?>">
            <span class="error"><?php echo $numeErr; ?></span>
            <br>
            <label>1. Care este culoarea preferată?</label><br>
            <input type="radio" name="intrebare1" value="Roșu" <?php echo ($intrebare1 == "Roșu") ? "checked" : ""; ?>> Roșu<br>
            <input type="radio" name="intrebare1" value="Albastru" <?php echo ($intrebare1 == "Albastru") ? "checked" : ""; ?>> Albastru<br>
            <input type="radio" name="intrebare1" value="Verde" <?php echo ($intrebare1 == "Verde") ? "checked" : ""; ?>> Verde<br>
            <span class="error"><?php echo $intrebare1Err; ?></span>
            <br>

            <label>2. Care este tipul tău preferat de muzică?</label><br>
            <input type="radio" name="intrebare2" value="Rock" <?php echo ($intrebare2 == "Rock") ? "checked" : ""; ?>> Rock<br>
            <input type="radio" name="intrebare2" value="Pop" <?php echo ($intrebare2 == "Pop") ? "checked" : ""; ?>> Pop<br>
            <input type="radio" name="intrebare2" value="Jazz" <?php echo ($intrebare2 == "Jazz") ? "checked" : ""; ?>> Jazz<br>
            <span class="error"><?php echo $intrebare2Err; ?></span>
            <br>

            <label>3. Ce instrumente muzicale preferi? (Selectează mai multe opțiuni)</label><br>
            <input type="checkbox" name="intrebare3[]" value="Chitară" <?php echo (in_array("Chitară", $_POST["intrebare3"] ?? [])) ? "checked" : ""; ?>> Chitară<br>
            <input type="checkbox" name="intrebare3[]" value="Pian" <?php echo (in_array("Pian", $_POST["intrebare3"] ?? [])) ? "checked" : ""; ?>> Pian<br>
            <input type="checkbox" name="intrebare3[]" value="Tobe" <?php echo (in_array("Tobe", $_POST["intrebare3"] ?? [])) ? "checked" : ""; ?>> Tobe<br>
            <input type="checkbox" name="intrebare3[]" value="Vioară" <?php echo (in_array("Vioară", $_POST["intrebare3"] ?? [])) ? "checked" : ""; ?>> Vioară<br>
            <span class="error"><?php echo $intrebare3Err; ?></span>
            <br>

            <button type="submit" class="submit-btn">Trimite răspunsurile</button>
        </fieldset>
    </form>
</div>

<?php if ($nume && $intrebare1 && $intrebare2 && $intrebare3): ?>
    <div class="rezultat">
        <p><strong>Nume:</strong> <?php echo $nume; ?></p>
        <p><strong>1. Culoarea preferată:</strong> <?php echo $intrebare1; ?></p>
        <p><strong>2. Tipul de muzică preferat:</strong> <?php echo $intrebare2; ?></p>
        <p><strong>3. Instrumentele muzicale preferate:</strong> <?php echo $intrebare3; ?></p>
    </div>
<?php endif; ?>

</body>
</html>
