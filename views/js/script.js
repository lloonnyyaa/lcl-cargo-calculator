jQuery(document).ready(function ($) {
    $(document).on('change', 'select#country', function () {
        var country = $(this).val();
        var port_input = $('select#port');
        $.ajax({
            url: 'https://www.calculation-lcl.top/calc',
            data: {
                country: country
            },
            type: "POST",
            beforeSend: function(){
                port_input.html('');
            }
        }).done(function (answer) {
            $.each($.parseJSON(answer), function(k, v){
                port_input.append($("<option></option>")
                    .attr("value",v)
                    .text(v)); 
            });
            port_input.selectric();
            
        }).fail(function () {
            console.log('fail');
        });
    });
});

jQuery(document).on('click', 'div.block-inputs-green', function () {
    jQuery('input[data-count="1"]').focus();
});

jQuery('input.code').on('keyup', function () {
    var _this = jQuery(this);
    var form = jQuery('form#client-code');
    if (_this.val()) {
        var count = _this.data('count');

        if (count != 5) {
            var next = count + 1;
            jQuery('input[data-count="' + next + '"]').removeAttr('disabled');
            jQuery('input[data-count="' + next + '"]').focus();
        } else if (count == 5) {
            if (_this.closest('form').valid()) {
                _this.closest('form').submit();
            } else {
                alert('form not valid');
            }
        }
    }
});

jQuery(function () {
    jQuery('select').selectric();
});