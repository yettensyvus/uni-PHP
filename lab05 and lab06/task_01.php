<?php
//creare fisier
$fileO = fopen("fisier.txt", "w") or die("Eroare!");
//Inscriem date in fisier
fwrite($fileO, "1. Lupu Marcus 1990 2344455666677\n");
fwrite($fileO, "2. Agafita Marta 1988 4445556666787\n");
fwrite($fileO, "3. Cucu Ioana 1991 7748956996777\n");
fwrite($fileO, "4. Vasiloi Vasile 1987 5556667779999\n");
fwrite($fileO, "5. Afina Nelu 1992 99933456678888\n");
//Inchidem fisierul
fclose($fileO);
//Deschidem fisierul pentru adaugare date
$fileO = fopen("fisier.txt", "a") or die("Eroare!");
if (!$fileO) {
    echo ("Nu a fost gasit fisierul pentru adaugare date!");
} else {
    fwrite($fileO, "6. Vrancea Vera 1999 2224445556667\n");
    fwrite($fileO, "7. Clipa Sabrin 1988 8888777766667\n");
    fwrite($fileO, "8. Suruceanu Nelu 1990 99933456678888\n");
}
fclose($fileO);
//Deschidem fisierul pentru afisare date
$fileO = fopen("fisier.txt", "r") or die("Eroare!");
if (!$fileO) {
    echo ("Nu a fost gasit fisierul pentru afisare date!");
} else {
    echo "In fisier se pastreaza urmatoarele date:<br /><br />";
    while (!feof($fileO)) {
        echo fgets($fileO);
        echo "<br />";
    }
    fclose($fileO);
}
?>