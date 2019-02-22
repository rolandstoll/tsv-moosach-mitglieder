<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag" class="text-white">Persönliche Daten</a></li>
        <li class="w-25 list-group-item active font-weight-bold">Auswahl Abteilungen</li>
        <li class="w-25 list-group-item bg-light text-muted">Bankverbindung</li>
        <li class="w-25 list-group-item bg-light text-muted">Zusammenfassung</li>
    </ul>
</div>

<div class="row m-3">
    <div class="col-md-12 bg-light pb-3">
        <p class="lead pt-3">Bisher erhobene Daten:</p>
        <div class="row">
            <div class="col-md-3 font-weight-bold">Nachname, Vorname</div><div class="col-md-3"><?= $data['nachname']; ?>, <?= $data['vorname']; ?></div>
            <div class="col-md-3 font-weight-bold">Telefon</div><div class="col-md-3"><?= $data['telefon']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsdatum (Alter)</div><div class="col-md-3"><?= date('d.m.Y', strtotime($data['geburtsdatum'])); ?> (<?= $data['alter']; ?> Jahre)</div>
            <div class="col-md-3 font-weight-bold">Handy</div><div class="col-md-3"><?= $data['handy']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsort</div><div class="col-md-3"><?= $data['geburtsort']; ?></div>
            <div class="col-md-3 font-weight-bold">E-Mail</div><div class="col-md-3"><?= $data['email']; ?></div>
            <div class="col-md-3 font-weight-bold">Straße / Hausnummer</div><div class="col-md-9"><?= $data['strasse']; ?></div>
            <div class="col-md-3 font-weight-bold">PLZ / Stadt</div><div class="col-md-9"><?= $data['plz']; ?> <?= $data['stadt']; ?></div>
            <div class="col-md-6 font-weight-bold">Datenschutz / Persönlichkeitsrechte anerkannt</div><div class="col-md-6"><?= (isset($_SESSION['datenschutz'])) ? 'ja' : 'nein';?></div>
        </div>
    </div>
</div>

