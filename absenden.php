<?php
// absenden.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['pdfFile'])) {
    $uploadedFileName = $_FILES['pdfFile']['name'];
    $uploadedFileTmpName = $_FILES['pdfFile']['tmp_name'];

    // Pfad zum Speichern der hochgeladenen Datei
    $uploadDirectory = 'C:/xampp1/htdocs/test/uploads/'; // Passe den Pfad entsprechend deiner Umgebung an
    $targetFilePath = $uploadDirectory . $uploadedFileName;

    // Versuche, die Datei zu verschieben und zu speichern
    if (move_uploaded_file($uploadedFileTmpName, $targetFilePath)) {
        // Datei wurde erfolgreich hochgeladen
        echo "Die Datei $uploadedFileName wurde erfolgreich hochgeladen und verschickt.";

        // E-Mail-Versand vorbereiten
        $empfaenger = 'm.s.aljbawi.92@gmail.com';
        $betreff = 'Neue Datei wurde hochgeladen';
        $nachricht = 'Eine neue Datei wurde über das Formular hochgeladen. Siehe angehängte Datei.';

        // E-Mail-Header erstellen
        $header = "From: noreply@krz.de\r\n";
        $header .= "Reply-To: noreply@krz.de\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

        // E-Mail-Text
        $nachricht = "Eine neue Datei wurde über das Formular hochgeladen. Siehe angehängte Datei.";

        // Datei als Anhang hinzufügen
        $dateianhang = chunk_split(base64_encode(file_get_contents($targetFilePath)));
        $header .= "--boundary\r\n";
        $header .= "Content-Type: application/octet-stream; name=\"$uploadedFileName\"\r\n";
        $header .= "Content-Transfer-Encoding: base64\r\n";
        $header .= "Content-Disposition: attachment; filename=\"$uploadedFileName\"\r\n\r\n";
        $header .= "$dateianhang\r\n";
        $header .= "--boundary--\r\n";

        // E-Mail senden
        $mailSend = mail($empfaenger, $betreff, $nachricht, $header);

if ($mailSend) {
    echo 'Die E-Mail mit der Datei wurde erfolgreich verschickt!';
} else {
    echo 'Beim Versenden der E-Mail ist ein Fehler aufgetreten.';
}
    }
?>
