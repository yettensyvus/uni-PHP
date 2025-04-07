<?php
require_once 'database.php';

// Funcție pentru adăugare eveniment
function addEvent($denumire, $responsabil, $locuri, $cost)
{
    global $pdo;
    $sql = "INSERT INTO Eveniment (denumire_eveniment, responsabil_eveniment, nr_loc_disponibile, cost_eveniment) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$denumire, $responsabil, $locuri, $cost]);
}

// Funcție pentru adăugare dată și oră pentru eveniment
function addEventDateTime($eventId, $filialaId, $data, $ora)
{
    global $pdo;
    $sql = "INSERT INTO Filiala_Data_Ora (id_eveniment, id_filiala, data, ora) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$eventId, $filialaId, $data, $ora]);
}

// Funcție pentru adăugare părinte
function addParent($prenume, $telefon)
{
    global $pdo;
    $sql = "INSERT INTO Parinte (prenume_parinte, nr_telefon_parinte) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$prenume, $telefon]);
}

// Funcție pentru adăugare copil
function addChild($prenume, $anNastere, $idParinte)
{
    global $pdo;
    $sql = "INSERT INTO Copil (prenume_copil, an_nastere_copil, id_parinte) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$prenume, $anNastere, $idParinte]);
}

// Funcție pentru obținere evenimente
function getEvents()
{
    global $pdo;
    $sql = "SELECT * FROM Eveniment";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funcție pentru obținere detalii eveniment
function getEventDetails($id)
{
    global $pdo;
    $sql = "SELECT * FROM Eveniment WHERE id_eveniment = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funcție pentru obținere date și ore pentru eveniment
function getEventDateTimes($eventId)
{
    global $pdo;
    $sql = "SELECT fdo.*, fc.adresa_filiala 
            FROM Filiala_Data_Ora fdo 
            JOIN Filiala_Crafti fc ON fdo.id_filiala = fc.id_filiala 
            WHERE fdo.id_eveniment = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$eventId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funcție pentru înregistrare la eveniment cu limită de 12 copii
function registerToEvent($idFilialaDataOra, $idCopil)
{
    global $pdo;

    // Validate $idFilialaDataOra
    if (empty($idFilialaDataOra) || !is_numeric($idFilialaDataOra)) {
        return false; // Invalid ID, fail silently
    }

    // Verificăm numărul de înscrieri existente
    $sql = "SELECT COUNT(*) as count FROM Inscriere_Eveniment WHERE id_filiala_data_ora = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idFilialaDataOra]);
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    if ($count >= 12) {
        return false; // Limită atinsă
    }

    $sql = "INSERT INTO Inscriere_Eveniment (data_inscriere, id_filiala_data_ora, id_copil) 
            VALUES (NOW(), ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$idFilialaDataOra, $idCopil]);
}

// Funcție pentru obținere copii înscriși la eveniment
function getRegisteredChildren($idFilialaDataOra)
{
    global $pdo;
    $sql = "SELECT c.prenume_copil, c.an_nastere_copil, p.prenume_parinte, p.nr_telefon_parinte
            FROM Inscriere_Eveniment ie
            JOIN Copil c ON ie.id_copil = c.id_copil
            JOIN Parinte p ON c.id_parinte = p.id_parinte
            WHERE ie.id_filiala_data_ora = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idFilialaDataOra]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funcție pentru verificare locuri disponibile
function checkAvailableSpots($idEveniment)
{
    global $pdo;
    $sql = "SELECT nr_loc_disponibile FROM Eveniment WHERE id_eveniment = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idEveniment]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['nr_loc_disponibile'] : 0;
}

// Funcție pentru obținere ID filială dată oră
function getFilialaDataOraId($eventId)
{
    global $pdo;
    $sql = "SELECT id_filiala_data_ora FROM Filiala_Data_Ora WHERE id_eveniment = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$eventId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['id_filiala_data_ora'] : null;
}

// Funcție pentru actualizare locuri disponibile
function updateAvailableSpots($eventId, $newSpots)
{
    global $pdo;
    $sql = "UPDATE Eveniment SET nr_loc_disponibile = ? WHERE id_eveniment = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$newSpots, $eventId]);
}

function addBranch($adresa, $telefon)
{
    global $pdo;

    try {
        $sql = "INSERT INTO Filiala_Crafti (adresa_filiala, nr_telefon_filiala) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$adresa, $telefon]);
    } catch (PDOException $e) {
        // Log error if needed
        return false;
    }
}

function getBranches()
{
    global $pdo;

    try {
        $sql = "SELECT id_filiala, adresa_filiala, nr_telefon_filiala FROM Filiala_Crafti ORDER BY adresa_filiala";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log error if needed
        return [];
    }
}

function getEventsWithDateTime()
{
    global $pdo;

    try {
        $sql = "SELECT e.*, fdo.*, fc.adresa_filiala 
                FROM Eveniment e
                JOIN Filiala_Data_Ora fdo ON e.id_eveniment = fdo.id_eveniment
                JOIN Filiala_Crafti fc ON fdo.id_filiala = fc.id_filiala
                ORDER BY fdo.data, fdo.ora";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log error
        return [];
    }
}
?>