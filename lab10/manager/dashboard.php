<?php
session_start();
require_once '../includes/auth.php';

if (!isManagerLoggedIn()) {
    header("Location: login.php");
    exit();
}

require_once '../includes/functions.php';
$events = getEvents();

$pageTitle = "Panou Manager";
require_once '../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Bine ai venit, Manager!</h1>
    <a href="logout.php" class="btn btn-danger">Deconectare</a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">Evenimente</h2>
        <div>
            <a href="add_event.php" class="btn btn-sm btn-light me-2">Adaugă eveniment</a>
            <a href="add_event_datetime.php" class="btn btn-sm btn-light me-2">Adaugă dată/ora</a>
            <a href="add_branch.php" class="btn btn-sm btn-light">Adaugă filială</a>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($events)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Denumire</th>
                            <th>Responsabil</th>
                            <th>Locuri disponibile</th>
                            <th>Cost</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?= htmlspecialchars($event['denumire_eveniment']) ?></td>
                                <td><?= htmlspecialchars($event['responsabil_eveniment']) ?></td>
                                <td><?= $event['nr_loc_disponibile'] ?></td>
                                <td><?= number_format($event['cost_eveniment'], 2) ?> MDL</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="edit_event.php?id=<?= $event['id_eveniment'] ?>" class="btn btn-sm btn-warning">Editează</a>
                                        <?php $dateTimes = getEventDateTimes($event['id_eveniment']); ?>
                                        <?php foreach ($dateTimes as $dt): ?>
                                            <a href="view_registrations.php?fdo_id=<?= $dt['id_filiala_data_ora'] ?>" class="btn btn-sm btn-info">Vezi înscrieri</a>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Nu există evenimente înregistrate.</div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>