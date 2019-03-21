<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div class="row">
    <div class="col-md-12 bg-dark pb-3 text-white">
        <p class="lead pt-3">Persönliche Daten:</p>
        <div class="row">
            <div class="col-md-3 font-weight-bold">Nachname, Vorname</div>
            <div class="col-md-3"><?= $data['nachname']; ?>, <?= $data['vorname']; ?></div>
            <div class="col-md-3 font-weight-bold">Telefon</div>
            <div class="col-md-3"><?= $data['telefon']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsdatum (Alter)</div>
            <div class="col-md-3"><?= date('d.m.Y', strtotime($data['geburtsdatum'])); ?> (<?= $data['alter']; ?>
                Jahre)
            </div>
            <div class="col-md-3 font-weight-bold">Handy</div>
            <div class="col-md-3"><?= $data['handy']; ?></div>
            <div class="col-md-3 font-weight-bold">Geburtsort</div>
            <div class="col-md-3"><?= $data['geburtsort']; ?></div>
            <div class="col-md-3 font-weight-bold">E-Mail</div>
            <div class="col-md-3"><?= $data['email']; ?></div>
            <div class="col-md-3 font-weight-bold">Straße / Hausnummer</div>
            <div class="col-md-9"><?= $data['strasse']; ?> <?= $data['hausnr']; ?></div>
            <div class="col-md-3 font-weight-bold">PLZ / Stadt</div>
            <div class="col-md-9"><?= $data['plz']; ?> <?= $data['stadt']; ?></div>
        </div>

        <p class="lead">Ausgewählte Abteilungen:</p>
        <div class="row">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Abteilungs</th>
                    <th scope="col">zusätzliche Infos</th>
                    <th scope="col" class="text-right">Beitrag</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['abteilung'] as $key => $val) { ?>
                <tr>
                    <th scope="row"><?= $abteilungen[$key]; ?></th>
                    <td style="font-size: 0.8rem"><?= $extras[$key]; ?></td>
                    <td class="text-right"><?= $beitrag[$key]; ?>.- EUR</td>
                    <?php
                    switch ($abteilungStatus[$key]['status']) {
                        case 'declined':
                            echo '<td class="text-right">';
                            echo '<span class="badge badge-danger" data-toggle="tooltip" data-placement="left" data-html="true" 
                                   title="durch <strong>' . $abteilungStatus[$key]['username'] . '</strong><br>am <em>' . $abteilungStatus[$key]['date'] . ' Uhr</em><br><br><strong>Gründe:</strong><br>und hier sind dann die Gründe für die Ablehnung - natürlich nur optional...">
                                   Abgelehnt
                                  </span>';
                            echo '</td>';
                            break;
                        case 'accepted':
                            echo '<td class="text-right">';
                            echo '<span class="badge badge-success" data-toggle="tooltip" data-placement="left" data-html="true" 
                                   title="durch <strong>' . $abteilungStatus[$key]['username'] . '</strong><br>am <em>' . $abteilungStatus[$key]['date'] . ' Uhr</em>">
                                   Angenommen
                                  </span>';
                            echo '</td>';
                            break;
                        default:
                            echo '<td class="text-right">';
                            if (in_array($key, $roles)) {
                                echo '<button onclick="" class="btn btn-primary btn-sm mt-1 mr-1" data-toggle="tooltip" data-placement="left" title="Kommentare"><ion-icon name="chatbubbles"></ion-icon></button>';
                                echo '<button onclick="setAntragAbteilungStatus(\'' . $key . '\', \'accepted\');" class="btn btn-success btn-sm mt-1 mr-1" data-toggle="tooltip" data-placement="left" title="Annehmen"><ion-icon name="checkmark-circle"></ion-icon></button>';
                                echo '<button onclick="setAntragAbteilungStatus(\'' . $key . '\', \'declined\');" class="btn btn-danger btn-sm mt-1 mr-1" data-toggle="tooltip" data-placement="left" title="Ablehnen"><ion-icon name="close-circle"></ion-icon></button>';
                            }
                            echo '</td>';
                    }
                    ?>
                </tr>
                <?php } ?>
               <tr class="bg-black">
                    <th>GESAMT</th>
                    <th style="font-size: 0.8rem">Beitrag lfd. Jahr</th>
                    <th><?= $gesamt; ?>.- EUR</th>
                    <th></th>
                </tr>
                <tr class="text-secondary">
                    <th>GESAMT</th>
                    <th style="font-size: 0.8rem">
                        Beitrag folgende Jahre</strong><br>
                        (Änderungen zum lfd. Jahr durch Abt. Fußball/Eintrittsdatum möglich)
                    </th>
                    <th><?= $gesamtNext; ?>.- EUR</th>
                    <th></th>
                </tr>
                </tbody>
            </table>
        </div>

        <p>
            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseDetails" aria-expanded="false" aria-controls="collapseDetails">
                Details ein-/ausblenden
            </button>
        </p>
        <div class="collapse" id="collapseDetails">

            <?php if (key_exists('fussball', $data['abteilung']) || key_exists('tennis', $data['abteilung'])) { ?>
                <hr>
                <p class="lead">Weitere Angaben:</p>
                <div class="row">
                    <?php if (key_exists('fussball', $data['abteilung'])) { ?>
                        <div class="col-md-12 bg-info text-white font-weight-bold text-uppercase"><?= $abteilungen['fussball']; ?></div>
                        <div class="col-md-3 font-weight-bold">Eintrittsdatum/Tarif</div>
                        <div class="col-md-3">ab
                            1. <?= strftime('%B', mktime(0, 0, 0, $data['eintrittsdatum'], 10)); ?></div>
                        <div class="col-md-3 font-weight-bold">Passantrag</div>
                        <div class="col-md-3"><?= $data['passantrag']; ?></div>
                        <?php if ($data['passnummer']) { ?>
                            <div class="col-md-3 font-weight-bold">letzter Verein</div>
                            <div class="col-md-3"><?= $data['letzterVerein']; ?></div>
                            <div class="col-md-3 font-weight-bold">Passnummer</div>
                            <div class="col-md-3"><?= $data['passnummer']; ?></div>
                        <?php } ?>
                    <?php } ?>

                    <?php if (key_exists('tennis', $data['abteilung'])) { ?>
                        <div class="col-md-12 mt-3 bg-info text-white font-weight-bold text-uppercase"><?= $abteilungen['tennis']; ?></div>
                        <div class="col-md-3 font-weight-bold">Tarif</div>
                        <div class="col-md-3"><?= $data['tennisTarif']; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>

            <hr>
            <p class="lead">Gläubiger-ID / Mandats-Referenznummer:</p>
            <div class="row">
                <div class="col-md-6 font-weight-bold">Unsere Gläubiger ID im SEPA Lastschriftverfahren:</div>
                <div class="col-md-6">DE04 ZZZ0 0000 4535 66</div>
                <div class="col-md-6 font-weight-bold">Ihre Mandats-Referenznummer:</div>
                <div class="col-md-6"><?= $data['mandats_referenznummer']; ?></div>
            </div>

            <hr>
            <p class="lead">Bankverbindung:</p>
            <div class="row">
                <div class="col-md-6 font-weight-bold">Kontoinhaber Nachname, Vorname:</div>
                <div class="col-md-6"><?= $data['konto_nachname']; ?>, <?= $data['konto_vorname']; ?></div>
                <div class="col-md-6 font-weight-bold">Kreditinstitut:</div>
                <div class="col-md-6"><?= $data['konto_kreditinstitut']; ?></div>
                <div class="col-md-6 font-weight-bold">IBAN:</div>
                <div class="col-md-6"><?= $data['konto_iban']; ?></div>
                <div class="col-md-6 font-weight-bold">BIC:</div>
                <div class="col-md-6"><?= $data['konto_bic']; ?></div>
            </div>

            <hr>
            <p class="lead">Zustimmungen:</p>
            <div class="row">
                <div class="col-md-9 font-weight-bold">Datenschutz / Persönlichkeitsrechte anerkannt</div>
                <div class="col-md-3"><?= (isset($_SESSION['datenschutz'])) ? 'ja' : 'nein'; ?></div>
                <div class="col-md-9 font-weight-bold">Fußball: Adressdaten Nutzungszustimmung für Marketingzwecke</div>
                <div class="col-md-3"><?= (isset($_SESSION['zustimmung_fussball'])) ? 'ja' : 'nein'; ?></div>
                <div class="col-md-9 font-weight-bold">Zustimmung Vereinssatzungen, Statuten des BLSV und
                    Lastschrift-Einzugsermächtigung auf SEPA-Basis
                </div>
                <div class="col-md-3"><?= (isset($_SESSION['zustimmung'])) ? 'ja' : 'nein'; ?></div>
            </div>
        </div>

        <button onclick="location.href = '/admin/dashboard/'" class="btn btn-primary" type="button">
            zurück
        </button>
    </div>

    <form id="myForm" method="POST" class="row m-12" novalidate>
        <input type="hidden" id="antrag" name="<?= $id; ?>">
        <input type="hidden" id="abteilung" name="abteilung">
        <input type="hidden" id="status" name="status">
        <input type="hidden" id="token" name="token">
    </form>
</div>