$(function(){
    $('.address').select2();

    $('.address').on('change', function() {
        let $url = $(".url-location").attr('data-url');
        let $this = $(this);
        let $type = $this.attr('data-type');
        let $id   = $this.val();

        if ($url && $type && $id)
        {
            $.ajax({
                url : $url,
                type : 'post',
                dataType: 'json',
                async: true,
                data: { id : $id,type : $type}
            }).done(function (responsive) {

                if (responsive.locations)
                {
                    let $text = 'Chọn Quận / Huyện'
                    if ($type == 'street')
                    {
                        $text = 'Chọn Xã / Phường'
                    }

                    let html = "<option> "+ $text +" </option>";
                    $.each(responsive.locations, function(index,value){
                        html += "<option value='"+value.id+"'>"+value.loc_name+"</option>"
                    });

                    $('.'+$type).html('').append(html);
                }
            });
        };
    })
})