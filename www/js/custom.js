$(function() {
    $('#hauptverein').on("change",function() {
        $('#hauptvereinAlert').toggle(!this.checked);
    }).change();

    $('#fussball').on("change",function() {
        $('#fussballPanelHeader').toggle(this.checked);
        $('#fussballPanel').toggle(this.checked);
    }).change();

    $('#tennis').on("change",function() {
        $('#tennisPanelHeader').toggle(this.checked);
        $('#tennisPanel').toggle(this.checked);
    }).change();
});