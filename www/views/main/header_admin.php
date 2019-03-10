<div class="row bg-light p-3 border-bottom-green">
    <div id="logo" class="col-md-2">
        <a href="http://www.tsvmoosach.de/"><img src="/img/logo.png" width="140"></a>
    </div>
    <div id="title" class="col-md-8 bg-light">
        <p class="text-center"><?= $title ?></p>
    </div>
    <div class="col-md-2">
        <?php if (isset($user['login'])) { ?>
        <strong><?= $user['firstname']; ?> <?= $user['lastname']; ?></strong><br>
        <?php foreach($user['roles'] as $key => $val) {
            echo $val . ' ';
        } ?>
        <br>
        <button onclick="location.href = '/admin/logout/'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Abmelden"><ion-icon name="log-out"></ion-icon> Abmelden</button>
        <?php } ?>
    </div>
</div>

<div id="breadcrumb" class="row bg-light">
    <div class="col-md-4">
        <?php $i = 0; ?>
        <?php foreach ($breadcrumb as $key => $val) { ?>
            <?php $i++; ?>
            <a href="<?= $val ?>"><?= $key ?></a>
            <?php if(count($breadcrumb) > $i ) { ?>
                <i class="fa fa-angle-right">&gt;</i>
            <?php }?>
        <?php } ?>
    </div>
</div>