<?php
session_start();
require_once '../includes/auth.php';

if (!isManagerLoggedIn()) {
    header("Location: login.php");
    exit();
}

require_once '../includes/functions.php';

// Initialize variables
$error = '';
$pageTitle = "Adaugă Eveniment Nou";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $denumire = $_POST['denumire'];
    $responsabil = $_POST['responsabil'];
    $locuri = $_POST['locuri'];
    $cost = $_POST['cost'];
    
    if (addEvent($denumire, $responsabil, $locuri, $cost)) {
        $_SESSION['success'] = "Evenimentul a fost adăugat cu succes!";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "A apărut o eroare la adăugarea evenimentului.";
    }
}

// Include header
require_once '../includes/header.php';
?>

<h1 class="mb-4">Adaugă Eveniment Nou</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label class="form-label">Denumire eveniment:</label>
        <input type="text" class="form-control" name="denumire" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Responsabil:</label>
        <input type="text" class="form-control" name="responsabil" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Număr locuri disponibile:</label>
        <input type="number" class="form-control" name="locuri" required min="1">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Cost eveniment (MDL):</label>
        <input type="number" class="form-control" name="cost" required min="0" step="0.01">
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2">Adaugă</button>
        <a href="dashboard.php" class="btn btn-outline-secondary">Anulează</a>
    </div>
</form>

<?php
// Include footer
require_once '../includes/footer.php';
?>