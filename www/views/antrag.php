<script>
    var hauptvereinBeitragErwachsener = <?= $hauptverein['beitrag']['erwachsener']; ?>;
    var hauptvereinBeitragJugend = <?= $hauptverein['beitrag']['jugend']; ?>;
    var hauptvereinBeitragKind = <?= $hauptverein['beitrag']['kind']; ?>;

</script>

<div class="row p-3">
    <form method="POST" class="needs-validation col-md" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-2">
                <label for="nachname">Nachname</label>
                <input type="text" class="form-control" id="nachname" placeholder="Nachname" required>
                <div class="invalid-feedback">
                    Bitte einen Nachnamen angeben!
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label for="vorname">Vorname</label>
                <input type="text" class="form-control" id="vorname" placeholder="Vorname" required>
                <div class="invalid-feedback">
                    Bitte einen Vornamen angeben!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-2">
                <label for="geburtsdatum">Geburtsdatum</label>
                <input type="date" class="form-control" id="geburtsdatum" required>
                <div class="invalid-feedback">
                    Bitte ein Geburtsdatum angeben!
                </div>
            </div>
            <div class="col-md-1 mb-2">
                <label for="alter">Alter</label>
                <input type="text" class="form-control" id="alter" readonly>
            </div>
            <div class="col-md-4 mb-2">
                <label for="geburtsort">Geburtsort</label>
                <input type="text" class="form-control" id="geburtsort" placeholder="Geburtsort" required>
                <div class="invalid-feedback">
                    Bitte einen Geburtsort angeben!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-2">
                <label for="strasse">Straße</label>
                <input type="text" class="form-control" id="strasse" placeholder="Straße" required>
                <div class="invalid-feedback">
                    Bitte eine Straße angeben!
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label for="strasse">Hausnr.</label>
                <input type="text" class="form-control" id="hausnr" placeholder="Hausnr." required>
                <div class="invalid-feedback">
                    Bitte eine Hausnummer angeben!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-2 mb-2">
                <label for="plz">PLZ</label>
                <input type="text" class="form-control" id="plz" placeholder="PLZ" required>
                <div class="invalid-feedback">
                    Bitte eine PLZ angeben.
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label for="stadt">Stadt</label>
                <input type="text" class="form-control" id="stadt" placeholder="Stadt" required>
                <div class="invalid-feedback">
                    Bitte eine Stadt angeben.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-2">
                <label for="plz">Telefon</label>
                <input type="text" class="form-control" id="telefon" placeholder="Telefon">
            </div>
            <div class="col-md-4 mb-2">
                <label for="stadt">Handy</label>
                <input type="text" class="form-control" id="handy" placeholder="Handy">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-8 mb-2">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" id="email" placeholder="E-Mail" required>
                <div class="invalid-feedback">
                    Bitte eine gültige E-Mail-Adresse angeben.
                </div>
            </div>
        </div>
        <div class="form-row col-md-12 bg-green font-weight-bold p-2 mb-1 mt-3">ABTEILUNGEN</div>
        <div class="form-row col-md-12 font-weight-bold mb-2">
            Ich möchte als Mitglied in folgender/n Abteilung(en) beitreten:
        </div>
        <div class="form-group row col-md-12">
            <div class="col-md-3">
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="hauptverein" id="hauptverein" checked="checked">
                    <label class="custom-control-label" for="hauptverein">Hauptverein</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="fussball" id="fussball">
                    <label class="custom-control-label" for="fussball">Fußball</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="tennis" id="tennis">
                    <label class="custom-control-label" for="tennis">Tennis</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="ski" id="ski">
                    <label class="custom-control-label" for="ski">Ski</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="eisstock" id="eisstock">
                    <label class="custom-control-label" for="eisstock">Eisstock</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="damengymnastik" id="damengymnastik">
                    <label class="custom-control-label" for="damengymnastik">Damengymnastik</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="rueckenschule" id="rueckenschule">
                    <label class="custom-control-label" for="rueckenschule">Rückenschule</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="tischtennis" id="tischtennis">
                    <label class="custom-control-label" for="tischtennis">Tischtennis</label>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input class="custom-control-input" type="checkbox" name="fitness" id="fitness">
                    <label class="custom-control-label" for="fitness">Fitness</label>
                </div>
            </div>
        </div>
        <div class="form-row col-md-12 bg-danger font-weight-bold p-2 mb-1 mt-3">ZUSTIMMUNG</div>
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" value="" id="agreement" required>
                <label class="custom-control-label" for="agreement">
                    Die Vereinssatzungen und die Statuten des BLSV erkenne ich an. Beitragszahlung jährlich durch SEPA Basis Lastschrift.
                </label>
                <div class="invalid-feedback">
                    Die Vereinssatzungen und die Statuten des BLSV müssen anerkannt werden.
                </div>
            </div>
        </div>

        <div id="hauptvereinPanelHeader" class="form-row col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3">HAUPTVEREIN</div>
        <div id="hauptvereinPanel" class="form-row">
            <div class="col-md-10 mb-2"><h6>Jahresbeitrag</h6></div>
            <div id="hauptvereinBeitrag" class="col-md-2 mb-2 text-right"><h4>---</h4></div>
        </div>
        <div id="hauptvereinAlert" class="alert alert-warning mt-3" role="alert">
            <h5>Achtung!</h5>
            Jede Mitgliedschaft beim TSV Moosach-Hartmannshofen basiert auf der <strong>Mitgliedschaft im Hauptverein</strong>.
            Eine Mitgliedschaft in einer Abteilung OHNE Hauptverein ist nicht möglich!<br>
            Es können beliebig viele Abteilungen zu einer Mitgliedschaft beim Hauptverein dazu gebucht werden.<br>
            Wenn Sie bereits Mitglied beim TSV Moosach-Hartmannshofen sind und sich für eine weitere Abteilung anmelden möchten, können Sie den Hauptverein weglassen.
        </div>

        <div id="fussballPanelHeader" class="form-row col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3">ABTEILUNG FUSSBALL</div>
        <div id="fussballPanel" class="form-row">
            <div class="col-md-8 mb-2">
                <label for="letzter_verein">Letzter Verein</label>
                <input type="email" class="form-control" id="letzter_verein" placeholder="Letzter Verein">
            </div>
            <div class="col-md-8 mb-2">
                <label for="passnummer">Passnummer</label>
                <input type="email" class="form-control" id="passnummer" placeholder="Passnummer">
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" value="" id="agreement_fussball">
                <label class="custom-control-label" for="agreement_fussball">
                    Der Spieler / Vertretungsberechtigte hat die Zustimmung zur Nutzung der Adressdaten des Spielers für
                    Marketingzwecke, insbesondere für Angebote des DFB, seiner Verbände sowie Partner erteilt.
                </label>
            </div>
        </div>

        <div id="tennisPanelHeader" class="form-row col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3">ABTEILUNG TENNIS</div>
        <div id="tennisPanel" class="form-row">
            <div class="col-md-8 mb-2">
                Jahresbeitrag Erwachsene aktiv: 252,00 € (incl. 52,00 € Hauptverein)<br>
                Jahresbeitrag Studenten: 192,00 € (incl. 52,00 € Hauptverein)<br>
                Jahresbeitrag Jugend: 120,00 € (incl. 20,00 € Hauptverein)<br>
                Jahresbeitrag Erwachsene passiv: 78,00 € (incl. 52,00 € Hauptverein)<br>
                <br>
                Eine Aufnahmegebühr wird nicht erhoben.<br>
                <br>
                Der fällige Betrag wird jährlich über das SEPA Basis Lastschriftmandat (siehe oben) abgebucht.<br>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Antrag absenden</button>
    </form>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</div>