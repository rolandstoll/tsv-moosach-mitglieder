<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div class="row p-3">
    <ul class="list-group list-group-horizontal-md pl-3 col-md-12">
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag" class="text-white">Persönliche Daten</a></li>
        <li class="w-25 list-group-item bg-secondary font-weight-bold"><a href="/antrag/2" class="text-white">Auswahl Abteilungen</a></li>
        <li class="w-25 list-group-item active font-weight-bold">Bankverbindung</li>
        <li class="w-25 list-group-item bg-light text-muted">Zusammenfassung</li>
    </ul>
</div>

<div class="row p-3">
    <div class="col-sm">
        <?php foreach($data as $key => $value) { ?>
            <?= $key ?>: <?= var_dump($data) ?><br>
        <?php } ?>
    </div>
</div>

<form method="POST" class="row m-3 p-0 needs-validation" novalidate>
    <div class="col-md-12 bg-warning font-weight-bold p-2 mb-1 mt-3">ZUSTIMMUNG</div>
    <div class="form-row col-12">
        <div class="custom-control custom-switch">
            <input class="custom-control-input" type="checkbox" value="" id="zustimmung" required>
            <label class="custom-control-label" for="agreement">
                Die Vereinssatzungen und die Statuten des BLSV erkenne ich an. Beitragszahlung jährlich durch SEPA Basis Lastschrift.
            </label>
            <div class="invalid-feedback">
                Die Vereinssatzungen und die Statuten des BLSV müssen anerkannt werden.
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