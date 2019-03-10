<?php setlocale(LC_TIME, "de_DE.utf8"); ?>

<script>
    var age = <?= isset($data['alter']) ? $data['alter'] : 18; ?>;
</script>

<div class="row p-3 bg-dark text-white">
    <div class="col-md-12">
        <p class="lead pt-3">Herzlich Willkommen bei der Mitgliederverwaltung vom <strong>TSV Moosach-Hartmannshofen</strong>!</p>
        <p>
            Bitte melde dich hier mit deinem <strong>Login</strong> und deinem <strong>Kennwort</strong> an.<br>
            Falls du noch keinen Login besitzt oder dein Kennwort vergessen hast, wende dich bitte an den Hauptverein!
        </p>
    </div>
</div>

<div class="row pl-3 pb-0 bg-dark text-white">
    <form id="myForm" method="POST" class="row col-12 p-3 needs-validation" novalidate>
        <div class="form-row col-12">
            <div class="col-md-4 mb-2">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required value="">
                <div class="invalid-feedback">
                    Bitte deinen Login angeben!
                </div>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-4 mb-2">
                <label for="vorname">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required value="">
                <div class="invalid-feedback">
                    Bitte dein Kennwort angeben!
                </div>
            </div>
            <div class="col-md-8"></div>
        </div>

        <input type="hidden" id="token" name="token">

        <?php if($loginFailed) { ?>
        <div class="col-md-12 p-3 text-danger">
            Dein Login / Kennwport war leider nicht richtig!
        </div>
        <?php } ?>
    </form>
</div>

<div class="row pl-3 pb-4 bg-dark text-white">
    <button onclick="submitForm();" class="btn ml-3 btn-primary mt-3">Anmelden</button>
</div>