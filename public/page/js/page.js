$(function () {

    $(document).on("click",".btn-plus-customer",function(event) {
        var url = $(this).attr('url');
        var flight_id = $(this).attr('flight_id');
        var type = $(this).attr('type_customer');
        var numAdult = $('.item-adult').length

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                flight_id : flight_id,
                type : type,
                numAdult : numAdult,
            }
        }).done(function (result) {
            if (result.type == 'adult') {
                $('.list-adult').append(result.html)
            } else {
                $('.list-baby').append(result.html)
            }

            $('.table-price').html(result.html_price)
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            console.log(thrownError)
        });
    })


    $(document).on("click",".btn-minus-customer",function() {

        var url = $(this).attr('url');
        var __that = $(this);
        var flight_id = $(this).attr('flight_id');
        var type = $(this).attr('type');
        var baby_gender = $(this).parent().parent().find('.baby_gender').val();

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                flight_id : flight_id,
                type : type,
                baby_gender: baby_gender
            }
        }).done(function (result) {

            __that.parent().parent().remove();
            $('.table-price').html(result.html_price)

        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            console.log(thrownError)
        });
    });

    $(document).on("change",".transports",function()
    {
        var url = $(this).attr('url');
        var flight_id = $(this).attr('flight_id');
        var transport_key = $(this).attr('transport_key');
        var transport_id = $(this).val();

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                flight_id : flight_id,
                transport_id: transport_id,
                transport_key: transport_key,
            }
        }).done(function (result) {
            $('.table-price').html(result.html_price)
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            console.log(thrownError)
        });

    });

    $(document).on("change",".baby_gender",function() {

        var url = $(this).attr('url');
        var flight_id = $(this).attr('flight_id');
        var baby_gender = $(this).val();

        var element = $(this).find('option:selected');
        var key_gender = element.attr("key_gender");

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                flight_id : flight_id,
                baby_gender: baby_gender,
                key_gender: key_gender,
            }
        }).done(function (result) {
            $('.table-price').html(result.html_price)
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            console.log(thrownError)
        });

    });
})