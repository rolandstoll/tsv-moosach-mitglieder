$(function() {

    var gesamtBeitrag = 0;
    var fussballBeitragPassantrag = 0;
    var fussballBeitragAufnahme = 0;
    var fussballBeitragLfdJahr = 0;

    // get config
    var cfg = {};
    $.ajax({
        url: '/config.json',
        dataType: "json",
        cache: false,
        success: function(data) {

            if(age < 6) {
                cfg = data['Kind'];
            } else if (age < 18) {
                cfg = data['Jugend'];
            } else {
                cfg = data['Erwachsener'];
            }

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
                    $('#passnummer').val('');
                    $('#letzterVerein').prop('required', false);
                    $('#letzterVerein').val('');
                    $('#zustimmung_fussball').prop('checked', false);

                    $('#fussballBeitragPassantrag').children().html('--');
                    $('#fussballBeitragLfdJahr').children().html('--');
                    fussballBeitragPassantrag = 0;
                    fussballBeitragAufnahme = 0;
                    fussballBeitragLfdJahr = 0;
                    setFussballGesamt();
                }
            }).change();

            $('#passantrag').on("change", function() {
                if (this.value == 'Erstausstellung') {
                    fussballBeitragPassantrag = cfg['Fußball']['Passantrag']['Erstausstellung'];
                    $('#passnummerPanel').hide();
                    $('#letzterVereinPanel').hide();
                    $('#passnummer').prop('required', false);
                    $('#letzterVerein').prop('required', false);
                    $('#passnummer').val('');
                    $('#letzterVerein').val('');
                    $('#fussballBeitragPassantrag').children().html(cfg['Fußball']['Passantrag']['Erstausstellung']);
                } else if (this.value == 'Vereinswechsel') {
                    fussballBeitragPassantrag = cfg['Fußball']['Passantrag']['Vereinswechsel'];
                    $('#passnummerPanel').show();
                    $('#letzterVereinPanel').show();
                    $('#passnummer').prop('required', true);
                    $('#letzterVerein').prop('required', true);
                    $('#fussballBeitragPassantrag').children().html(cfg['Fußball']['Passantrag']['Vereinswechsel']);
                } else {
                    $('#fussballBeitragPassantrag').children().html('--');
                    $('#passnummerPanel').hide();
                    $('#letzterVereinPanel').hide();
                    $('#passnummer').prop('required', false);
                    $('#letzterVerein').prop('required', false);

                }
                setFussballGesamt();
            }).change();

            $('#eintrittsdatum').on("change", function() {
                if (this.value === '') {
                    fussballBeitragLfdJahr = 0;
                    $('#fussballBeitragLfdJahr').children().html('--');
                } else {
                    fussballBeitragLfdJahr = cfg['Fußball']['Beitrag'][this.value];
                    $('#fussballBeitragLfdJahr').children().html(cfg['Fußball']['Beitrag'][this.value]);
                }
                setFussballGesamt();
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
                    if (this.value == 'Student') {
                        $('#studentNachweisPanel').show();
                        $('#studentNachweis').prop('required', true);
                    } else {
                        $('#studentNachweisPanel').hide();
                        $('#studentNachweis').prop('required', false);
                    }
                    $('#tennisBeitrag').children().html(cfg['Tennis']['Beitrag'][this.value]);
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

    function setFussballGesamt() {
        gesamtBeitragFussball = fussballBeitragPassantrag + fussballBeitragAufnahme + fussballBeitragLfdJahr;
        $('#fussballBeitragGesamt').children().html(gesamtBeitragFussball);
    }

});

function calculateAge(birthday) { // birthday = date object
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

function isValidDate(d) {
    return d instanceof Date && !isNaN(d);
}

function submitForm() {
    $('#myForm')[0].classList.add('was-validated');

    if ($('#myForm')[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        grecaptcha.execute('6Lcrd5MUAAAAAFMStxqwSSVCveABb0rWqHfFdofe', {action: 'antrag'}).then(function(token) {
            $('#token').val(token);
            $('#myForm').submit();
        });
    }

}