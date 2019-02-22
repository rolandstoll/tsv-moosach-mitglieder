$(function() {

    // get config
    var cfg = {};
    $.ajax({
        url: '/config.json',
        dataType: "json",
        success: function(data) {

            if(age < 6) {
                cfg = data['Kind'];
            } else if (age < 18) {
                cfg = data['Jugend'];
            } else {
                cfg = data['Erwachsener'];
            }

            console.log(cfg);

            var gesamtBeitrag = 0;
            var gesamtBeitragFussball = 0;
            var fussballBeitragPassantrag = 0;
            var fussballBeitragAufnahme = 0;
            var fussballBeitragLfdJahr = 0;

            // hauptverein
            $('#hauptverein').on("change",function() {
                $('#hauptvereinAlert').toggle(!this.checked);
                $('#hauptvereinPanel').toggle(this.checked);

                if (this.checked) {
                    $('#hauptvereinBeitrag').children().html(cfg['Hauptverein']['Beitrag']);
                } else {
                    $('#hauptvereinBeitrag').children().html('--');
                }
            }).change();

            // fussball
            $('#fussball').on("change",function() {
                $('#fussballPanelHeader').toggle(this.checked);
                $('#fussballPanel').toggle(this.checked);

                $('#fussballBeitragAufnahme').children().html(cfg['Fußball']['Aufnahmegebühr']);
                $('#fussballBeitragNaechstesJahr').children().html(cfg['Fußball']['Beitrag'][1]);

                if (this.checked) {
                    $('#passantrag').prop('required', true);
                    $('#eintrittsdatum').prop('required', true);
                    fussballBeitragAufnahme = cfg['Fußball']['Aufnahmegebühr'];
                } else {
                    $('#eintrittsdatum').prop('required', false);
                    $('#eintrittsdatum').prop('selectedIndex',0);
                    $('#passantrag').prop('required', false);
                    $('#passantrag').prop('selectedIndex',0);
                    $('#passnummerPanel').hide();
                    $('#letzterVereinPanel').hide();
                    $('#passnummer').prop('required', false);
                    $('#letzterVerein').prop('required', false);

                    $('#fussballBeitragPassantrag').children().html('--');
                    $('#fussballBeitragLfdJahr').children().html('--');
                    fussballBeitragPassantrag = 0;
                    fussballBeitragAufnahme = 0;
                    fussballBeitragLfdJahr = 0;
                    setFussballGesamt(fussballBeitragPassantrag, fussballBeitragAufnahme, fussballBeitragLfdJahr);
                }
            }).change();

            $('#passantrag').on("change", function() {
                if (this.value == 'erstausstellung') {
                    fussballBeitragPassantrag = cfg['Fußball']['PassantragErstausstellung'];
                    $('#passnummerPanel').hide();
                    $('#letzterVereinPanel').hide();
                    $('#passnummer').prop('required', false);
                    $('#letzterVerein').prop('required', false);
                    $('#fussballBeitragPassantrag').children().html(cfg['Fußball']['PassantragErstausstellung']);
                } else if (this.value == 'vereinswechsel') {
                    fussballBeitragPassantrag = cfg['Fußball']['PassantragVereinswechsel'];
                    $('#passnummerPanel').show();
                    $('#letzterVereinPanel').show();
                    $('#passnummer').prop('required', true);
                    $('#letzterVerein').prop('required', true);
                    $('#fussballBeitragPassantrag').children().html(cfg['Fußball']['PassantragVereinswechsel']);
                } else {
                    $('#fussballBeitragPassantrag').children().html('--');
                    $('#passnummerPanel').hide();
                    $('#letzterVereinPanel').hide();
                    $('#passnummer').prop('required', false);
                    $('#letzterVerein').prop('required', false);

                }
                setFussballGesamt(fussballBeitragPassantrag, fussballBeitragAufnahme, fussballBeitragLfdJahr);
            }).change();

            $('#eintrittsdatum').on("change", function() {
                if (this.value === '') {
                    fussballBeitragLfdJahr = 0;
                    $('#fussballBeitragLfdJahr').children().html('--');
                } else {
                    fussballBeitragLfdJahr = cfg['Fußball']['Beitrag'][this.value];
                    $('#fussballBeitragLfdJahr').children().html(cfg['Fußball']['Beitrag'][this.value]);
                }
                setFussballGesamt(fussballBeitragPassantrag, fussballBeitragAufnahme, fussballBeitragLfdJahr);
            }).change();

            // tennis
            $('#tennis').on("change",function() {
                $('#tennisPanelHeader').toggle(this.checked);
                $('#tennisPanel').toggle(this.checked);

                if (this.checked) {
                    $('#tennisTarif').prop('required', true);
                } else {
                    $('#tennisTarif').prop('required', false);
                    $('#tennisTarif').prop('selectedIndex', 0);
                    $('#studentNachweisPanel').hide();
                    $('#studentNachweis').prop('required', false);

                    $('#tennisBeitrag').children().html('--');
                }
            }).change();

            $('#tennisTarif').on("change", function() {
                if (this.value === '') {
                    $('#studentNachweisPanel').hide();
                    $('#studentNachweis').prop('required', false);
                    $('#tennisBeitrag').children().html('--');
                } else {
                    var selected = $(this).find("option:selected").text();
                    if (selected == 'Student') {
                        $('#studentNachweisPanel').show();
                        $('#studentNachweis').prop('required', true);
                    }
                    $('#tennisBeitrag').children().html(this.value);
                }
            }).change();

            // ski
            $('#ski').on("change",function() {
                $('#skiPanelHeader').toggle(this.checked);
                $('#skiPanel').toggle(this.checked);

                if (this.checked) {
                    $('#skiBeitrag').children().html(cfg['Ski']['Beitrag']);
                } else {
                    $('#skiBeitrag').children().html('--');
                }
            }).change();

            // ski
            $('#eisstock').on("change",function() {
                $('#eisstockPanelHeader').toggle(this.checked);
                $('#eisstockPanel').toggle(this.checked);

                if (this.checked) {
                    $('#eisstockBeitrag').children().html(cfg['Eisstock']['Beitrag']);
                } else {
                    $('#eisstockBeitrag').children().html('--');
                }
            }).change();

            // ski
            $('#damengymnastik').on("change",function() {
                $('#damengymnastikPanelHeader').toggle(this.checked);
                $('#damengymnastikPanel').toggle(this.checked);

                if (this.checked) {
                    $('#damengymnastikBeitrag').children().html(cfg['Damengymnastik']['Beitrag']);
                } else {
                    $('#damengymnastikBeitrag').children().html('--');
                }
            }).change();

            // ski
            $('#rueckenschule').on("change",function() {
                $('#rueckenschulePanelHeader').toggle(this.checked);
                $('#rueckenschulePanel').toggle(this.checked);

                if (this.checked) {
                    $('#rueckenschuleBeitrag').children().html(cfg['Rückenschule']['Beitrag']);
                } else {
                    $('#rueckenschuleBeitrag').children().html('--');
                }
            }).change();

            // ski
            $('#tischtennis').on("change",function() {
                $('#tischtennisPanelHeader').toggle(this.checked);
                $('#tischtennisPanel').toggle(this.checked);

                if (this.checked) {
                    $('#tischtennisBeitrag').children().html(cfg['Tischtennis']['Beitrag']);
                } else {
                    $('#tischtennisBeitrag').children().html('--');
                }
            }).change();

            // ski
            $('#fitness').on("change",function() {
                $('#fitnessPanelHeader').toggle(this.checked);
                $('#fitnessPanel').toggle(this.checked);

                if (this.checked) {
                    $('#fitnessBeitrag').children().html(cfg['Fitness']['Beitrag']);
                } else {
                    $('#fitnessBeitrag').children().html('--');
                }
            }).change();
        }
    });

    // alter (auto)
    $('#geburtsdatum').on("change", function() {
        var d = new Date(this.value);
        if (isValidDate(d)) {
            var age = calculateAge(d);
            $('#alter').val(age);
        }
    });

    function setFussballGesamt(fussballBeitragPassantrag, fussballBeitragAufnahme, fussballBeitragLfdJahr) {
        gesamtBeitragFussball = fussballBeitragPassantrag + fussballBeitragAufnahme + fussballBeitragLfdJahr;
        $('#fussballBeitragGesamt').children().html(gesamtBeitragFussball);
    }

})

function calculateAge(birthday) { // birthday = date object
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

function isValidDate(d) {
    return d instanceof Date && !isNaN(d);
}