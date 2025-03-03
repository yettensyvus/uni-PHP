<?php
// Obtinem ziua curenta a saptamanii
$ziuaAzi = date("w");

// Definim zilele de lansare pentru fiecare serie
$schedule_SoloLeveling = 2;  // Marti
$schedule_BlueExorcist = 5;  // Vineri
$schedule_SakamotoDays = 0;   // Duminica

// Inițializăm variabila pentru mesaje
$mesaje = "";

// Calculăm zilele rămase pentru fiecare anime

// Solo Leveling
$zileRamaseSoloLeveling = ($ziuaAzi <= $schedule_SoloLeveling) ? ($schedule_SoloLeveling - $ziuaAzi) : (7 - ($ziuaAzi - $schedule_SoloLeveling));
if ($zileRamaseSoloLeveling == 0) {
    $mesaje .= "<p> Astazi apare un nou episod din <strong>Solo Leveling</strong>!</p>";
} elseif ($zileRamaseSoloLeveling == 1) {
    $mesaje .= "<p> Maine apare un nou episod din <strong>Solo Leveling</strong>!</p>";
} else {
    $mesaje .= "<p> Urmatorul episod din <strong>Solo Leveling</strong> apare in <strong>$zileRamaseSoloLeveling</strong> zile.</p>";
}

// Blue Exorcist
$zileRamaseBlueExorcist = ($ziuaAzi <= $schedule_BlueExorcist) ? ($schedule_BlueExorcist - $ziuaAzi) : (7 - ($ziuaAzi - $schedule_BlueExorcist));
if ($zileRamaseBlueExorcist == 0) {
    $mesaje .= "<p> Astazi apare un nou episod din <strong>Blue Exorcist</strong>!</p>";
} elseif ($zileRamaseBlueExorcist == 1) {
    $mesaje .= "<p> Maine apare un nou episod din <strong>Blue Exorcist</strong>!</p>";
} else {
    $mesaje .= "<p> Urmatorul episod din <strong>Blue Exorcist</strong> apare in <strong>$zileRamaseBlueExorcist</strong> zile.</p>";
}

// Sakamoto Days
$zileRamaseSakamotoDays = ($ziuaAzi <= $schedule_SakamotoDays) ? ($schedule_SakamotoDays - $ziuaAzi) : (7 - ($ziuaAzi - $schedule_SakamotoDays));
if ($zileRamaseSakamotoDays == 0) {
    $mesaje .= "<p> Astazi apare un nou episod din <strong>Sakamoto Days</strong>!</p>";
} elseif ($zileRamaseSakamotoDays == 1) {
    $mesaje .= "<p> Maine apare un nou episod din <strong>Sakamoto Days</strong>!</p>";
} else {
    $mesaje .= "<p> Următorul episod din <strong>Sakamoto Days</strong> apare in <strong>$zileRamaseSakamotoDays</strong> zile.</p>";
}

// Afisam mesajele
echo "<h2>📅 Program lansare episoade</h2>";
echo $mesaje;
?>
