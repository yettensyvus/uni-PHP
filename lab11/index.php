<?php
// Function to sanitize input data
function validare($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize error and value variables
$numeErr = $prenumeErr = $emailErr = $err_file = "";
$nume = $prenume = $email = "";
$info = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate "nume" (name)
    if (empty($_POST["nume"])) {
        $numeErr = "Acest camp trebuie obligatoriu completat!";
    } else {
        $nume = validare($_POST["nume"]);
        if (!preg_match("/^[A-Za-z]{2,14}(-[A-Za-z]{2,14})?$/", $nume)) {
            $numeErr = "Trebuie introduse doar litere, liniuta - maxim 15 simboluri.";
        }
    }

    // Validate "prenume" (surname)
    if (empty($_POST["prenume"])) {
        $prenumeErr = "Acest camp trebuie obligatoriu completat!";
    } else {
        $prenume = validare($_POST["prenume"]);
        if (!preg_match("/^[A-Za-z]{2,14}(-[A-Za-z]{2,14})?$/", $prenume)) {
            $prenumeErr = "Trebuie introduse doar litere, liniuta - maxim 15 simboluri.";
        }
    }

    // Validate "email"
    if (empty($_POST["email"])) {
        $emailErr = "Acest camp trebuie obligatoriu completat!";
    } else {
        $email = validare($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Ati introdus o adresa de e-mail nevalida!";
        }
    }

    // File upload handling
    $current_dir = "fisiere/";
    $current_file = $current_dir . basename($_FILES["fisier_incarcat"]["name"]);
    $uploadOk = 1;

    // Check if a file is selected
    if ($current_file == "fisiere/") {
        $err_file = "Ati uitat sa incarcati fisierul!";
        $uploadOk = 0;
    } else {
        // Check if file already exists
        if (file_exists($current_file)) {
            $err_file .= "Fisierul exista deja!<br>";
            $uploadOk = 0;
        }

        // Check file size (max 500KB)
        if ($_FILES["fisier_incarcat"]["size"] > 500000) {
            $err_file .= "Fisierul incarcat este prea voluminos!<br>";
            $uploadOk = 0;
        }

        // Check file type
        $tip_fisier = strtolower(pathinfo($current_file, PATHINFO_EXTENSION));
        $allowed_types = ["doc", "pdf", "docx", "txt"];
        if (!in_array($tip_fisier, $allowed_types)) {
            $err_file .= "Trebuie sa incarcati un fisier textual (doc, pdf, docx, txt)!<br>";
            $uploadOk = 0;
        }
    }

    // Process upload if no errors
    if ($uploadOk == 1 && $numeErr == "" && $prenumeErr == "" && $emailErr == "") {
        if (move_uploaded_file($_FILES["fisier_incarcat"]["tmp_name"], $current_file)) {
            $info = "Fisierul " . basename($_FILES["fisier_incarcat"]["name"]) . " a fost incarcat cu succes!";
            $nume = $prenume = $email = ""; // Reset fields on success
        } else {
            $info = "Incarcare nereusita - a aparut o eroare!";
        }
    } else {
        $info = "Incarcare nereusita - a aparut o eroare!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisiere - Tema PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background: #ffffff;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: #28a745;
            color: white;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 15px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #28a745;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
        }
        .btn-custom {
            background: #ffc107;
            color: #28a745;
            font-weight: bold;
            border-radius: 10px;
            padding: 12px 30px;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .btn-custom:hover {
            background: #e0a800;
            transform: scale(1.05);
        }
        .error {
            color: #dc3545;
            font-size: 0.9rem;
            font-style: italic;
        }
        .info {
            color: #28a745;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }
        .instruction-text {
            color: #17a2b8;
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Tema pentru acasă</h1>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="nume" class="form-label">Numele:</label>
                                <input type="text" class="form-control" id="nume" name="nume" value="<?php echo $nume; ?>">
                                <?php if ($numeErr): ?>
                                    <span class="error">* <?php echo $numeErr; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="prenume" class="form-label">Prenumele:</label>
                                <input type="text" class="form-control" id="prenume" name="prenume" value="<?php echo $prenume; ?>">
                                <?php if ($prenumeErr): ?>
                                    <span class="error">* <?php echo $prenumeErr; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email-ul:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                <?php if ($emailErr): ?>
                                    <span class="error">* <?php echo $emailErr; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <p class="instruction-text">Descrie într-un fișier textual ce este PHP-ul, salvează fișierul, <br> apoi încarcă-l și expediază-l pentru control <br> (dimensiunea fișierului trebuie să fie sub 500KB):</p>
                                <input type="file" class="form-control" name="fisier_incarcat">
                                <?php if ($err_file): ?>
                                    <span class="error">* <?php echo $err_file; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Trimite" class="btn btn-custom">
                            </div>
                        </form>
                        <?php if ($info): ?>
                            <div class="info"><?php echo $info; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>