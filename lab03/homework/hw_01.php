<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Imagini</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            width: 100%;
            text-align: center;
        }

        nav {
            margin: 10px 0;
        }

        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1200px;
        }

        .content img {
            margin: 5px;
            width: 150px;
            /* Set a fixed width */
            height: 150px;
            /* Set a fixed height */
            object-fit: cover;
            /* Ensures the image fills the box while maintaining aspect ratio */
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #333;
            color: white;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Galeria de Imagini</h1>
    </header>

    <div class="content">
        <?php
        // definim calea până la mapa cu imagini
        $dir = 'images/';

        // Scanam conținutul mapei
        $files = scandir($dir);

        // verificăm dacă nu au au fost depistate erori la scanare
        if ($files !== false) {
            // parcurgem tabloul
            for ($i = 0; $i < count($files); $i++) {
                // omitem directorul curent și cel părinte
                if (($files[$i] != ".") && ($files[$i] != "..")) {
                    // salvăm calea spre imagine
                    $path = $dir . $files[$i];
                    // afișam imaginile
                    echo "<a href='$path'><img src='$path' alt='Imagine' /></a>";
                }
            }
        }
        ?>
    </div>

    <footer>
        <p>© Straton Alexandru</p>
    </footer>

</body>

</html>