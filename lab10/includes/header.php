<?php
// header.php - Common Header for all pages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isManager = isset($_SESSION['manager_id']);
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crafti - <?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Master-class-uri week-end' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .navbar .nav-link {
            color: #495057 !important;
        }

        .navbar .nav-link:hover {
            color: #0d6efd !important;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .header {
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>
    <header class="header text-dark py-3 border-bottom">
        <div class="container">
            <h1 class="mb-0">Magazinul Crafti</h1>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Acasă</a></li>
                    <li class="nav-item"><a class="nav-link" href="../parent/events.php">Evenimente</a></li>
                    <?php if ($isManager): ?>
                        <li class="nav-item"><a class="nav-link" href="../manager/dashboard.php">Panou Manager</a></li>
                        <li class="nav-item"><a class="nav-link" href="../manager/logout.php">Delogare</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="../manager/login.php">Autentificare Manager</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">