<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div class="row m-3">
    <div class="col-md-12 bg-light">
        <p class="lead pt-3">Vielen Dank für Ihr Interesse beim <strong>TSV Moosach-Hartmannshofen</strong>!</p>
        <p>
            Im folgenden Formular können Sie in 4 Schritten für ein oder mehrere Abteilungen einen Antrag stellen.
            Nach Absenden des Formulars auf der letzten Seite erhalten Sie in Kürze eine Bestätigungsmail mit einem entsprechenden Bestätigungslink. Erst wenn Sie auf diesen Link klicken, wird Ihr Antrag bei uns aktiv.
            Wir werden dann sobald wie möglich Ihren Antrag bearbeiten - bitte geben Sie uns dafür ein paar Tage Zeit!
        </p>
        <p>
            <strong>Bitte beachten Sie, dass ein Antrag nicht automatisch zu einer Mitgliedschaft führt - in Einzelfällen müssen wir leider auch Anträge ablehnen!</strong>
        </p>
        <p>PS.: Wir nehmen Datenschutz und Persönlichkeitsrechte ernst - eine entsprechende Info finden Sie hier unten auf der ersten Seite, welcher Sie auch zustimmen müssen.</p>
    </div>
</div>

<div class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item active font-weight-bold">Persönliche Daten</li>
        <li class="w-25 list-group-item bg-light text-muted">Auswahl Abteilungen</li>
        <li class="w-25 list-group-item bg-light text-muted">Bankverbindung</li>
        <li class="w-25 list-group-item bg-light text-muted">Zusammenfassung</li>
    </ul>
</div>


<form method="POST" class="row m-3 p-0 needs-validation" novalidate>
    <div class="form-row col-12">
        <div class="col-md-4 mb-2">
            <label for="nachname">Nachname</label>
            <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname" required value="<?= isset($data['nachname']) ? $data['nachname'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte einen Nachnamen angeben!
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <label for="vorname">Vorname</label>
            <input type="text" class="form-control" id="vorname" name="vorname" placeholder="Vorname" required value="<?= isset($data['vorname']) ? $data['vorname'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte einen Vornamen angeben!
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-3 mb-2">
            <label for="geburtsdatum">Geburtsdatum</label>
            <input type="date" class="form-control" id="geburtsdatum" name="geburtsdatum" required value="<?= isset($data['geburtsdatum']) ? $data['geburtsdatum'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte ein Geburtsdatum angeben!
            </div>
        </div>
        <div class="col-md-1 mb-2">
            <label for="alter">Alter</label>
            <input type="text" class="form-control" id="alter" name="alter" readonly value="<?= isset($data['alter']) ? $data['alter'] : ''; ?>">
        </div>
        <div class="col-md-4 mb-2">
            <label for="geburtsort">Geburtsort</label>
            <input type="text" class="form-control" id="geburtsort" name="geburtsort" placeholder="Geburtsort" required value="<?= isset($data['geburtsort']) ? $data['geburtsort'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte einen Geburtsort angeben!
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-6 mb-2">
            <label for="strasse">Straße</label>
            <input type="text" class="form-control" id="strasse" name="strasse" placeholder="Straße" required value="<?= isset($data['strasse']) ? $data['strasse'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte eine Straße angeben!
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <label for="strasse">Hausnr.</label>
            <input type="text" class="form-control" id="hausnr" name="hausnr" placeholder="Hausnr." required value="<?= isset($data['hausnr']) ? $data['hausnr'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte eine Hausnummer angeben!
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-2 mb-2">
            <label for="plz">PLZ</label>
            <input type="text" class="form-control" id="plz" name="plz" placeholder="PLZ" required value="<?= isset($data['plz']) ? $data['plz'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte eine PLZ angeben.
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <label for="stadt">Stadt</label>
            <input type="text" class="form-control" id="stadt" name="stadt" placeholder="Stadt" required value="<?= isset($data['stadt']) ? $data['stadt'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte eine Stadt angeben.
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-4 mb-2">
            <label for="plz">Telefon</label>
            <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="<?= isset($data['telefon']) ? $data['telefon'] : ''; ?>">
        </div>
        <div class="col-md-4 mb-2">
            <label for="stadt">Handy</label>
            <input type="text" class="form-control" id="handy" name="handy" placeholder="Handy" value="<?= isset($data['handy']) ? $data['handy'] : ''; ?>">
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-8 mb-2">
            <label for="email">E-Mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" required value="<?= isset($data['email']) ? $data['email'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte eine gültige E-Mail-Adresse angeben.
            </div>
        </div>
    </div>

    <div class="col-md-12 bg-warning font-weight-bold p-2 mb-1 mt-3">DATENSCHUTZ / PERSÖNLICHKEITSRECHTE</div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input class="custom-control-input" type="checkbox" value="" id="datenschutz" name="datenschutz" required <?= ($data['datenschutz'] == true) ? 'checked=true' : ''; ?>>
            <label class="custom-control-label" for="datenschutz">
                <strong>Hiermit kenne ich die folgende Punkte in Bezug auf Datenschutz und Persönlichkeitsrechte an:</strong><br>
                <ol style="font-size: 12px;">
                    <li>
                        Der Verein erhebt, verarbeitet und nutzt personenbezogene Daten seiner Mitglieder unter Einsatz von
                        Datenverarbeitungsanlagen zur Erfüllung der in dieser Satzung aufgeführten Zwecke und Aufgaben (z.B. Name und
                        Anschrift, Bankverbindung, Telefonnummern und E-Mail-Adressen, Geburtsdatum, Lizenzen, Funktionen im Verein).
                    </li>
                    <li>
                        Durch ihre Mitgliedschaft und die damit verbundene Anerkennung dieser Satzung stimmen die Mitglieder der
                        <ul>
                            <li>Erhebung</li>
                            <li>Verarbeitung (Speicherung, Veränderung und Übermittlung)</li>
                            <li>Nutzung</li>
                        </ul>
                        ihrer personenbezogenen Daten im Rahmen der Erfüllung der satzungsgemäßen Aufgaben und Zwecke des Vereins zu.
                        Eine anderweitige Datenverwendung (z.B. Datenverkauf) ist nicht statthaft.
                    </li>
                    <li>
                        Durch ihre Mitgliedschaft und die damit verbundene Anerkennung dieser Satzung stimmen die Mitglieder außerdem der
                        Veröffentlichung von Bildern und Namen in Print- und Telemedien sowie elektronischen Medien zu, soweit dies den
                        satzungsgemäßen Aufgaben und Zwecken des Vereins entspricht.
                    </li>
                    <li>
                        Jedes Mitglied hat im Rahmen der gesetzlichen Vorschriften des Bundesdatenschutzgesetzes das Recht auf
                        <ul>
                            <li>Auskunft über die zu seiner Person gespeicherten Daten, deren Empfängern sowie den Zweck der Speicherung</li>
                            <li>Berichtigung seiner Daten im Falle der Unrichtigkeit</li>
                            <li>Löschung oder Sperrung seiner Daten</li>
                        </ul>
                    </li>
                </ol>

            </label>
            <div class="invalid-feedback">
                Datenschutz und Persönlichkeitsrechte müssen anerkannt werden.
            </div>
        </div>
    </div>

    <button class="btn btn-primary mt-3" type="submit">weiter zur Auswahl Abteilungen</button>
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
