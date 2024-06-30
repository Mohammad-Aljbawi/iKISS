<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store POST values into session variables
    $_SESSION['dhaftpflichtversicherung'] = isset($_POST['DHaftpflichtversicherung']) ? $_POST['DHaftpflichtversicherung'] : '';
    $_SESSION['dsachkundenachweis'] = isset($_POST['DSachkundenachweis']) ? $_POST['DSachkundenachweis'] : '';
    $_SESSION['dmikrochip'] = isset($_POST['DMikrochip']) ? $_POST['DMikrochip'] : '';
    $_SESSION['anlagenanzahl'] = isset($_POST['Anlagenanzahl']) ? $_POST['Anlagenanzahl'] : '';
    $_SESSION['ergaenzung'] = isset($_POST['Ergaenzung']) ? $_POST['Ergaenzung'] : '';
    $_SESSION['btn'] = isset($_POST['Btn']) ? $_POST['Btn'] : '';
    
}

// Retrieve session values into PHP variables
$dhaftpflichtversicherung = isset($_SESSION['dhaftpflichtversicherung']) ? $_SESSION['dhaftpflichtversicherung'] : '';
$dsachkundenachweis = isset($_SESSION['dsachkundenachweis']) ? $_SESSION['dsachkundenachweis'] : '';
$dmikrochip = isset($_SESSION['dmikrochip']) ? $_SESSION['dmikrochip'] : '';
$anlagenanzahl = isset($_SESSION['anlagenanzahl']) ? $_SESSION['anlagenanzahl'] : '';
$ergaenzung = isset($_SESSION['ergaenzung']) ? $_SESSION['ergaenzung'] : '';
$btn = isset($_SESSION['btn']) ? $_SESSION['btn'] : '';
?>
    <section id="formular_container ">
        <div id="page6" class="form-step form-step-active">
            <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrein-Westfalen (LHundG NRW)
            </h2>
            <hr>
            <h3>Ergänzungen / Anlagen </h3>
            <hr>
            <form action="seite2.php" method="post" id="sachkunde_form" enctype="multipart/form-data" onsubmit=" validateForm(event)">
                <input type="hidden" name="DHaftpflichtversicherung" value="<?php echo $dhaftpflichtversicherung ?>">
                <input type="hidden" name="Unterschrift" value="<?php echo $unterschrift ?>">
                <input type="hidden" name="DSachkundenachweis" value="<?php echo $dsachkundenachweis ?>">
                <input type="hidden" name="DMikrochip" value="<?php echo $dmikrochip ?>">
                <input type="hidden" name="Anlagenanzahl" value="<?php echo $anlagenanzahl ?>">
                <input type="hidden" name="Ergaenzung" value="<?php echo $ergaenzung ?>">
                <input type="hidden" name="Btn" value="<?php echo $btn ?>">
                <input type="hidden" name="Agb" value="<?php echo $agb?>" <?php if($agb === "checked" ) echo "checked"; ?> >
                
                <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;" id="nachweis">
                    <div>
                        <p>Ergänzungen</p>
                        <textarea value="" name="Ergaenzung" id="ergaenzung" rows="4" cols="50"></textarea>
                    </div>
                    <hr>
                    <div>
                        <h5>Nachweise</h5>
                        <p>Bitte fügen Sie folgende Anlagen bei!</p>
                        <p>Die Kopie einer Haftpflichtversicherung * </p>
                        <div>
                            <input type="radio" value="checked" name="DHaftpflichtversicherung" id="thaftpflichtversicherung" <?php if($dhaftpflichtversicherung == "checked") echo "checked" ?> onclick="showFileInput('thaftpflichtversicherung','hvblock')">
                            <label for="thaftpflichtversicherung">ist beigefügt</label>
                            <input type="radio" value="unchecked" name="DHaftpflichtversicherung" id="fhaftpflichtversicherung"<?php if($dhaftpflichtversicherung == "unchecked") echo "checked" ?> onclick="showFileInput('thaftpflichtversicherung','hvblock')">
                            <label for="fhaftpflichtversicherung">wird nachgereicht</label>
                        </div>
                        <div id="hvblock"></div>
                    </div>
                    <hr>
                    <div>
                        <p>Ein Sachkundenachweis oder eine Bescheinigung *</p>
                        <div>
                            <input type="radio" value="checked" name="DSachkundenachweis" id="tsachkundenachweis" <?php if($dsachkundenachweis == "checked") echo "checked" ?> onclick="showFileInput('tsachkundenachweis','sknblock')">
                            <label for="tsachkundenachweis">ist beigefügt</label>
                            <input type="radio" value="unchecked" name="DSachkundenachweis" id="fsachkundenachweis" <?php if($dsachkundenachweis == "unchecked") echo "checked" ?> onclick="showFileInput('tsachkundenachweis','sknblock')">
                            <label for="fsachkundenachweis">wird nachgereicht</label>
                        </div>
                        <div id="sknblock"> </div>
                    </div>
                    <hr>
                    <div>
                        <div>
                            <p>Ein Nachweis zum Mikrochip * </p>
                            <input type="radio" value="checked" name="DMikrochip" id="tmikrochip" <?php if($dmikrochip == "checked") echo "checked" ?> onclick="showFileInput('tmikrochip','mcnblock')">
                            <label for="tmikrochip">ist beigefügt</label>
                            <input type="radio" value="unchecked" name="DMikrochip" <?php if($dmikrochip == "unchecked") echo "checked" ?> id="fmikrochip" onclick="showFileInput('tmikrochip','mcnblock')">
                            <label for="fmikrochip">wird nachgereicht</label>
                        </div>
                        <div id="mcnblock"> </div>
                    </div>
                    <hr>
                    <div>
                        <div>
                            <label for="anlagenanzahl" class="block">Wie viele weitere Anlagen möchten Sie hinzufügen? </label>
                            <select type="select" name="Anlagenanzahl" id="anlagenanzahl" required
                                onchange="updateFileInput()">
                                <option value="0" selected> Keine weitere Anlagen </option>
                                <option value="1" <?php if($anlagenanzahl == "1") echo "selected" ?> >1 weitere Anlage</option>
                                <option value="2" <?php if($anlagenanzahl == "2") echo "selected" ?> >2 weitere Anlage</option>
                                <option value="3" <?php if($anlagenanzahl == "3") echo "selected" ?> >3 weitere Anlage</option>
                                <option value="4" <?php if($anlagenanzahl == "4") echo "selected" ?> >4 weitere Anlage</option>
                                <option value="5" <?php if($anlagenanzahl == "5") echo "selected" ?> >5 weitere Anlage</option>
                                <option value="6" <?php if($anlagenanzahl == "6") echo "selected" ?> >6 weitere Anlage</option>
                            </select>
                        </div>
                            <div id="inputblock"></div>
                        </div>
                    </div>
                </div>
                    <div class="btns-group">
                        <button  id="page5_to_page4" class="btn btn-prev" name="Btn" onclick="prevRequired()" value="backpage5">Previous</button>
                        <button class="btn"  name="Save" value="Save" onclick="savePageAsHtml()">Seite zwischen speichern</button>
                        <button type="submit" id="angaben" class="btn btn-next" name="Btn" value="angaben">Angeben überprüfen</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<script>
    function showFileInput(radioId, blockId) {
        var radioElement = document.getElementById(radioId);
        var hochladen = document.getElementById(blockId);
        hochladen.innerHTML = "";

        if (radioElement.checked) {
            var fileInput = document.createElement("input");
            var label = document.createElement("label");

            fileInput.type = "file";
            fileInput.size = "2000000";
            fileInput.accept = ".pdf ";
            fileInput.required = true;
            fileInput.name = "dateien[]";

            label.innerHTML = "Maximale Größe ist 2 MB";

            hochladen.appendChild(fileInput);
            hochladen.appendChild(label);
        } else {
            hochladen.innerHTML = "";
        }

    }

    function updateFileInput() {
    var anzahl = parseInt(document.getElementById("anlagenanzahl").value);
    var inputBlock = document.getElementById("inputblock");
    inputBlock.innerHTML = "";

    for (var i = 1; i <= anzahl; i++) {
        var fileInput = document.createElement("input");
        var label = document.createElement("label");

        fileInput.type = "file";
        fileInput.size = "2000000";
        fileInput.accept = ".pdf";
        fileInput.required = true;
        fileInput.name = "dateien[]"; // Eindeutiger Name für das Input-Feld

        label.innerHTML = "Maximale Größe ist 2 MB";

        inputBlock.appendChild(fileInput);
        inputBlock.appendChild(label);
        inputBlock.appendChild(document.createElement("br"));
    }
}
</script>