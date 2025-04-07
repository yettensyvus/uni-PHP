<?php
session_start();
require_once '../includes/functions.php';

$events = getEventsWithDateTime();

$pageTitle = "Evenimente Disponibile";
require_once '../includes/header.php';
?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0">Evenimente Disponibile</h1>
    </div>
    <div class="card-body">
        <?php if (!empty($events)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Eveniment</th>
                            <th>Data</th>
                            <th>Ora</th>
                            <th>Locatie</th>
                            <th>Locuri disponibile</th>
                            <th>Cost</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?= htmlspecialchars($event['denumire_eveniment']) ?></td>
                                <td><?= date('d.m.Y', strtotime($event['data'])) ?></td>
                                <td><?= date('H:i', strtotime($event['ora'])) ?></td>
                                <td><?= htmlspecialchars($event['adresa_filiala']) ?></td>
                                <td><?= $event['nr_loc_disponibile'] ?></td>
                                <td><?= number_format($event['cost_eveniment'], 2) ?> MDL</td>
                                <td>
                                    <?php if ($event['nr_loc_disponibile'] > 0): ?>
                                        <a href="register_child.php?event_id=<?= $event['id_eveniment'] ?>&fdo_id=<?= $event['id_filiala_data_ora'] ?>" class="btn btn-success btn-sm">Înscrie copil</a>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nu sunt locuri</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Momentan nu există evenimente disponibile.</div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>