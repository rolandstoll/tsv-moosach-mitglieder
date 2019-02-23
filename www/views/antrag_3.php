<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div id="progress" class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag" class="text-white">Persönliche Daten</a></li>
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag/2" class="text-white">Auswahl Abteilungen</a></li>
        <li class="w-25 list-group-item active font-weight-bold">Bankverbindung</li>
        <li class="w-25 list-group-item bg-light text-muted">Zusammenfassung</li>
    </ul>
</div>

<div class="row m-3">
    <div class="col-md-12 bg-light pb-3">
        <p class="lead pt-3">Persönliche Daten:</p>
        <div class="row">
            <div class="col-md-3 font-weight-bold">Nachname, Vorname</div><div class="col-md-3"><?= $data['nachname']; ?>, <?= $data['vorname']; ?></div>
            <div class="col-md-3 font-weight-bold">Telefon</div><div class="col-md-3"><?= $data['telefon']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsdatum (Alter)</div><div class="col-md-3"><?= date('d.m.Y', strtotime($data['geburtsdatum'])); ?> (<?= $data['alter']; ?> Jahre)</div>
            <div class="col-md-3 font-weight-bold">Handy</div><div class="col-md-3"><?= $data['handy']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsort</div><div class="col-md-3"><?= $data['geburtsort']; ?></div>
            <div class="col-md-3 font-weight-bold">E-Mail</div><div class="col-md-3"><?= $data['email']; ?></div>
            <div class="col-md-3 font-weight-bold">Straße / Hausnummer</div><div class="col-md-9"><?= $data['strasse']; ?> <?= $data['hausnr']; ?></div>
            <div class="col-md-3 font-weight-bold">PLZ / Stadt</div><div class="col-md-9"><?= $data['plz']; ?> <?= $data['stadt']; ?></div>
        </div>
        <hr>
        <p class="lead">Ausgewählte Abteilungen:</p>
        <div class="row">
            <?php foreach ($data['abteilung'] as $key => $value) { ?>
                <div class="col-md-4 font-weight-bold"><?= $abteilungen[$key]; ?></div><div class="col-md-4" style="font-size: 0.8rem"><?= $extras[$key]; ?></div><div class="col-md-2 text-right"><?= $beitrag[$key]; ?>.- EUR</div>
            <?php } ?>
            <div class="col-md-8 bg-secondary text-white font-weight-bold mt-2">GESAMT (Beitrag lfd. Jahr)</div><div class="col-md-2 text-right mt-2 bg-secondary text-white font-weight-bold"><?= $gesamt; ?>.- EUR</div>
            <div class="col-md-4 font-weight-bold mt-2 text-secondary">GESAMT (Beitrag folgende Jahre)</div><div class="col-md-4 mt-2 text-secondary" style="font-size: 0.8rem">(Änderungen zum lfd. Jahr durch Abt. Fußball/Eintrittsdatum möglich)</div><div class="col-md-2 text-right mt-2 font-weight-bold text-secondary"><?= $gesamtNext; ?>.- EUR</div>
        </div>

        <?php if (key_exists('fussball', $data['abteilung']) || key_exists('tennis', $data['abteilung'])) { ?>
        <hr>
        <p class="lead">Weitere Angaben:</p>
        <div class="row">
            <?php if (key_exists('fussball', $data['abteilung'])) { ?>
                <div class="col-md-12 bg-info text-white font-weight-bold text-uppercase"><?= $abteilungen['fussball']; ?></div>
                <div class="col-md-3 font-weight-bold">Eintrittsdatum/Tarif</div><div class="col-md-3">ab 1. <?= strftime('%B', mktime(0, 0, 0, $data['eintrittsdatum'], 10)); ?></div>
                <div class="col-md-3 font-weight-bold">Passantrag</div><div class="col-md-3"><?= $data['passantrag']; ?></div>
                <?php if ($data['passnummer']) { ?>
                    <div class="col-md-3 font-weight-bold">letzter Verein</div><div class="col-md-3"><?= $data['letzterVerein']; ?></div>
                    <div class="col-md-3 font-weight-bold">Passnummer</div><div class="col-md-3"><?= $data['passnummer']; ?></div>
                <?php } ?>
            <?php } ?>

            <?php if (key_exists('tennis', $data['abteilung'])) { ?>
                <div class="col-md-12 mt-3 bg-info text-white font-weight-bold text-uppercase"><?= $abteilungen['tennis']; ?></div>
                <div class="col-md-3 font-weight-bold">Tarif</div><div class="col-md-3"><?= $data['tennisTarif']; ?></div>
            <?php } ?>
        </div>
        <?php } ?>

        <hr>
        <p class="lead">Zustimmungen:</p>
        <div class="row">
            <div class="col-md-9 font-weight-bold">Datenschutz / Persönlichkeitsrechte anerkannt</div><div class="col-md-3"><?= (isset($_SESSION['datenschutz'])) ? 'ja' : 'nein';?></div>
            <div class="col-md-9 font-weight-bold">Fußball: Adressdaten Nutzungszustimmung für Marketingzwecke</div><div class="col-md-3"><?= (isset($_SESSION['zustimmung_fussball'])) ? 'ja' : 'nein';?></div>
        </div>
    </div>
