<?php
// add_admin.php
require_once 'includes/database.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $login = $_POST['login'];
    $parola = $_POST['parola'];
    
    try {
        // Hash the password
        $parola_hash = password_hash($parola, PASSWORD_DEFAULT);
        
        // Prepare and execute SQL
        $sql = "INSERT INTO Manager (login, parola) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login, $parola_hash]);
        
        echo "Manager added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Manager</title>
</head>
<body>
    <h2>Add New Manager</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="login" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="parola" required><br><br>
        
        <input type="submit" value="Add Manager">
    </form>
</body>
</html>