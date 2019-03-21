<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div id="progress" class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag" class="text-white">Persönliche Daten</a></li>
        <li class="w-25 list-group-item active font-weight-bold">Auswahl Abteilungen</li>
        <li class="w-25 list-group-item bg-light text-muted">Bankverbindung</li>
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
        <p class="lead">Zustimmungen:</p>
        <div class="row">
            <div class="col-md-9 font-weight-bold">Datenschutz / Persönlichkeitsrechte anerkannt</div><div class="col-md-3"><?= (isset($_SESSION['datenschutz'])) ? 'ja' : 'nein';?></div>
        </div>
    </div>
</div>

<form id="myForm" method="POST" class="row m-3 p-0 needs-validation" novalidate>
    <div class="col-md-12 bg-light font-weight-bold p-2 mb-1 mt-3">ABTEILUNGEN</div>
    <div class="col-md-12 font-weight-bold mb-2">
        Ich möchte als Mitglied in folgender/n Abteilung(en) beitreten:
    </div>
    <div class="form-group row col-md-12">
        <div class="col-md-3">
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="hauptverein" id="hauptverein" <?= ($data['abteilung']['hauptverein'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="hauptverein">Hauptverein</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="fussball" id="fussball" <?= ($data['abteilung']['fussball'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="fussball">Fußball</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="tennis" id="tennis" <?= ($data['abteilung']['tennis'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="tennis">Tennis</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="ski" id="ski" <?= ($data['abteilung']['ski'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="ski">Ski</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="eisstock" id="eisstock" <?= ($data['abteilung']['eisstock'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="eisstock">Eisstock</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="damengymnastik" id="damengymnastik" <?= ($data['abteilung']['damengymnastik'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="damengymnastik">Damengymnastik</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="rueckenschule" id="rueckenschule" <?= ($data['abteilung']['rueckenschule'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="rueckenschule">Rückenschule</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="tischtennis" id="tischtennis" <?= ($data['abteilung']['tischtennis'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="tischtennis">Tischtennis</label>
            </div>
            <div class="custom-control custom-switch mb-2">
                <input class="custom-control-input" type="checkbox" name="fitness" id="fitness" <?= ($data['abteilung']['fitness'] == true) ? 'checked=checked' : ''; ?>>
                <label class="custom-control-label" for="fitness">Fitness</label>
            </div>
        </div>
    </div>

    <?php
    foreach ($abteilungen as $abteilung => $abteilungTitel ) {
        switch($abteilung) {
            case 'hauptverein': ?>

                <!-- hautpverein -->
                <div id="<?= $abteilung ?>PanelHeader" class="col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3 text-uppercase"><?= $abteilungTitel ?></div>
                <div id="<?= $abteilung ?>Panel" class="form-row col-12">
                    <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
                    <div id="<?= $abteilung ?>Beitrag" class="col-md-2 mb-2 text-right"><h5 class="price">--</h5></div>
                </div>
                <div id="<?= $abteilung ?>Alert" class="alert alert-warning mt-3" role="alert">
                    <h5>Achtung!</h5>
                    Jede Mitgliedschaft beim TSV Moosach-Hartmannshofen basiert auf der <strong>Mitgliedschaft im Hauptverein</strong>.
                    Eine Mitgliedschaft in einer Abteilung OHNE Hauptverein ist nicht möglich!<br>
                    Es können beliebig viele Abteilungen zu einer Mitgliedschaft beim Hauptverein dazu gebucht werden.<br>
                    Wenn Sie bereits Mitglied beim TSV Moosach-Hartmannshofen sind und sich für eine weitere Abteilung anmelden möchten, können Sie den Hauptverein weglassen.
                </div>

    <?php       break;
            case 'fussball': ?>

                <!-- fussball -->
                <div id="<?= $abteilung ?>PanelHeader" class="col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3 text-uppercase">Abteilung <?= $abteilungTitel ?></div>
                <div id="<?= $abteilung ?>Panel" class="form-row col-12">
                    <div class="col-md-4">
                        <label for="eintrittsdatum">Eintrittsdatum</label>
                        <select id="eintrittsdatum" name="eintrittsdatum" class="form-control">
                            <option value="" selected>Bitte wählen...</option>
                            <?php foreach ($config['Fußball']['Beitrag'] as $key => $val) { ?>
                                <option value="<?= $key; ?>" <?= ($data['eintrittsdatum'] == $key ? 'selected': '') ?>>
                                    <?php if(is_int($key)) {?>
                                        ab 1. <?= strftime('%B', mktime(0, 0, 0, $key, 10)); ?>
                                    <?php } else { ?>
                                        <?= $key; ?>
                                    <?php } ?>

                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <label for="passantrag">Passantrag</label>
                        <select id="passantrag" name="passantrag" class="form-control">
                            <option value="" selected>Bitte wählen...</option>
                            <?php foreach ($config['Fußball']['Passantrag'] as $key => $val) { ?>
                                <option value="<?= $key; ?>" <?= ($data['passantrag'] == $key ? 'selected': '') ?>><?= $key; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2" id="passnummerPanel" style="display: none">
                        <label for="passnummer">Passnummer</label>
                        <input type="text" class="form-control" id="passnummer" name="passnummer" placeholder="Passnummer" value="<?= isset($data['passnummer']) ? $data['passnummer'] : ''; ?>">
                    </div>
                    <div class="col-md-8 mb-2" id="letzterVereinPanel" style="display: none">
                        <label for="letzterVerein">Letzter Verein</label>
                        <input type="text" class="form-control" id="letzterVerein" name="letzterVerein" placeholder="Letzter Verein" value="<?= isset($data['letzterVerein']) ? $data['letzterVerein'] : ''; ?>">
                    </div>
                    <div class="col-md-4"></div>
                    <div class="custom-control custom-switch mt-3">
                        <input class="custom-control-input" type="checkbox" id="zustimmung_fussball" name="zustimmung_fussball" <?= ($data['zustimmung_fussball'] == true) ? 'checked=checked' : ''; ?>>
                        <label class="custom-control-label" for="zustimmung_fussball">
                            Der Spieler / Vertretungsberechtigte hat die Zustimmung zur Nutzung der Adressdaten des Spielers für
                            Marketingzwecke, insbesondere für Angebote des DFB, seiner Verbände sowie Partner erteilt.
                        </label>
                    </div>
                    <div class="col-md-12 mb-2"></div>
                    <div class="col-md-10"><h6>Jahresbeitrag (lfd. Jahr)</h6></div>
                    <div id="<?= $abteilung ?>BeitragLfdJahr" class="col-md-2 text-right"><h6 class="price">--</h6></div>
                    <div class="col-md-10"><h6>Aufnahmegebühr (einmalig)</h6></div>
                    <div id="<?= $abteilung ?>BeitragAufnahme" class="col-md-2 text-right"><h6 class="price"><?= $config['Fußball']['Aufnahmegebühr']?></h6></div>
                    <div class="col-md-10"><h6>Passantrag</h6></div>
                    <div id="<?= $abteilung ?>BeitragPassantrag" class="col-md-2 text-right"><h6 class="price">--</h6></div>
                    <div class="col-md-10"><h5>Fußball Gesamtbeitrag (lfd. Jahr)</h5></div>
                    <div id="<?= $abteilung ?>BeitragGesamt" class="col-md-2 text-right"><h5 class="price">--</h5></div>
                </div>

    <?php       break;
            case 'tennis': ?>

                <!-- tennis -->
                <div id="<?= $abteilung ?>PanelHeader" class="form-row col-12 bg-info font-weight-bold p-2 mb-1 mt-3 text-uppercase">Abteilung <?= $abteilungTitel ?></div>
                <div id="<?= $abteilung ?>Panel" class="form-row col-12">
                    <div class="col-md-4">
                        <label for="tennisTarif">Tarif</label>
                        <select id="tennisTarif" name="tennisTarif" class="form-control">
                            <option value="" selected>Bitte wählen...</option>
                            <?php foreach ($config['Tennis']['Beitrag'] as $key => $val) { ?>
                                <option value="<?= $key; ?>" <?= ($data['tennisTarif'] == $key ? 'selected': '') ?>><?= $key; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3 custom-file" id="studentNachweisPanel" style="display: none">
                        <label class="custom-file-label" for="studentNachweis">Nachweis für aktives Studium (Ausweis, o.ä.)</label>
                        <input type="file" class="custom-file-input" id="studentNachweis" required>
                        <div class="invalid-feedback">Für den vergünstigten Studententarif benötigen wir einen gültigen Nachweis!</div>
                    </div>
                    <div class="col-md-12 mb-2"></div>
                    <div class="col-md-10"><h5>Jahresbeitrag</h5></div>
                    <div id="<?= $abteilung ?>Beitrag" class="col-md-2 text-right"><h5 class="price">--</h5></div>
                </div>
    <?php       break;
            default: ?>

                <!-- sonstige abteilungen -->
                <div id="<?= $abteilung ?>PanelHeader" class="col-md-12 bg-info font-weight-bold p-2 mb-1 mt-3 text-uppercase">Abteilung <?= $abteilungTitel ?></div>
                <div id="<?= $abteilung ?>Panel" class="form-row col-12">
                    <?php if($config[$abteilungTitel]['Aufnahmegebühr']) { ?>
                        <div class="col-md-10"><h6>Aufnahmegebühr (einmalig)</h6></div>
                        <div id="<?= $abteilung ?>BeitragAufnahme" class="col-md-2 text-right"><h6 class="price"><?= $config[$abteilungTitel]['Aufnahmegebühr']?></h6></div>
                    <?php } ?>
                    <div class="col-md-10 mb-2"><h5>Jahresbeitrag</h5></div>
                    <div id="<?= $abteilung ?>Beitrag" class="col-md-2 mb-2 text-right"><h5 class="price">--</h5></div>
                </div>
    <?php       break;
        }
    }
    ?>

    <input type="hidden" id="token" name="token">
</form>

<div class="row p-3">
    <button onclick="submitForm();" class="btn btn-primary mt-3">weiter zur Bankverbindung</button>
</div>