<?php
session_start();
require_once '../includes/auth.php';

if (!isManagerLoggedIn()) {
    header("Location: login.php");
    exit();
}

require_once '../includes/functions.php';

$error = '';
$success = '';
$pageTitle = "Adaugă Filială Nouă";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    
    if (addBranch($adresa, $telefon)) {
        $_SESSION['success'] = "Filiala a fost adăugată cu succes!";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "A apărut o eroare la adăugarea filialei.";
    }
}

require_once '../includes/header.php';
?>

<h1 class="mb-4">Adaugă Filială Nouă</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label class="form-label">Adresă filială:</label>
        <input type="text" class="form-control" name="adresa" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Număr de telefon:</label>
        <input type="text" class="form-control" name="telefon" required>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2">Adaugă</button>
        <a href="dashboard.php" class="btn btn-outline-secondary">Anulează</a>
    </div>
</form>

<?php
require_once '../includes/footer.php';
?>