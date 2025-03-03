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
        .stilDiv {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #a9a9a9;
            border-radius: 10px;
            background-color: #c0c0c0;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .rezultat {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #a9a9a9;
            border-radius: 10px;
            background-color: #b0b0b0;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: 2px solid #808080;
            border-radius: 5px;
            padding: 15px;
        }
        legend {
            font-weight: bold;
            color: #505050;
        }
        label {
            font-weight: bold;
            color: #333;
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
        <form action="task_01.php" method="post">
            <fieldset>
                <legend>Parerea dvoastra conteaza!</legend>
                <p>
                    <label for="nume">Introdu numele: </label>
                    <input type="text" name="nume" required /><br />
                    <label for="prenume">Introdu prenumele: </label>
                    <input type="text" name="prenume" required /><br />
                    <label for="email">E-mail-ul dvoastra: </label>
                    <input type="email" name="email" required />
                </p>
                <p>
                    Va rugam, sa ne ziceti, daca va plac sau nu serviciile prestate de compania noastra:<br />
                    <input type="radio" name="optiune" value="Da" checked="checked" /> Da <br />
                    <input type="radio" name="optiune" value="Nu" /> Nu <br />
                    <input type="radio" name="optiune" value="Nu stiu" /> Nu-mi pot expune parerea
                </p>
                <p>
                    Lasati-ne parerea dvoastra despre noi:<br />
                    <textarea name="comentariu" rows="10" cols="30"></textarea>
                </p>
                <p>
                    <input type="reset" value="Anuleaza">
                    <input type="submit" value="Transmite">
                </p>
            </fieldset>
        </form>
    </div>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nume"]) && !empty($_POST["prenume"]) && !empty($_POST["email"])): ?>
    <div class="rezultat">
        <p>D-voastra va numiti: <b><?php echo htmlspecialchars($_POST['nume']); ?></b>, iar prenumele este: <b><?php echo htmlspecialchars($_POST['prenume']); ?></b></p>
        <p>Aveti adresa de e-mail: <b><?php echo htmlspecialchars($_POST['email']); ?></b></p>
        <p>La intrebarea "Daca sunteti multumiti de serviciile companiei noastre", ati raspuns: <b><?php echo htmlspecialchars($_POST['optiune']); ?></b></p>
        <p>Comentariul lasat de dvoastra a fost: <br /><i><?php echo nl2br(htmlspecialchars($_POST['comentariu'])); ?></i></p>
    </div>
    <?php endif; ?>
</body>
</html>
