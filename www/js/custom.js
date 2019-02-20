$(function() {
    $('#hauptverein').on("change",function() {
        $('#hauptvereinAlert').toggle(!this.checked);
        $('#hauptvereinPanel').toggle(this.checked);
    }).change();

    $('#fussball').on("change",function() {
        $('#fussballPanelHeader').toggle(this.checked);
        $('#fussballPanel').toggle(this.checked);
    }).change();

    $('#tennis').on("change",function() {
        $('#tennisPanelHeader').toggle(this.checked);
        $('#tennisPanel').toggle(this.checked);
    }).change();


    // set age on birthdate change
    $('#geburtsdatum').on("change", function() {
        var d = new Date(this.value);
        if (isValidDate(d)) {
            var age = calculateAge(d);
            $('#alter').val(age);

            // hauptverein
            if (age < 6 ) {
                $('#hauptvereinBeitrag').html('<h4>' + hauptvereinBeitragKind+ '.- EUR</h4>');
            } else if (age < 18 ) {
                $('#hauptvereinBeitrag').html('<h4>' + hauptvereinBeitragJugend + '.- EUR</h4>');
            } else {
                $('#hauptvereinBeitrag').html('<h4>' + hauptvereinBeitragErwachsener + '.- EUR</h4>');
            }

            // fussball
            if (age < 18 ) {
                $('#fussballPanel').toggle(this.checked);
            } else {
                $('#hauptvereinBeitrag').html('<h4>' + hauptvereinBeitragErwachsener + '.- EUR</h4>');
            }
        }
    }).change();
})

function calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

function isValidDate(d) {
    return d instanceof Date && !isNaN(d);
}