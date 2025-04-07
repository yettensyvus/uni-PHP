<?php
session_start();
require_once '../includes/functions.php';

if (!isset($_GET['event_id']) || !isset($_GET['fdo_id'])) {
    header("Location: events.php");
    exit();
}

$eventId = $_GET['event_id'];
$fdoId = $_GET['fdo_id'];
$event = getEventDetails($eventId);

if (!$event) {
    header("Location: events.php");
    exit();
}

// Get available spots
$availableSpots = checkAvailableSpots($eventId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenumeParinte = $_POST['prenume_parinte'];
    $telefonParinte = $_POST['telefon_parinte'];
    $childrenData = $_POST['children'] ?? [];
    
    if (empty($childrenData)) {
        $_SESSION['error'] = "Vă rugăm să adăugați cel puțin un copil.";
    } else {
        // Validate number of children doesn't exceed available spots
        if (count($childrenData) > $availableSpots) {
            $_SESSION['error'] = "Nu sunt suficiente locuri disponibile. Ați selectat " . count($childrenData) . " copii, dar sunt doar $availableSpots locuri disponibile.";
        } else {
            if (addParent($prenumeParinte, $telefonParinte)) {
                $idParinte = $pdo->lastInsertId();
                $registeredCount = 0;
                
                foreach ($childrenData as $child) {
                    $prenumeCopil = $child['prenume_copil'];
                    $anNastereCopil = $child['an_nastere_copil'];
                    
                    if (addChild($prenumeCopil, $anNastereCopil, $idParinte)) {
                        $idCopil = $pdo->lastInsertId();
                        
                        if (registerToEvent($fdoId, $idCopil)) {
                            $newSpots = $availableSpots - 1;
                            if (updateAvailableSpots($eventId, $newSpots)) {
                                $registeredCount++;
                                $availableSpots = $newSpots; // Update local counter
                            } else {
                                $_SESSION['error'] = "Eroare la actualizarea locurilor disponibile pentru copilul: $prenumeCopil.";
                                break;
                            }
                        } else {
                            $_SESSION['error'] = "Numărul maxim de 12 copii a fost atins sau a apărut o eroare la înregistrarea copilului: $prenumeCopil.";
                            break;
                        }
                    } else {
                        $_SESSION['error'] = "Eroare la adăugarea copilului: $prenumeCopil.";
                        break;
                    }
                }
                
                if ($registeredCount > 0 && !isset($_SESSION['error'])) {
                    $_SESSION['success'] = "$registeredCount copil(i) au fost înregistrați cu succes!";
                }
            } else {
                $_SESSION['error'] = "Eroare la adăugarea părintelui.";
            }
        }
    }
    header("Location: events.php");
    exit();
}

$pageTitle = "Înregistrare copil - " . htmlspecialchars($event['denumire_eveniment']);
require_once '../includes/header.php';
?>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0">Înregistrare copil pentru <?= htmlspecialchars($event['denumire_eveniment']) ?></h1>
        <div class="small">Locuri disponibile: <?= $availableSpots ?></div>
    </div>
    <div class="card-body">
        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-4 p-3 border rounded">
                <h2 class="h5 mb-3">Date părinte</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="prenume_parinte" class="form-label">Prenume părinte:</label>
                        <input type="text" class="form-control" id="prenume_parinte" name="prenume_parinte" required>
                        <div class="invalid-feedback">Vă rugăm să introduceți prenumele.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefon_parinte" class="form-label">Telefon părinte:</label>
                        <input type="text" class="form-control" id="telefon_parinte" name="telefon_parinte" required>
                        <div class="invalid-feedback">Vă rugăm să introduceți numărul de telefon.</div>
                    </div>
                </div>
            </div>

            <div class="mb-4 p-3 border rounded">
                <h2 class="h5 mb-3">Date copii</h2>
                <div class="alert alert-info mb-3">
                    Locuri disponibile: <strong><?= $availableSpots ?></strong>. Puteți înscrie maximum <?= $availableSpots ?> copii.
                </div>
                <div id="children-container">
                    <div class="child-entry row mb-3 g-3">
                        <div class="col-md-6">
                            <label for="prenume_copil_0" class="form-label">Prenume copil:</label>
                            <input type="text" class="form-control" id="prenume_copil_0" name="children[0][prenume_copil]" required>
                            <div class="invalid-feedback">Vă rugăm să introduceți prenumele copilului.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="an_nastere_copil_0" class="form-label">An naștere copil:</label>
                            <input type="number" class="form-control" id="an_nastere_copil_0" name="children[0][an_nastere_copil]" required min="2000" max="<?= date('Y') ?>">
                            <div class="invalid-feedback">Vă rugăm să introduceți un an valid.</div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger remove-child w-100" style="display: none;">Șterge</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-child" class="btn btn-outline-secondary">Adaugă alt copil</button>
            </div>

            <div class="d-flex justify-content-between">
                <a href="events.php" class="btn btn-secondary">Înapoi</a>
                <button type="submit" class="btn btn-primary">Înregistrează</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('add-child').addEventListener('click', function() {
    const container = document.getElementById('children-container');
    const count = container.children.length;
    const availableSpots = <?= $availableSpots ?>;
    
    if (count >= availableSpots) {
        alert(`Nu puteți adăuga mai mulți copii decât numărul de locuri disponibile (${availableSpots}).`);
        return;
    }
    
    const newEntry = document.createElement('div');
    newEntry.className = 'child-entry row mb-3 g-3';
    newEntry.innerHTML = `
        <div class="col-md-6">
            <label for="prenume_copil_${count}" class="form-label">Prenume copil:</label>
            <input type="text" class="form-control" id="prenume_copil_${count}" name="children[${count}][prenume_copil]" required>
        </div>
        <div class="col-md-4">
            <label for="an_nastere_copil_${count}" class="form-label">An naștere copil:</label>
            <input type="number" class="form-control" id="an_nastere_copil_${count}" name="children[${count}][an_nastere_copil]" required min="2000" max="<?= date('Y') ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-outline-danger remove-child w-100">Șterge</button>
        </div>
    `;
    container.appendChild(newEntry);
    updateRemoveButtons();
});

function updateRemoveButtons() {
    const entries = document.querySelectorAll('.child-entry');
    entries.forEach((entry, index) => {
        const removeBtn = entry.querySelector('.remove-child');
        if (entries.length > 1) {
            removeBtn.style.display = 'block';
            removeBtn.onclick = () => entry.remove();
        } else {
            removeBtn.style.display = 'none';
        }
    });
}

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-child')) {
        updateRemoveButtons();
    }
});
</script>

<?php
require_once '../includes/footer.php';
?>