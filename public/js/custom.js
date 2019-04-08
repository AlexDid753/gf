$( document ).ready(function() {
    //Order form
    let days = $('#rate').find('option:selected').data('days')

    $('#day').find('option').each(function () {
        $(this).prop('disabled', !days.includes(parseInt($(this).val())));
    })

});