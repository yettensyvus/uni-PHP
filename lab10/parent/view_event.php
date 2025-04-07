<?php
session_start();
require_once '../includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$eventId = $_GET['id'];
$event = getEventDetails($eventId);

if (!$event) {
    header("Location: events.php");
    exit();
}

$dateTimes = getEventDateTimes($eventId);

$pageTitle = htmlspecialchars($event['denumire_eveniment']) . " - Detalii";
require_once '../includes/header.php';
?>

<section class="event-details">
    <h1><?= htmlspecialchars($event['denumire_eveniment']) ?></h1>

    <div class="event-info">
        <p><strong>Responsabil:</strong> <?= htmlspecialchars($event['responsabil_eveniment']) ?></p>
        <p><strong>Locuri disponibile:</strong> <?= $event['nr_loc_disponibile'] ?></p>
        <p><strong>Cost:</strong> <?= number_format($event['cost_eveniment'], 2) ?> RON</p>
    </div>

    <div class="event-datetimes">
        <h2>Programare</h2>
        <?php if (!empty($dateTimes)): ?>
            <ul>
                <?php foreach ($dateTimes as $dt): ?>
                    <li>
                        <strong>Filială:</strong> <?= htmlspecialchars($dt['adresa_filiala']) ?><br>
                        <strong>Data:</strong> <?= $dt['data'] ?><br>
                        <strong>Ora:</strong> <?= $dt['ora'] ?><br>
                        <?php if ($event['nr_loc_disponibile'] > 0): ?>
                            <a href="register_child.php?event_id=<?= $eventId ?>&fdo_id=<?= $dt['id_filiala_data_ora'] ?>"
                                class="btn btn-primary">Înregistrează copil</a>
                        <?php else: ?>
                            <span class="no-spots">Locuri epuizate</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nu sunt programări disponibile.</p>
        <?php endif; ?>
    </div>

    <div class="event-actions">
        <a href="events.php" class="btn btn-secondary">Înapoi la evenimente</a>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>