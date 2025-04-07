<?php
// index.php
$pageTitle = "Magazinul Crafti"; // Set the page title
require_once 'includes/header.php'; // Include the common header
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Master-class-uri week-end</h2>
                    <p class="card-text">Descoperă evenimente interesante pentru părinți și copii.</p>
                    <a href="parent/events.php" class="btn btn-primary">Vizualizează evenimente</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Manager</h2>
                    <p class="card-text">Accesează panoul managerului pentru administrare.</p>
                    <a href="manager/login.php" class="btn btn-primary">Autentificare manager</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php'; // Include the common footer
?>