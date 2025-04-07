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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['event_id'];
    $filialaId = $_POST['filiala_id'];
    $data = $_POST['data'];
    $ora = $_POST['ora'];
    
    if (addEventDateTime($eventId, $filialaId, $data, $ora)) {
        $success = "Data și ora au fost adăugate cu succes!";
    } else {
        $error = "A apărut o eroare la adăugarea datei și orei.";
    }
}

$events = getEvents();
$branches = getBranches(); // Funcție nouă care returnează toate filialele
$pageTitle = "Adaugă Dată și Oră Eveniment";
require_once '../includes/header.php';
?>

<h1 class="mb-4">Adaugă Dată și Oră Eveniment</h1>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label class="form-label">Eveniment:</label>
        <select class="form-select" name="event_id" required>
            <?php foreach ($events as $event): ?>
                <option value="<?= $event['id_eveniment'] ?>"><?= htmlspecialchars($event['denumire_eveniment']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Filială:</label>
        <select class="form-select" name="filiala_id" required>
            <?php foreach ($branches as $branch): ?>
                <option value="<?= $branch['id_filiala'] ?>">
                    <?= htmlspecialchars($branch['adresa_filiala']) ?> (Tel: <?= htmlspecialchars($branch['nr_telefon_filiala']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Data:</label>
        <input type="date" class="form-control" name="data" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Ora:</label>
        <input type="time" class="form-control" name="ora" required>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2">Adaugă</button>
        <a href="dashboard.php" class="btn btn-outline-secondary">Anulează</a>
    </div>
</form>

<?php
require_once '../includes/footer.php';
?>