<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Anzahl der Dateien, die hochgeladen werden sollen (optional)
    $anzahlAnlagen = $_POST['Anlagenanzahl'];

    // Verarbeitung der hochgeladenen Dateien
    foreach ($_FILES['dateien']['name'] as $key => $name) {
        $file_name = $_FILES['dateien']['name'][$key];
        $file_size = $_FILES['dateien']['size'][$key];
        $file_tmp = $_FILES['dateien']['tmp_name'][$key];
        $file_type = $_FILES['dateien']['type'][$key];

        // Hier können Sie die Datei speichern oder weitere Prüfungen durchführen
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
    }
}
?>
