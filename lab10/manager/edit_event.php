<?php
session_start();
require_once '../includes/auth.php';

if (!isManagerLoggedIn()) {
    header("Location: login.php");
    exit();
}

require_once '../includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$eventId = $_GET['id'];
$event = getEventDetails($eventId);

if (!$event) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $denumire = $_POST['denumire'];
    $responsabil = $_POST['responsabil'];
    $locuri = $_POST['locuri'];
    $cost = $_POST['cost'];
    
    $sql = "UPDATE Eveniment SET denumire_eveniment = ?, responsabil_eveniment = ?, nr_loc_disponibile = ?, cost_eveniment = ? WHERE id_eveniment = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$denumire, $responsabil, $locuri, $cost, $eventId])) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "A apărut o eroare la modificarea evenimentului.";
    }
}

$pageTitle = "Editează Eveniment - " . htmlspecialchars($event['denumire_eveniment']);
require_once '../includes/header.php';
?>
<h1 class="mb-4">Editează Eveniment</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label class="form-label">Denumire eveniment:</label>
        <input type="text" class="form-control" name="denumire" value="<?= htmlspecialchars($event['denumire_eveniment']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Responsabil:</label>
        <input type="text" class="form-control" name="responsabil" value="<?= htmlspecialchars($event['responsabil_eveniment']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Număr locuri disponibile:</label>
        <input type="number" class="form-control" name="locuri" value="<?= $event['nr_loc_disponibile'] ?>" required min="1">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Cost eveniment (MDL):</label>
        <input type="number" class="form-control" name="cost" value="<?= $event['cost_eveniment'] ?>" required min="0" step="0.01">
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2">Salvează</button>
        <a href="dashboard.php" class="btn btn-outline-secondary">Anulează</a>
    </div>
</form>

<?php
require_once '../includes/footer.php';
?>