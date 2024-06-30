<?php
// seite3.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $uploadedFileName = isset($_FILES['pdfFile']['name']) ? $_FILES['pdfFile']['name'] : '';

    // Anzeige der gesammelten Daten
    echo "<h2>Zusammenfassung der Angaben</h2>";
    echo "<p><strong>Benutzername:</strong> $username</p>";
    echo "<p><strong>Passwort:</strong> $password</p>";
    echo "<p><strong>Hochgeladene PDF-Datei:</strong> $uploadedFileName</p>";

    // Formular zum Absenden der Daten
    echo "<form action=\"absenden.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"username\" value=\"$username\">";
    echo "<input type=\"hidden\" name=\"password\" value=\"$password\">";
    echo "<input type=\"hidden\" name=\"pdfFile\" value=\"$uploadedFileName\">";
    echo "<input type=\"submit\" value=\"Daten absenden\">";
    echo "</form>";

} else {
    echo 'Beim Anzeigen der Daten ist ein Fehler aufgetreten. Bitte gehen Sie zurück und versuchen Sie es erneut.';
}
?>
