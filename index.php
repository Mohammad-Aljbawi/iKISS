<?php
session_start();
require 'OOPHandler.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['formData'] = $_POST;
}
$formHandler = new FormHandler();
$currentPage = $formHandler->getCurrentPage();
$formData = $formHandler->getFormData();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Mehrseitiges Formular</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="ui.js"></script>
</head>

<body>
    <?php if ($currentPage == 1) { ?>
        <section id="formular_container">
            <div class="form-step form-step active" id="page1">
                <h2>Einwilligungserklärung</h2>
                <p>Für den Schutz Ihrer personenbezogenen Daten haben wir alle technischen und organisatorischen Maßnahmen
                    getroffen, um ein hohes Schutzniveau zu schaffen. Wir halten uns dabei strikt an die Datenschutzgesetze
                    und die sonstigen datenschutzrelevanten Vorschriften. Ihre Daten werden ausschließlich über sichere
                    Kommunikationswege an die zuständige Stelle übergeben.</p>
                <p>Zur Bearbeitung Ihres Anliegens werden personenbezogene Daten von Ihnen erhoben, wie z.B. Name,
                    Anschrift, Kontaktdaten sowie die notwendigen Angaben zur Bearbeitung. Die Verwendung oder Weitergabe
                    Ihrer Daten an unbeteiligte Dritte wird ausgeschlossen.</p>
                <p>In dem Fall eines gebührenpflichtigen Vorgangs übermitteln wir zur Abwicklung der Bezahlung Ihre
                    bezahlrelevanten Daten an den ePayment-Provider.</p>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <?php echo $formData->renderHiddenFields(); ?>
                    <input type="checkbox" name="agb" id="agb" value="checked" <?php if ($formData->agb === "checked")
                        echo "checked"; ?> required>
                    <label for="agb"><strong>Ich habe die Datenschutzerklärung gelesen und nehme diese zur Kenntnis. Ich bin
                            damit einverstanden, dass meine Angaben und Daten elektronisch zu den in der
                            Datenschutzerklärung erläuterten Zwecken erhoben und gespeichert werden.</strong></label><br>
                    <hr>
                    <div class="btns-group">
                        <div class="btn-next-warpper">
                            <button type="submit" class="btn btn-next" name="btn" value="topage2">Weiter<i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php } elseif ($currentPage == 2) { ?>
        <section id="formular_container">
            <div id="page2" class="form-step form-step-active">
                <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrhein-Westfalen (LHundG
                    NRW)</h2>
                <hr>
                <h4>Anmeldepflicht</h4>
                <p>Als großer Hund im Sinne dieses Gesetzes gelten Hunde, die ausgewachsen eine Widerristhöhe von mindestens
                    40 cm oder ein Gewicht von mindestens 20 kg erreichen.</p>
                <hr>
                <div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <?php echo $formData->renderHiddenFields(); ?>
                        <label for="datum"><strong>Beginn der Hundehaltung:</strong></label><br> <br>
                        <input type="date" id="datum" name="hundhaltungsdatum" class="input datepicker hasDatepicker"
                            value="<?php echo htmlspecialchars($formData->hundhaltungsdatum); ?>" required>
                        <script>
                            window.onload = function () {
                                var datumInput = document.getElementById("datum");
                                datumInput.max = new Date().toISOString().split("T")[0];
                            };
                        </script>
                        <h4>Kosten:</h4>
                        <p>Gemäß Tarifstellennummer 18a.1.10 der Allgemeinen Verwaltungsgebührenordnung des Landes
                            Nordrhein-Westfalen in der zur Zeit gültigen Fassung ist die Entgegennahme der Anzeige über
                            dieHaltung eines Hundes im Sinne von § 11 Absatz 1 Landeshundegesetz
                            für das Land Nordrhein-Westfalen gebührenpflichtig. Es erfolgt ein gesonderter Gebührenbescheid
                            in Höhe von 25,00 &euro;.</p>
                        <hr>
                        <div>
                            <div class="nxt-btn-container">
                                <button type="submit" id="topage3" class="btn btn-next" name="btn" value="topage3"> Weiter<i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                            <div class="others-btn-container">
                                <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                    onclick="cancel()"><i class="fa-solid fa-xmark"></i> Abbrechnen</button>
                                <button id="backpage1" class="btn btn-prev" name="btn" onclick="prevRequired()"
                                    value="backpage1"><i class="fa-solid fa-chevron-left"></i> Zurück</button>
                                <button class="btn" id="save" name="Save" value="Save" onclick="prevRequired()"><i
                                        class="fa-solid fa-download"></i> Progress speichern</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <?php } elseif ($currentPage == 3) { ?>
        <section id="formular_container">
            <div id="page3" class="form-step form-step-active">
                <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrhein-Westfalen (LHundG
                    NRW)</h2>
                <hr>
                <h4>Hundehaltende Person</h4>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"
                    onsubmit="return validateAge()">
                    <?php echo $formData->renderHiddenFields(); ?>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-1x3">
                            <label for="vorname" class="block">Vorname:</label>
                            <input type="text" name="vname" value="<?php echo htmlspecialchars($formData->vname); ?>"
                                id="vorname" class="input_box" required><br>
                        </div>
                        <div class="column-1x3">
                            <label for="familienname" class="block">Familienname:</label>
                            <input type="text" name="nname" value="<?php echo htmlspecialchars($formData->nname); ?>"
                                id="familienname" class="input_box" required><br>
                        </div>
                        <div class="column-1x3">
                            <label for="geburtsname" class="block">Gegebenenfalls Geburtsname:</label>
                            <input type="text" name="gname" value="<?php echo htmlspecialchars($formData->gname); ?>"
                                id="geburtsname" class="input_box"><br>
                        </div>
                    </div>
                    <hr>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-2x5">
                            <label for="gdatum" class="block">Geburtsdatum:</label><br>
                            <div id="geburtsdatum-error" style="color: red; display: none;"></div>
                            <input type="date" id="gdatum" name="gdatum"
                                value="<?php echo $formData->gdatum; ?>" required class="input_box"><br>
                        </div>
                        <div class="column-3x5">
                            <label for="gort" class="block">Geburtsort:</label>
                            <input type="text" name="gort" id="geburtsort" value="<?php echo  htmlspecialchars($formData->gort); ?>"
                                required class="input_box"><br>
                        </div>
                    </div>
                    <hr>
                    <h4>Anschrift</h4>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-4">
                            <label for="staat" class="block">Staat</label>
                            <select type="select" class="input_box" name="staat" id="staat" required>
                                <option <?php if ($formData->staat == 'Deutschland') echo " selected"; ?> value="Deutschland"> Deutschland </option>
                                <option <?php if ($formData->staat == 'Österreich') echo " selected"; ?> value="Österreich"> Österreich </option>
                                <option <?php if ($formData->staat == 'Schweiz') echo " selected"; ?> value="Schweiz"> Schweiz </option>
                                <option <?php if ($formData->staat == 'Syrien') echo " selected"; ?> value="Syrien"> Syrien </option>
                            </select>
                        </div>
                        <div class="column-4">
                            <label for="plz" class="block">Postleitzahl</label>
                            <input type="number" name="plz" value="<?php echo $formData->plz; ?>" id="plz" class="input_box"
                                required>
                        </div>
                        <div class="column-2x4">
                            <label for="ort" class="block">Ort:</label>
                            <input type="text" name="ort" value="<?php echo $formData->ort; ?>" id="ort" class="input_box"
                                required>
                        </div>
                    </div>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-2x3">
                            <label for="strasse" class="block">Straße:</label>
                            <input type="text" name="str" value="<?php echo $formData->str; ?>" id="strasse" required>
                        </div>
                        <div>
                            <label for="hausnummer" class="block">Hausnummer:</label>
                            <input type="number" name="hnr" value="<?php echo $formData->hnr; ?>" id="hausnummer"
                                required>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="nxt-btn-container">
                            <button type="submit" id="topage4" class="btn btn-next" name="btn" value="topage4">Weiter<i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="others-btn-container">
                            <button id="backpage2" class="btn btn-prev" name="btn" value="backpage2"
                                onclick="prevRequired()"><i class="fa-solid fa-chevron-left"></i> Zurück</button>
                            <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                onclick="cancel()"><i class="fa-solid fa-xmark"></i> Abbrechnen</button>
                            <button class="btn" id="save" name="Save" value="Save" onclick="prevRequired()"><i
                                    class="fa-solid fa-download"></i> Progress speichern</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php } elseif ($currentPage == 4) { ?>
        <section id="formular_container">
            <div id="page4" class="form-step form-step-active">
                <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrhein-Westfalen (LHundG
                    NRW)</h2>
                <hr>
                <h4>Angaben zum Hund</h4>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <?php echo $formData->renderHiddenFields(); ?>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-1x3">
                            <label for="hname" class="block">Name:</label>
                            <input type="text" name="hname" value="<?php echo $formData->hname; ?>" id="hname"
                                class="input_box" required><br>
                        </div>
                        <div class="column-1x3">
                            <label for="hrasse" class="block">Rasse / Beschreibung des Mischlingstyps:</label>
                            <input type="text" name="hrasse" value="<?php echo $formData->hrasse; ?>" id="hrasse"
                                class="input_box" required><br>
                        </div>
                    </div>
                    <hr>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="column-2x5">
                            <label for="hgeschlecht">Geschlecht:</label>
                            <select id="hgeschlecht" name="hgeschlecht" required>
                                <option value="weiblich" <?php if ($formData->hgeschlecht == 'weiblich')
                                    echo " selected"; ?>>
                                    weiblich</option>
                                <option value="männlich" <?php if ($formData->hgeschlecht == 'männlich')
                                    echo " selected"; ?>>
                                    männlich</option>
                            </select>
                        </div>
                        <div class="column-2x5">
                            <label for="hgdatum">Geburtsdatum:</label>
                            <input type="date" id="hgdatum" value="<?php echo $formData->hgdatum; ?>" name="hgdatum"
                                required>
                        </div>
                        <div class="column-2x5">
                            <label for="hkastration">Kastration erfolgt:</label>
                            <select id="hkastration" name="hkastration" required>
                                <option value="Ja" <?php if ($formData->hkastration == 'Ja')
                                    echo " selected"; ?>>Ja</option>
                                <option value="Nein" <?php if ($formData->hkastration == 'Nein')
                                    echo " selected"; ?>>Nein
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label for="hchipnr">Chipnummer:</label>
                        <input type="number" id="hchipnr" name="hchipnr" value="<?php echo $formData->hchipnr; ?>" required>
                    </div>
                    <div>
                        <label for="hkz">Fellfarbe / besondere Kennzeichen:</label>
                        <input type="text" id="hkz" name="hkz" value="<?php echo $formData->hkz; ?>" required>
                    </div>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;">
                        <div>
                            <label for="hgewicht">Gewicht in Kilogramm:</label>
                            <input type="number" id="hgewicht" name="hgewicht" value="<?php echo $formData->hgewicht; ?>"
                                onkeyup="getFloatValue('hgewicht')" required>
                        </div>
                        <div>
                            <label for="hhohe">Widerristhöhe in Zentimetern:</label>
                            <input type="number" id="hhohe" name="hhohe" value="<?php echo $formData->hhohe; ?>"
                                onkeyup="getFloatValue('hhohe')" required>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="nxt-btn-container">
                            <button type="submit" id="topage5" class="btn btn-next" name="btn" value="topage5">Weiter<i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="others-btn-container">
                            <button id="backpage3" class="btn btn-prev" name="btn" value="backpage3"><i
                                    class="fa-solid fa-chevron-left"></i> Zurück</button>
                            <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                onclick="cancel()"><i class="fa-solid fa-xmark"></i> Abbrechnen</button>
                            <button class="btn" id="save" name="Save" value="Save"><i class="fa-solid fa-download"></i>
                                Progress speichern</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php } elseif ($currentPage == 5) { ?>
        <section id="formular_container">
            <div id="page5" class="form-step form-step-active">
                <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrhein-Westfalen (LHundG
                    NRW)</h2>
                <hr>
                <h3>Sachkunde / Versicherung</h3>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"
                    id="sachkunde_form" onsubmit="validateForm(event)">
                    <?php echo $formData->renderHiddenFields(); ?>
                    <h5>Ich verfüge <span>*</span></h5>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;" id="nachweis">
                        <div>
                            <input type="radio" value="checked" name="sachkundenachweis" id="tnachweis" <?php if ($formData->sachkundenachweis == "checked")
                                echo " checked"; ?> onclick="showCheckboxs()">
                            <label for="tnachweis">über einen Sachkundenachweis, der diesem Antrag beiliegt (Hinweis: der
                                Sachkundenachweis kann zum Beispiel durch den örtlich zuständigen amtlichen Tierarzt
                                ausgestellt werden).</label>
                        </div>
                        <div>
                            <input type="radio" value="unchecked" name="sachkundenachweis" id="fnachweis" <?php if ($formData->sachkundenachweis == "unchecked")
                                echo " checked"; ?> onclick="showCheckboxs()">
                            <label for="fnachweis">nicht über einen Sachkundenachweis, da dieser entbehrlich ist.</label>
                        </div>
                        <p>Ich</p>
                        <div style="display:none;" id="checkBoxDiv">
                            <input type="checkbox" value="ja" name="berufserlaubnis" id="berufserlaubnis" <?php if ($formData->berufserlaubnis == 'ja')
                                echo " checked"; ?> onchange="showBeigelegtBoxs()">
                            <label for="berufserlaubnis">habe ein abgeschlossenes, tiermedizinisches Studium bzw. besitze
                                eine Berufserlaubnis nach § 11 der Bundes-Tierärzteordnung</label><br>
                            <input type="checkbox" value="ja" name="erlaubnisnach11" id="erlaubnisnach11" <?php if ($formData->erlaubnisnach11 == 'ja')
                                echo " checked"; ?> onchange="showBeigelegtBoxs()">
                            <label for="erlaubnisnach11">besitze eine Erlaubnis nach § 11 Absatz 1 Nummer 8 Buchstabe a)
                                beziehungsweise b) des Tierschutzgesetzes zur Zucht oder Haltung von Hunden oder zum Handel
                                mit Hunden.</label><br>
                            <input type="checkbox" value="ja" name="jaegerpruefung" id="jaegerpruefung" <?php if ($formData->jaegerpruefung == 'ja')
                                echo " checked"; ?> onchange="showBeigelegtBoxs()">
                            <label for="jaegerpruefung">besitze einen gültigen Jagdschein beziehungsweise habe die
                                Jägerprüfung mit Erfolg abgelegt.</label><br>
                            <input type="checkbox" value="ja" name="polizeihundefuehrer" id="polizeihundefuehrer" <?php if ($formData->polizeihundefuehrer == 'ja')
                                echo " checked"; ?> onchange="showBeigelegtBoxs()">
                            <label for="polizeihundefuehrer">bin als Polizeihundeführerin / Polizeihundeführer
                                tätig.</label><br>
                            <input type="checkbox" value="ja" name="erlaubnisnach10" id="erlaubnisnach10" <?php if ($formData->erlaubnisnach10 == 'ja')
                                echo " checked"; ?> onchange="showBeigelegtBoxs()">
                            <label for="erlaubnisnach10">bin gemäß § 10 Absatz 3 Hundegesetz für das Land
                                Nordrhein-Westfalen zur Erteilung von Sachkundebescheinigungen berechtigt. </label><br>
                            <div id="beigelegtlabel" style="display: none; margin:1%;">
                                <input type="checkbox" value="ja" name="bescheinigungbeigelegt" <?php if ($formData->bescheinigungbeigelegt == 'ja')
                                    echo " checked"; ?>
                                    id="bescheinigungbeigelegt">
                                <label for="bescheinigungbeigelegt">Eine Bescheinigung liegt diesem Antrag bei.</label><br>
                            </div>
                        </div>
                    </div>
                    <h4>Versicherung</h4>
                    <div class="column-1x3">
                        <p>Ich besitze die für die Hundehaltung notwendige Zuverlässigkeit.</p>
                        <h5>Ich versichere daher,</h5>
                        <p>dass ich in den letzten fünf Jahren nicht wegen</p>
                        <div>
                            <ul>
                                <li>vorsätzlichen Angriffs auf das Leben oder die Gesundheit, Vergewaltigung, Zuhälterei,
                                    Landfriedensbruchs oder Hausfriedensbruchs, Widerstandes gegen die Staatsgewalt, einer
                                    gemeingefährlichen Straftat oder einer Straftat gegen das Eigentum oder das Vermögen,
                                </li>
                                <li>einer im Zustand der Trunkenheit begangenen Straftat,</li>
                                <li>einer Straftat gegen das <a href="https://www.gesetze-im-internet.de/tierschg/"
                                        alt="Externer Link" target="_blank">Tierschutzgesetz</a>, <a
                                        href="https://www.gesetze-im-internet.de/waffg_2002/" alt="Externer Link"
                                        target="_blank">das Waffengesetz</a>, das <a
                                        href="https://www.gesetze-im-internet.de/krwaffkontrg/index.html"
                                        alt="Externer Link" target="_blank">Gesetz über die Kontrolle von Kriegswaffen</a>,
                                    das <a href="https://www.gesetze-im-internet.de/sprengg_1976/" alt="Externer Link"
                                        target="_blank">Sprengstoffgesetz</a> oder das <a
                                        href="https://www.gesetze-im-internet.de/bjagdg/" alt="Externer Link"
                                        target="_blank">Bundesjagdgesetz</a></li>
                            </ul>
                        </div>
                        <p>rechtskräftig verurteilt worden bin.</p>
                    </div>
                    <div>
                        <h5>Ich versichere weiterhin,</h5>
                        <p>dass ich nicht</p>
                        <ul>
                            <li>gegen die Vorschriften des <a href="https://www.gesetze-im-internet.de/tierschg/"
                                    alt="Externer Link" target="_blank">Tierschutzgesetz</a>, des <a
                                    href="https://www.gesetze-im-internet.de/hundverbreinfg/__2.html" alt="Externer Link"
                                    target="_blank">Hundeverbringungsgesetzes</a> und <a
                                    href="https://www.gesetze-im-internet.de/hundverbreinfg/__2.html" alt="Externer Link"
                                    target="_blank">Hundeeinfuhrbeschränkungsgesetzes</a>, des <a
                                    href="https://www.gesetze-im-internet.de/krwaffkontrg/index.html" alt="Externer Link"
                                    target="_blank">Gesetz über die Kontrolle von Kriegswaffen</a>, des <a
                                    href="https://www.gesetze-im-internet.de/sprengg_1976/" alt="Externer Link"
                                    target="_blank">Sprengstoffgesetz</a> oder des <a
                                    href="https://www.gesetze-im-internet.de/tierschg/" alt="Externer Link"
                                    target="_blank">Bundesjagdgesetzes</a> verstoßen habe,</li>
                            <li>wiederholt oder schwerwiegend gegen Vorschriften des Landeshundegesetzes beziehungsweise der
                                ehemaligen Landeshundeverordnung verstoßen habe,</li>
                            <li>auf Grund einer psychischen Krankheit oder einer geistigen oder seelischen Behinderung nach
                                § 1896 des Bürgerlichen Gesetzbuches betreut werde oder</li>
                            <li>trunksüchtig oder rauschmittelsüchtig bin.</li>
                        </ul>
                    </div>
                    <hr id="separtor">
                    <div>
                        <h5>Mir ist bekannt,</h5>
                        <p>dass große Hunde in Wohngebieten nur angeleint und unter Aufsicht geführt werden dürfen.</p>
                        <h5>Ferner ist mir bekannt,</h5>
                        <div>
                            <p>dass Ordnungswidrigkeiten nach dem Landeshundegesetz Nordrhein-Westfalen gemäß § 20 Absatz 3
                                Landeshundegesetz des Landes Nordrhein-Westfalen mit einer Geldbuße bis zu 100.000 &euro;
                                geahndet werden können.</p>
                            <input type="checkbox" id="haftpflichtversicherung" name="haftpflichtversicherung"
                                value="checked" <?php if ($formData->haftpflichtversicherung == 'checked')
                                    echo " checked"; ?>
                                required>
                            <label for="haftpflichtversicherung">Für die Hundehaltung besteht eine besondere
                                Haftpflichtversicherung zur Deckung der durch den Hund verursachten Personenschäden und
                                Sachschäden mit einer Mindestversicherungssumme in Höhe von 500.000,00 Euro für
                                Personenschäden und in Höhe von 250.000,00 Euro für sonstige Schäden. Ich versichere, dass
                                ich den nachgewiesenen Haftpflichtschutz für die Dauer der Haltung des Hundes
                                aufrechterhalten werde. </label>
                        </div>
                        <br>
                        <div>
                            <input type="checkbox" id="unterschrift" name="unterschrift" value="checked" <?php if ($formData->unterschrift == 'checked')
                                echo " checked"; ?> required>
                            <label for="unterschrift">Mit meiner Unterschrift bestätige ich Obengenanntes und füge einen
                                Haftpflichtversicherungsnachweis dem Antrag bei. Die Angaben sind vollständig und
                                richtig</label>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div class="nxt-btn-container">
                            <button type="submit" id="topage6" class="btn btn-next" name="btn" value="topage6"
                                onclick="validateForm(event)">Weiter<i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="others-btn-container">
                            <button id="backpage4" class="btn btn-prev" name="btn" value="backpage4"><i
                                    class="fa-solid fa-chevron-left"></i>Zurück</button>
                            <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                onclick="cancel()"><i class="fa-solid fa-xmark"></i>Abbrechnen</button>
                            <button class="btn" id="save" name="Save" value="Save"><i
                                    class="fa-solid fa-download"></i>Progress speichern</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php } elseif ($currentPage == 6) { ?>
        <section id="formular_container">
            <div id="page6" class="form-step form-step-active">
                <h2>Anzeige Haltung eines großen Hundes nach § 11 Absatz 1 Landeshundegesetz Nordrhein-Westfalen (LHundG
                    NRW)</h2>
                <hr>
                <h3>Ergänzungen / Anlagen</h3>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sachkunde_form"
                    enctype="multipart/form-data" onsubmit="validateForm(event)">
                    <?php echo $formData->renderHiddenFields(); ?>
                    <div class="column-1" style="margin-top: 10px; margin-bottom: 10px;" id="nachweis">
                        <div>
                            <p>Ergänzungen</p>
                            <textarea name="ergaenzung" id="ergaenzung" rows="4" cols="50" value="<?php echo htmlspecialchars($formData->ergaenzung); ?>"><?php echo htmlspecialchars($formData->ergaenzung); ?></textarea>
                        </div>
                        <hr>
                        <div>
                            <h5>Nachweise</h5>
                            <p>Bitte fügen Sie folgende Anlagen bei!</p>
                            <p>Die Kopie einer Haftpflichtversicherung *</p>
                            <div class="radio-container">
                                <div>
                                    <input type="radio" value="checked" name="dhaftpflichtversicherung"
                                        id="thaftpflichtversicherung"
                                        onclick="showFileInput('thaftpflichtversicherung', 'hvblock')" <?php if ($formData->dhaftpflichtversicherung == "checked")
                                            echo " checked"; ?>>
                                    <label for="thaftpflichtversicherung">ist beigefügt</label>
                                </div>
                                <div>
                                    <input type="radio" value="unchecked" name="dhaftpflichtversicherung"
                                        id="fhaftpflichtversicherung"
                                        onclick="showFileInput('thaftpflichtversicherung', 'hvblock')" <?php if ($formData->dhaftpflichtversicherung == "unchecked")
                                            echo " checked"; ?>>
                                    <label for="fhaftpflichtversicherung">wird nachgereicht</label>
                                </div>
                            </div>
                            <div id="hvblock"
                                style="<?php echo ($formData->dhaftpflichtversicherung == 'checked') ? 'display: block;' : 'display: none;'; ?>">
                                <input type="file" name="Dateien" id="input_hvblock" onchange="uploadFile('hvblock')">
                                <label for="input_hvblock">Max 2MB</label>
                            </div>
                            <div class="hvblock">
                                <button class="btn delete-btn" id="deleteButton_hvblock" style="display: none;"
                                    onclick="deleteFile('hvblock', event)"><i class="fas fa-trash"></i> Löschen</button>
                                <span style="display: none;" id="span_hvblock"></span>
                            </div>

                            <hr id="separtor">
                            <div>
                                <p>Ein Sachkundenachweis oder eine Bescheinigung *</p>
                                <div class="radio-container">
                                    <div>
                                        <input type="radio" value="checked" name="dsachkundenachweis"
                                            id="tsachkundenachweis"
                                            onclick="showFileInput('tsachkundenachweis', 'sknblock')" <?php if ($formData->dsachkundenachweis == "checked")
                                                echo " checked"; ?>>
                                        <label for="tsachkundenachweis">ist beigefügt</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="unchecked" name="dsachkundenachweis"
                                            id="fsachkundenachweis"
                                            onclick="showFileInput('tsachkundenachweis', 'sknblock')" <?php if ($formData->dsachkundenachweis == "unchecked")
                                                echo " checked"; ?>>
                                        <label for="fsachkundenachweis">wird nachgereicht</label>
                                    </div>
                                </div>
                                <div id="sknblock"
                                    style="<?php echo ($formData->dsachkundenachweis == 'checked') ? 'display: block;' : 'display: none;'; ?>">
                                    <input type="file" name="Dateien" id="input_sknblock" onchange="uploadFile('sknblock')">
                                    <label for="input_sknblock">Max 2MB</label>
                                </div>
                                <div class="sknblock">
                                    <button class="btn delete-btn" id="deleteButton_sknblock" style="display: none;"
                                        onclick="deleteFile('sknblock', event)"><i class="fas fa-trash"></i>
                                        Löschen</button>
                                    <span style="display: none;" id="span_sknblock"></span>
                                </div>
                            </div>
                            <hr id="separtor">
                            <div>
                                <p>Ein Nachweis zum Mikrochip *</p>
                                <div class="radio-container">
                                    <div>
                                        <input type="radio" value="checked" name="dmikrochip" id="tmikrochip"
                                            onclick="showFileInput('tmikrochip', 'mcnblock')" <?php if ($formData->dmikrochip == "checked")
                                                echo " checked"; ?>>
                                        <label for="tmikrochip">ist beigefügt</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="unchecked" name="dmikrochip" id="fmikrochip"
                                            onclick="showFileInput('tmikrochip', 'mcnblock')" <?php if ($formData->dmikrochip == "unchecked")
                                                echo " checked"; ?>>
                                        <label for="fmikrochip">wird nachgereicht</label>
                                    </div>
                                </div>
                                <div id="mcnblock"
                                    style="<?php echo ($formData->dmikrochip == 'checked') ? 'display: block;' : 'display: none;'; ?>">
                                    <input type="file" name="Dateien" id="input_mcnblock" placeholder="Mikrochip.pdf"
                                        onchange="uploadFile('mcnblock')">
                                    <label for="input_mcnblock">Max 2MB</label>
                                </div>
                                <div class="mcnblock">
                                    <button class="btn delete-btn" id="deleteButton_mcnblock" style="display: none;"
                                        onclick="deleteFile('mcnblock', event)"><i class="fas fa-trash"></i>
                                        Löschen</button>
                                    <span style="display: none;" id="span_mcnblock"></span>
                                </div>
                            </div>
                            <hr id="separtor">
                            <div>
                                <label for="anlagenanzahl" class="block">Wie viele weitere Anlagen möchten Sie
                                    hinzufügen?</label>
                                <select name="anlagenanzahl" id="anlagenanzahl" required onchange="updateFileInput()">
                                    <option value="0" <?php if ($formData->anlagenanzahl == "0")
                                        echo "selected"; ?>>Keine
                                        weitere Anlagen</option>
                                    <option value="1" <?php if ($formData->anlagenanzahl == "1")
                                        echo "selected"; ?>>1 weitere
                                        Anlage</option>
                                    <option value="2" <?php if ($formData->anlagenanzahl == "2")
                                        echo "selected"; ?>>2 weitere
                                        Anlagen</option>
                                    <option value="3" <?php if ($formData->anlagenanzahl == "3")
                                        echo "selected"; ?>>3 weitere
                                        Anlagen</option>
                                    <option value="4" <?php if ($formData->anlagenanzahl == "4")
                                        echo "selected"; ?>>4 weitere
                                        Anlagen</option>
                                    <option value="5" <?php if ($formData->anlagenanzahl == "5")
                                        echo "selected"; ?>>5 weitere
                                        Anlagen</option>
                                    <option value="6" <?php if ($formData->anlagenanzahl == "6")
                                        echo "selected"; ?>>6 weitere
                                        Anlagen</option>
                                </select>
                                <div id="inputblock"></div>
                            </div>
                            <hr>
                            <div>
                                <div class="nxt-btn-container">
                                    <button type="submit" id="angaben" class="btn btn-next" name="btn" value="angaben"><i
                                            class="fa-solid fa-eye"></i> Übersicht</button>
                                </div>
                                <div class="others-btn-container">
                                    <button id="page5_to_page4" class="btn btn-prev" name="btn" onclick="prevRequired()"
                                        value="backpage5"><i class="fa-solid fa-chevron-left"></i> Zurück</button>
                                    <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                        onclick="cancel()"><i class="fa-solid fa-xmark"></i> Abbrechnen</button>
                                    <button class="btn" id="save" name="Save" value="Save" onclick="prevRequired()"><i
                                            class="fa-solid fa-download"></i> Progress speichern</button>
                                </div>
                            </div>
                </form>
            </div>
        </section>
    <?php } elseif ($currentPage == 7) { ?>
        <div id="page7" class="form-step form-step-active">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <?php echo $formData->renderHiddenFields(); ?>
                <section class="form-step">
                    <!-- Hundhaltungsdatum -->
                    <div id="angaben-seite">
                        <h3>Haltungdatum:</h3>
                        <span>
                            <p>Hundhaltungsdatum: <span><?php echo htmlspecialchars($formData->hundhaltungsdatum); ?></span></p>
                        </span>
                        <span class="btn-controll-container">
                            <button type="submit" id="topage2" class="btn btn-controll" name="btn" value="topage2">
                                <i class="fa-solid fa-pen-to-square"></i> Korrigieren
                            </button>
                        </span>
                    </div>
                    <hr id="separtor">

                    <!-- Angaben zur Person -->
                    <div id="angaben-seite">
                        <h3>Angaben zur Person:</h3>
                        <span>
                            <p>Vorname: <span><?php echo htmlspecialchars($formData->vname); ?></span></p>
                            <p>Nachname: <span><?php echo htmlspecialchars($formData->nname); ?></span></p>
                            <p>Geburtsdatum: <span><?php echo htmlspecialchars($formData->gdatum); ?></span></p>
                            <p>Geburtsort: <span><?php echo htmlspecialchars($formData->gort); ?></span></p>
                            <p>Staat: <span><?php echo htmlspecialchars($formData->staat); ?></span></p>
                            <p>PLZ: <span><?php echo htmlspecialchars($formData->plz); ?></span></p>
                            <p>Stadt: <span><?php echo htmlspecialchars($formData->ort); ?></span></p>
                            <p>Straße: <span><?php echo htmlspecialchars($formData->str); ?></span></p>
                            <p>Hausnummer: <span><?php echo htmlspecialchars($formData->hnr); ?></span></p>
                        </span>
                        <span class="btn-controll-container">
                            <button type="submit" id="topage3" class="btn btn-controll" name="btn" value="topage3">
                                <i class="fa-solid fa-pen-to-square"></i> Korrigieren
                            </button>
                        </span>
                    </div>
                    <hr id="separtor">

                    <!-- Angaben zum Hund -->
                    <div id="angaben-seite">
                        <h3>Angaben zum Hund:</h3>
                        <span>
                            <p>Name: <span><?php echo htmlspecialchars($formData->hname); ?></span></p>
                            <p>Rasse: <span><?php echo htmlspecialchars($formData->hrasse); ?></span></p>
                            <p>Geschlecht: <span><?php echo htmlspecialchars($formData->hgeschlecht); ?></span></p>
                            <p>Kastration: <span><?php echo htmlspecialchars($formData->hkastration); ?></span></p>
                            <p>Geburtsdatum: <span><?php echo htmlspecialchars($formData->hgdatum); ?></span></p>
                            <p>Chipnummer: <span><?php echo htmlspecialchars($formData->hchipnr); ?></span></p>
                            <p>Gewicht: <span><?php echo htmlspecialchars($formData->hgewicht); ?></span></p>
                            <p>Höhe: <span><?php echo htmlspecialchars($formData->hhohe); ?></span></p>
                        </span>
                        <span class="btn-controll-container">
                            <button type="submit" id="topage4" class="btn btn-controll" name="btn" value="topage4">
                                <i class="fa-solid fa-pen-to-square"></i> Korrigieren
                            </button>
                        </span>
                    </div>
                    <hr id="separtor">

                    <!-- Ergänzungen / Anlagen -->
                    <div id="angaben-seite">
                        <h3>Ergänzungen / Anlagen:</h3>
                        <span>
                            <?php if (!empty($formData->ergaenzung)) { ?>
                                <p style="display:block; width:100%">Ergänzungen: <br>
                                    <span><?php echo nl2br(htmlspecialchars($formData->ergaenzung)); ?></span>
                                </p>
                            <?php } ?>
                            <p id="div_hvblock" style="display:none;">Haftpflichtversicherung: <span
                                    id="span_hvblock"></span>
                            </p>
                            <p id="div_sknblock" style="display:none;">Sachkundenachweis: <span id="span_sknblock"></span>
                            </p>
                            <p id="div_mcblock" style="display:none;">Mikrochip: <span id="span_mcnblock"></span></p>
                        </span>
                        <span class="btn-controll-container">
                            <button type="submit" id="topage5" class="btn btn-controll" name="btn" value="topage5">
                                <i class="fa-solid fa-pen-to-square"></i> Korrigieren
                            </button>
                        </span>
                    </div>
                    <hr>

                    <!-- Abschlussbuttons -->
                    <div>
                        <div class="nxt-btn-container">
                            <button type="submit" id="absenden" class="btn btn-next" name="Absenden" value="absenden">
                                <i class="fa-solid fa-paper-plane"></i> Abscicken
                            </button>
                        </div>
                        <div class="others-btn-container">
                            <button id="backpage6" class="btn btn-prev" name="btn" value="backpage6"
                                onclick="prevRequired()">
                                <i class="fa-solid fa-chevron-left"></i> Zurück
                            </button>
                            <button type="submit" id="abbrechnen" class="btn" name="Abbrechnen" value="abbrechnen"
                                onclick="cancel()">
                                <i class="fa-solid fa-xmark"></i> Abbrechnen
                            </button>
                            <button type="submit" id="vorschau" class="btn btn-next" name="Vorschau" value="vorschau">
                                <i class="fa-solid fa-file-pdf"></i> Vorschau
                            </button>
                        </div>
                    </div>
                    <div class="btns-group"></div>
                </section>
            </form>
        </div>
    <?php } ?>
</body>

</html>