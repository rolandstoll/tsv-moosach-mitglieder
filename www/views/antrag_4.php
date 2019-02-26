<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div id="progress" class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag" class="text-white">Persönliche Daten</a></li>
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag/2" class="text-white">Auswahl Abteilungen</a></li>
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag/3" class="text-white">Bankverbindung</a></li>
        <li class="w-25 list-group-item active font-weight-bold">Zusammenfassung</li>
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
                <div class="col-md-3 font-weight-bold"><?= $abteilungen[$key]; ?></div><div class="col-md-5" style="font-size: 0.8rem"><?= $extras[$key]; ?></div><div class="col-md-2 text-right"><?= $beitrag[$key]; ?>.- EUR</div>
            <?php } ?>
            <div class="col-md-3 bg-secondary text-white font-weight-bold mt-2">GESAMT</div><div class="col-md-5 mt-2 bg-secondary text-white" style="font-size: 0.8rem"><strong>Beitrag lfd. Jahr</strong></div><div class="col-md-2 text-right mt-2 bg-secondary text-white font-weight-bold"><?= $gesamt; ?>.- EUR</div>
            <div class="col-md-3 font-weight-bold mt-2 text-secondary">GESAMT</div><div class="col-md-5 mt-2 text-secondary" style="font-size: 0.8rem"><strong>Beitrag folgende Jahre</strong><br>(Änderungen zum lfd. Jahr durch Abt. Fußball/Eintrittsdatum möglich)</div><div class="col-md-2 text-right mt-2 font-weight-bold text-secondary"><?= $gesamtNext; ?>.- EUR</div>
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
        <p class="lead">Gläubiger-ID / Mandats-Referenznummer:</p>
        <div class="row">
            <div class="col-md-6 font-weight-bold">Unsere Gläubiger ID im SEPA Lastschriftverfahren:</div><div class="col-md-6">DE04 ZZZ0 0000 4535 66</div>
            <div class="col-md-6 font-weight-bold">Ihre Mandats-Referenznummer:</div><div class="col-md-6"><?= $data['mandats_referenznummer']; ?></div>
        </div>

        <hr>
        <p class="lead">Bankverbindung:</p>
        <div class="row">
            <div class="col-md-6 font-weight-bold">Kontoinhaber Nachname, Vorname:</div><div class="col-md-6"><?= $data['konto_nachname']; ?>, <?= $data['konto_vorname']; ?></div>
            <div class="col-md-6 font-weight-bold">Kreditinstitut:</div><div class="col-md-6"><?= $data['konto_kreditinstitut']; ?></div>
            <div class="col-md-6 font-weight-bold">IBAN:</div><div class="col-md-6"><?= $data['konto_iban']; ?></div>
            <div class="col-md-6 font-weight-bold">BIC:</div><div class="col-md-6"><?= $data['konto_bic']; ?></div>
        </div>

        <hr>
        <p class="lead">Zustimmungen:</p>
        <div class="row">
            <div class="col-md-9 font-weight-bold">Datenschutz / Persönlichkeitsrechte anerkannt</div><div class="col-md-3"><?= (isset($_SESSION['datenschutz'])) ? 'ja' : 'nein';?></div>
            <div class="col-md-9 font-weight-bold">Fußball: Adressdaten Nutzungszustimmung für Marketingzwecke</div><div class="col-md-3"><?= (isset($_SESSION['zustimmung_fussball'])) ? 'ja' : 'nein';?></div>
            <div class="col-md-9 font-weight-bold">Zustimmung Vereinssatzungen, Statuten des BLSV und Lastschrift-Einzugsermächtigung auf SEPA-Basis</div><div class="col-md-3"><?= (isset($_SESSION['zustimmung'])) ? 'ja' : 'nein';?></div>
        </div>
    </div>

    <form id="myForm" method="POST" class="row m-12" novalidate>
        <input type="hidden" id="token" name="token">
    </form>
</div>

<div class="row p-3">
    <button onclick="window.print();" class="btn btn-success mt-3"><ion-icon name="print"></ion-icon> Antrag ausdrucken</button>
    <button onclick="submitForm();" class="btn btn-primary mt-3 ml-3">Antrag absenden</button>
</div>