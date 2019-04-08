$( document ).ready(function() {
    //Order form
    var reloadSelect = () => {
        let rateSelect = $('#rate'),
            daySelect = $('#day'),
            days = rateSelect.find('option:selected').data('days')

        daySelect.find('option').each(function () {
            $(this).prop('disabled', !days.includes(parseInt($(this).val())));
        })

        daySelect.find('option').removeAttr("selected").filter( "option:not(:disabled)" ).first().prop('selected',true)
    }

    reloadSelect()

    $('#rate').change(function (){
        reloadSelect()
    })

});