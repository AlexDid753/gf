$(document).ready(function () {
    //Order form
    var reloadSelect = () => {
        let rateSelect = $('#rate'),
            daySelect = $('#day'),
            days = rateSelect.find('option:selected').data('days')

        daySelect.find('option').each(function () {
            $(this).prop('disabled', !days.includes(parseInt($(this).val())));
        })

        daySelect.find('option').removeAttr("selected").filter("option:not(:disabled)").first().prop('selected', true)
    }

    var clearForm = () => {
        $('form').find(".form-group input").val("");
    }

    reloadSelect()

    $('#rate').change(function () {
        reloadSelect()
    })

    $("input[name='phone']").mask("+7 (999) 999-9999");

    $('form').submit(function (e) {
        e.preventDefault();
        let data = $('form').serializeArray();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: data,
            dataType: 'json'
        }).done(function (data) {
            clearForm()
            alert(data.message)
        }).fail(function (data) {
            alert(data.responseText)
        });
    });

});