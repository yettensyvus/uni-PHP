<?php
require_once 'database.php';

// Funcție pentru autentificare manager
function loginManager($username, $password) {
    global $pdo;
    
    $sql = "SELECT * FROM Manager WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $manager = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($manager && password_verify($password, $manager['parola'])) {
        $_SESSION['manager_id'] = $manager['id_manager'];
        $_SESSION['manager_username'] = $manager['login'];
        return true;
    }
    
    return false;
}

// Funcție pentru verificare logare manager
function isManagerLoggedIn() {
    return isset($_SESSION['manager_id']);
}

// Funcție pentru delogare manager
function logoutManager() {
    unset($_SESSION['manager_id']);
    unset($_SESSION['manager_username']);
    session_destroy();
}
?>