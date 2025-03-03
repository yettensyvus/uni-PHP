<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular PHP</title>
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
        input[type="text"], input[type="email"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #808080;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #808080;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #606060;
        }
    </style>
</head>
<body>
    <div class="stilDiv">
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
            <fieldset>
                <legend>Introduceti datele</legend>
                <p>
                    <label for="nume">Introdu numele: </label>
                    <input type="text" name="nume" required /><br />
                    <label for="prenume">Introdu prenumele: </label>
                    <input type="text" name="prenume" required /><br />
                </p>
                <p>Selecteaza zilele in care esti disponibil sa frecventezi cursul:</p>
                <select name="zi" size="3">
                    <option value="Luni" selected>Luni</option>
                    <option value="Marti">Marti</option>
                    <option value="Miercuri">Miercuri</option>
                    <option value="Joi">Joi</option>
                    <option value="Vineri">Vineri</option>
                    <option value="Sambata">Sambata</option>
                    <option value="Duminica">Duminica</option>
                </select>
                <p>
                    <input type="reset" value="Anuleaza" />
                    <input type="submit" value="Transmite" name="start" />
                </p>
            </fieldset>
        </form>
    </div>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nume"]) && !empty($_POST["prenume"])): ?>
    <div class="rezultat">
        <p>Bine ati venit la noi pe site <b><?php echo htmlspecialchars($_POST['nume']); ?> <?php echo htmlspecialchars($_POST['prenume']); ?></b>.</p>
        <p>D-voastra sunteti disponibil sa accesati cursul in <b><?php echo htmlspecialchars($_POST['zi']); ?></b>.
        <?php if ($_POST['zi'] == "Sambata" || $_POST['zi'] == "Duminica") {
            echo "<br />Veti reusi sa studiati atent lectiile propuse, fiindca e o zi de odihna!";
        } ?>
        </p>
    </div>
    <?php endif; ?>
</body>
</html>