</div>

<form method="POST" class="row m-3 p-0 needs-validation" novalidate>

    <div class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">GLAUBIGER-ID / MANDATS-REFERENZNUMMER</div>
    <div class="col-md-12">Unsere Gläubiger ID im SEPA Lastschriftverfahren: <strong>DE04 ZZZ 00000453566</strong></div>
    <div class="form-row col-12">
        <div class="col-md-4 mb-2">
            <label for="mandats_referenznummer">Ihre Mandats-Referenznummer</label>
            <input type="text" class="form-control" id="mandats_referenznummer" name="mandats_referenznummer" placeholder="_ _ _ _ _ _ _ _ _ _"  required value="<?= isset($data['mandats_referenznummer']) ? $data['mandats_referenznummer'] : ''; ?>" data-mask="A A A A A A A A A A"">
            <div class="invalid-feedback">
                Bitte das Kreditinstitut für die Bankverbindung angeben!
            </div>
        </div>
    </div>


    <div class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">BANKVERBINDUNG</div>
    <div class="form-row col-12">
        <div class="col-md-4 mb-2">
            <label for="konto_nachname">Nachname (Kontoinhaber)</label>
            <input type="text" class="form-control" id="konto_nachname" name="konto_nachname" placeholder="Nachname (Kontoinhaber)" required value="<?= isset($data['konto_nachname']) ? $data['konto_nachname'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte einen Nachnamen für die Bankverbindung angeben!
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <label for="konto_vorname">Vorname (Kontoinhaber)</label>
            <input type="text" class="form-control" id="konto_vorname" name="konto_vorname" placeholder="Vorname (Kontoinhaber)" required value="<?= isset($data['konto_vorname']) ? $data['konto_vorname'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte einen Vornamen für die Bankverbindung angeben!
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-8 mb-2">
            <label for="konto_kreditinstitut">Kreditinstitut</label>
            <input type="text" class="form-control" id="konto_kreditinstitut" name="konto_kreditinstitut" placeholder="Kreditinstitut" required value="<?= isset($data['konto_kreditinstitut']) ? $data['konto_kreditinstitut'] : ''; ?>">
            <div class="invalid-feedback">
                Bitte das Kreditinstitut für die Bankverbindung angeben!
            </div>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="col-md-4 mb-2">
            <label for="konto_iban">IBAN</label>
            <input type="text" class="form-control text-uppercase" id="konto_iban" name="konto_iban" placeholder="DE__ ____ ____ ____ ____ __" required value="<?= isset($data['konto_iban']) ? $data['konto_iban'] : ''; ?>" data-mask="SS00 0000 0000 0000 0000 00"">
            <div class="invalid-feedback">
                Bitte einen IBAN für die Bankverbindung angeben!
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <label for="konto_bic">BIC</label>
            <input type="text" class="form-control text-uppercase" id="konto_bic" name="konto_bic" placeholder="___________" required value="<?= isset($data['konto_bic']) ? $data['konto_bic'] : ''; ?>" data-mask="AAAAAAAAAAA"">
            <div class="invalid-feedback">
                Bitte einen BIC für die Bankverbindung angeben!
            </div>
        </div>
    </div>

    <div class="col-md-12 bg-warning font-weight-bold p-2 mb-1 mt-3">ZUSTIMMUNG</div>
    <div class="form-row col-12">
        <div class="custom-control custom-switch">
            <input class="custom-control-input" type="checkbox" value="" id="zustimmung" name="zustimmung" required <?= ($data['zustimmung'] == true) ? 'checked=checked' : ''; ?>>
            <label class="custom-control-label" for="zustimmung">
                Hiermit erkenne ich die <a href="http://www.tsvmoosach.de/wp-content/uploads/2014/02/Vereinssatzung.pdf" target="_blank">Vereinssatzungen</a> und die Statuten des BLSV.<br>
                Ich ermächtige den TSV Moosach-Hartmannshofen zur Einzugsermächtigung eines Lastschriftmandats auf SEPA-Basis für wiederkehrende Lastschriften.
            </label>
            <div class="invalid-feedback">
                Die Vereinssatzungen, die Statuten des BLSV und die Einzugsermächtigung müssen anerkannt bzw. erteilt werden.
            </div>
        </div>
    </div>

    <button class="btn btn-primary mt-3" type="submit">weiter zu Antragsdaten prüfen</button>
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