<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<div class="row">
    <table class="table table-striped table-hover table-dark m-0">
        <thead>
        <tr class="bg-black text-white">
            <th scope="col">#</th>
            <th scope="col">Nachname</th>
            <th scope="col">Vorname</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Abteilungen</th>
            <th scope="col">Datum</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($antraege as $antrag) {
            $data = json_decode($antrag['data'], true);
        ?>
        <tr>
            <th scope="row"><?= $antrag['id']; ?></th>
            <td><?= $antrag['nachname']; ?></td>
            <td><?= $antrag['vorname']; ?></td>
            <td><?= $antrag['email']; ?></td>
            <td>
                <?php
                if (isset($data['abteilung'])) {
                    foreach ($data['abteilung'] as $key => $val) {
                        echo '- ' . $abteilungen[$key] . ' ';
                        switch ($abteilungStatus[$antrag['id']][$key]) {
                            case 'declined':
                                echo '<ion-icon name="close-circle" style="color:red;"></ion-icon><br>';
                                break;
                            case 'accepted':
                                echo '<ion-icon name="checkmark-circle" style="color:green;"></ion-icon>';
                                break;
                            default:
                                echo '<ion-icon name="help-circle" style="color:grey;"></ion-icon>';
                        }
                        echo '<br>';
                    }
                }
                ?>
            </td>
            <td><?= date('d.m.Y H:i', strtotime($antrag['created'])); ?> Uhr</td>
            <td>
                <button onclick="location.href = '/admin/detail/<?= $antrag["id"]; ?>'; " class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Bearbeiten">
                    <ion-icon name="create"></ion-icon>
                </button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
