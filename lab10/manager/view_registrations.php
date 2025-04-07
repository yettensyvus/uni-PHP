<?php
session_start();
require_once '../includes/auth.php';

if (!isManagerLoggedIn()) {
    header("Location: login.php");
    exit();
}

require_once '../includes/functions.php';

if (!isset($_GET['fdo_id'])) {
    header("Location: dashboard.php");
    exit();
}

$fdoId = $_GET['fdo_id'];
$children = getRegisteredChildren($fdoId);

$pageTitle = "Copii Înscriși";
require_once '../includes/header.php';
?>

<h1 class="mb-4">Copii Înscriși</h1>

<?php if (!empty($children)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Prenume Copil</th>
                    <th>An Naștere</th>
                    <th>Prenume Părinte</th>
                    <th>Telefon Părinte</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($children as $child): ?>
                    <tr>
                        <td><?= htmlspecialchars($child['prenume_copil']) ?></td>
                        <td><?= $child['an_nastere_copil'] ?></td>
                        <td><?= htmlspecialchars($child['prenume_parinte']) ?></td>
                        <td><?= htmlspecialchars($child['nr_telefon_parinte']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info">Nu sunt copii înscriși la acest eveniment.</div>
<?php endif; ?>

<div class="mt-3">
    <a href="dashboard.php" class="btn btn-outline-secondary">Înapoi la Dashboard</a>
</div>

<?php
require_once '../includes/footer.php';
?>