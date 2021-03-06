<div class="row bg-light p-3">
    <div id="logo" class="col-md-2">
        <a href="http://www.tsvmoosach.de/"><img src="/img/logo.png" width="140"></a>
    </div>
    <div id="advertising" class="col-md-10 text-right">
        <br>
        <img src="http://www.tsvmoosach.de/wp-content/uploads/2014/04/home_380x90.jpg" width="380">
    </div>
</div>

<div id="nav1" class="row bg-green justify-content-center p-1">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-light" href="#">DER VEREIN +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">FUSSBALL +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">TENNIS +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">FITNESS +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">GYMNASTIK +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">SKI +</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#">EISSTOCK +</a>
        </li>
    </ul>
</div>

<div id="nav2" class="row bg-medium text-right p-2">
    <div class="col-md-12 text-right">
        <a href="http://www.tsvmoosach.de/unsere-partner/">Unsere Partner</a>
        <a href="http://www.tsvmoosach.de/kontakt/">Kontakt</a>
        <a href="http://www.tsvmoosach.de/der-verein/mitgliedschaft/">Mitgliedschaft</a>
        <a href="http://www.tsvmoosach.de/anfahrt/">Anfahrt</a>
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

<div id="title" class="row bg-light border-bottom-green">
    <p class="col-md-12 text-center"><?= $title ?></p>
</div>