<form method="POST" class="row m-3 p-0 needs-validation" novalidate>
    <div class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">ABTEILUNGEN</div>
    <div class="col-md-12 font-weight-bold mb-2">
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

    <!-- hautpverein -->

    <div id="hauptvereinPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">HAUPTVEREIN</div>
    <div id="hauptvereinPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="hauptvereinBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>
    <div id="hauptvereinAlert" class="alert alert-warning mt-3" role="alert">
        <h5>Achtung!</h5>
        Jede Mitgliedschaft beim TSV Moosach-Hartmannshofen basiert auf der <strong>Mitgliedschaft im Hauptverein</strong>.
        Eine Mitgliedschaft in einer Abteilung OHNE Hauptverein ist nicht möglich!<br>
        Es können beliebig viele Abteilungen zu einer Mitgliedschaft beim Hauptverein dazu gebucht werden.<br>
        Wenn Sie bereits Mitglied beim TSV Moosach-Hartmannshofen sind und sich für eine weitere Abteilung anmelden möchten, können Sie den Hauptverein weglassen.
    </div>

    <!-- fussball -->

    <div id="fussballPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">ABTEILUNG FUSSBALL</div>
    <div id="fussballPanel" class="form-row col-12">
        <div class="col-md-4">
            <label for="eintrittsdatum">Eintrittsdatum</label>
            <select id="eintrittsdatum" name="eintrittsdatum" class="form-control">
                <option value="" selected>Bitte wählen...</option>
                <?php foreach ($config['Fußball']['Beitrag'] as $key => $val) { ?>
                    <option value="<?= $key?>">ab 1. <?= strftime('%B', mktime(0, 0, 0, $key, 10)); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <label for="passantrag">Passantrag</label>
            <select id="passantrag" name="passantrag" class="form-control">
                <option value="" selected>Bitte wählen...</option>
                <option value="erstausstellung">Erstausstellung</option>
                <option value="vereinswechsel">Vereinswechsel</option>
            </select>
        </div>
        <div class="col-md-4 mb-2" id="passnummerPanel" style="display: none">
            <label for="passnummer">Passnummer</label>
            <input type="text" class="form-control" id="passnummer" name="passnummer" placeholder="Passnummer">
        </div>
        <div class="col-md-8 mb-2" id="letzterVereinPanel" style="display: none">
            <label for="letzterVerein">Letzter Verein</label>
            <input type="text" class="form-control" id="letzterVerein" name="letzterVerein" placeholder="Letzter Verein">
        </div>
        <div class="col-md-4"></div>
        <div class="custom-control custom-switch mt-3">
            <input class="custom-control-input" type="checkbox" id="zustimmung_fussball" name="zustimmung_fussball">
            <label class="custom-control-label" for="zustimmung_fussball">
                Der Spieler / Vertretungsberechtigte hat die Zustimmung zur Nutzung der Adressdaten des Spielers für
                Marketingzwecke, insbesondere für Angebote des DFB, seiner Verbände sowie Partner erteilt.
            </label>
        </div>
        <div class="col-md-12 mb-2"></div>
        <div class="col-md-10 mt-2"><h6>Jahresbeitrag (lfd. Jahr)</h6></div>
        <div id="fussballBeitragLfdJahr" class="col-md-2 mt-2 text-right"><h5 class="price">--</h5></div>
        <div class="col-md-10"><h6>Aufnahmegebühr</h6></div>
        <div id="fussballBeitragAufnahme" class="col-md-2 text-right"><h5 class="price">--</h5></div>
        <div class="col-md-10"><h6>Passantrag</h6></div>
        <div id="fussballBeitragPassantrag" class="col-md-2 text-right"><h5 class="price">--</h5></div>
        <div class="col-md-10"><h5>Gesamtbetrag (lfd. Jahr)</h5></div>
        <div id="fussballBeitragGesamt" class="col-md-2 text-right"><h4 class="price">--</h4></div>
        <div class="col-md-10 mt-2"><h6>Jahresbeitrag (nächstes Jahr)</h6></div>
        <div id="fussballBeitragNaechstesJahr" class="col-md-2 mt-2 text-right"><h5 class="price">--</h5></div>
    </div>

    <!-- tennis -->

    <div id="tennisPanelHeader" class="form-row col-12 bg-light font-weight-bold p-2 mb-1 mt-3">ABTEILUNG TENNIS</div>
    <div id="tennisPanel" class="form-row col-12">
        <div class="col-md-4">
            <label for="tennisTarif">Tarif</label>
            <select id="tennisTarif" name="tennisTarif" class="form-control">
                <option value="" selected>Bitte wählen...</option>
                <?php foreach ($config['Tennis']['Beitrag'] as $key => $val) { ?>
                    <option value="<?= $val; ?>"><?= $key; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-12 mt-3 custom-file" id="studentNachweisPanel" style="display: none">
            <label class="custom-file-label" for="studentNachweis">Nachweis für aktives Studium (Ausweis, o.ä.)</label>
            <input type="file" class="custom-file-input" id="studentNachweis" required>
            <div class="invalid-feedback">Für den vergünstigten Studententarif benötigen wir einen gültigen Nachweis!</div>
        </div>
        <div class="col-md-12 mb-2"></div>
        <div class="col-md-10"><h5>Gesamtbetrag (lfd. Jahr)</h5></div>
        <div id="tennisBeitrag" class="col-md-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- ski -->

    <div id="skiPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">SKI</div>
    <div id="skiPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="skiBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- eisstock -->

    <div id="eisstockPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">EISSTOCK</div>
    <div id="eisstockPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="eisstockBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- eisstock -->

    <div id="damengymnastikPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">DAMENGYMNASTIK</div>
    <div id="damengymnastikPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="damengymnastikBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- rückenschule -->

    <div id="rueckenschulePanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">RÜCKENSCHULE</div>
    <div id="rueckenschulePanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="rueckenschuleBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- tischtennis -->

    <div id="tischtennisPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">TISCHTENNIS</div>
    <div id="tischtennisPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="tischtennisBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>

    <!-- fitness -->

    <div id="fitnessPanelHeader" class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">FITNESS</div>
    <div id="fitnessPanel" class="form-row col-12">
        <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
        <div id="fitnessBeitrag" class="col-md-2 mb-2 text-right"><h4 class="price">--</h4></div>
    </div>



    <button class="btn btn-primary mt-3" type="submit">weiter zur Bankverbindung</button>
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