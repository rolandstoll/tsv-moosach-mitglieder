<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<div class="row">
    <table class="table table-striped table-hover table-dark m-0">
        <thead>
        <tr class="bg-dark text-white">
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
        foreach($data as $item) {
            $json = json_decode($item['data']);
        ?>
        <tr>
            <th scope="row"><?= $item['id']; ?></th>
            <td><?= $item['nachname']; ?></td>
            <td><?= $item['vorname']; ?></td>
            <td><?= $item['email']; ?></td>
            <td>
                <?php
                if (isset($json->abteilung)) {
                    foreach ($json->abteilung as $key => $val) {
                        echo '- ' . $abteilungen[$key] . ' ';
                        switch ($val) {
                            case 'pending':
                                echo '<ion-icon name="help-circle" style="color:grey;"></ion-icon>';
                                break;
                            case 'accepted':
                                echo '<ion-icon name="checkmark-circle" style="color:green;"></ion-icon>';
                                break;
                            default:
                                echo '<ion-icon name="close-circle" style="color:red;"></ion-icon><br>';
                        }
                        echo '<br>';
                    }
                }
                ?>
            </td>
            <td><?= date('d.m.Y H:i', strtotime($item['created'])); ?> Uhr</td>
            <td>
                <button onclick="location.href = '/admin/detail/<?= $item["id"]; ?>'; " class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Bearbeiten">
                    <ion-icon name="create"></ion-icon>
                </button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
