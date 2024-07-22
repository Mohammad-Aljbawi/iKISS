<?php
class FormData
{
    public $agb;
    public $hundhaltungsdatum;
    public $vname;
    public $nname;
    public $gname;
    public $gdatum;
    public $gort;
    public $staat;
    public $plz;
    public $ort;
    public $str;
    public $hnr;
    public $hname;
    public $hrasse;
    public $hgeschlecht;
    public $hkastration;
    public $hgdatum;
    public $hchipnr;
    public $hkz;
    public $hgewicht;
    public $hhohe;
    public $sachkundenachweis;
    public $berufserlaubnis;
    public $erlaubnisnach11;
    public $erlaubnisnach10;
    public $jaegerpruefung;
    public $polizeihundefuehrer;
    public $bescheinigungbeigelegt;
    public $unterschrift;
    public $haftpflichtversicherung;
    public $dhaftpflichtversicherung;
    public $dsachkundenachweis;
    public $dmikrochip;
    public $anlagenanzahl;
    public $ergaenzung;
    public $btn;

    public function __construct()
    {
        $this->loadFromSession();
    }

    public function loadFromPost()
    {
        foreach ($this as $key => $value) {
            if (isset($_POST[$key])) {
                $this->$key = $_POST[$key];
            } else {
                $this->$key = '';
            }
        }
    }

    public function saveToSession()
    {
        foreach ($this as $key => $value) {
            $_SESSION[$key] = $this->$key;
        }
    }

    public function loadFromSession()
    {
        foreach ($this as $key => $value) {
            if (isset($_SESSION[$key])) {
                $this->$key = $_SESSION[$key];
            } else {
                $this->$key = '';
            }
        }
    }

    public function renderHiddenFields()
    {
        $html = '';
        foreach ($this as $key => $value) {
            // Standardversteckte Felder
            if ($key !== 'btn' && $key !== 'datei') {
                // Für Checkboxen und Radio-Buttons, sicherstellen, dass auch 'unchecked' gesendet wird
                if (is_array($value)) {
                    foreach ($value as $item) {
                        $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($item) . '">';
                    }
                } else {
                    $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                }
            }
        }
        return $html;
    }
}




class FormHandler
{
    private $currentPage;
    private $action;
    private $formData;

    public function __construct()
    {
        $this->currentPage = 1;
        $this->action = 0;
        $this->formData = new FormData();
        $this->handlePostData();
    }

    private function handlePostData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->formData->loadFromPost();
            $this->formData->saveToSession();

            // Debugging: Ausgabe der Session-Daten nach dem Speichern
            /*echo '<pre>Session Data After Save: ';
            print_r($_SESSION);
            echo '</pre>'; */

            $this->formData->loadFromSession();

            // Debugging: Ausgabe der FormData-Daten nach dem Laden
            /*echo '<pre>Session Data After Load: ';
            print_r($this->formData);
            echo '</pre>';*/
            $this->setCurrentPage();
            $this->setAction();
        }
    }

    private function setCurrentPage()
    {
        $btn = $this->formData->btn;

        if ($btn == 'backpage1') {
            $this->currentPage = 1;
        } elseif (($btn == 'backpage2') || ($btn == 'topage2' && isset($this->formData->agb) && $this->formData->agb == 'checked')) {
            $this->currentPage = 2;
        } elseif (($btn == 'backpage3') || ($btn == 'topage3' && isset($this->formData->hundhaltungsdatum))) {
            $this->currentPage = 3;
        } elseif (($btn == 'backpage4') || ($btn == 'topage4' && isset($this->formData->vname) && isset($this->formData->nname) && isset($this->formData->gdatum) && isset($this->formData->gort) && isset($this->formData->staat) && isset($this->formData->str) && isset($this->formData->hnr) && isset($this->formData->plz) && isset($this->formData->ort))) {
            $this->currentPage = 4;
        } elseif (($btn == 'backpage5') || ($btn == 'topage5' && isset($this->formData->hname) && isset($this->formData->hrasse) && isset($this->formData->hgeschlecht) && isset($this->formData->hkastration) && isset($this->formData->hgdatum) && isset($this->formData->hchipnr) && isset($this->formData->hkz) && isset($this->formData->hgewicht) && isset($this->formData->hhohe))) {
            $this->currentPage = 5;
        } elseif (($btn == 'backpage6') || ($btn == 'topage6' && (($this->formData->sachkundenachweis == 'checked') || ($this->formData->sachkundenachweis == 'unchecked' && (isset($this->formData->berufserlaubnis) || isset($this->formData->erlaubnisnach11) || isset($this->formData->jaegerpruefung) || isset($this->formData->polizeihundefuehrer) || isset($this->formData->erlaubnisnach10)) && isset($this->formData->bescheinigungbeigelegt))) && isset($this->formData->haftpflichtversicherung) && isset($this->formData->unterschrift))) {
            $this->currentPage = 6;
        } elseif ($btn == 'angaben' && isset($this->formData->sachkundenachweis) && isset($this->formData->unterschrift) && isset($this->formData->haftpflichtversicherung)) {
            $this->currentPage = 7;
        }
    }

    private function setAction()
    {
        if (isset($this->formData->absenden)) {
            $this->action = 1;
        } elseif (isset($this->formData->save)) {
            $this->action = 2;
        } elseif (isset($this->formData->abbrechnen)) {
            $this->action = 4;
        } elseif (isset($this->formData->vorschau) && isset($this->formData->vname) && isset($this->formData->nname) && isset($this->formData->gdatum) && isset($this->formData->gort) && isset($this->formData->staat) && isset($this->formData->str) && isset($this->formData->hnr) && isset($this->formData->plz) && isset($this->formData->ort) && isset($this->formData->hundhaltungsdatum) && isset($this->formData->hname) && isset($this->formData->hrasse) && isset($this->formData->hgeschlecht) && isset($this->formData->hkastration) && isset($this->formData->hgdatum) && isset($this->formData->hchipnr) && isset($this->formData->hkz) && isset($this->formData->hgewicht) && isset($this->formData->hhohe) && isset($this->formData->sachkundenachweis) && isset($this->formData->unterschrift) && isset($this->formData->haftpflichtversicherung)) {
            $this->action = 3;
        }
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getFormData()
    {
        return $this->formData;
    }
}

?>