$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('.latin').each(function () {
        $(this).keyup(function () {
            if ($(this).val().match(/[^a-zA-Z0-9]/g)) {
                this.value = $(this).val().replace(/[^a-zA-Z0-9]/g, '');
            }
        })
    });

    $('.tel_number').mask("+7(999)999-99-99");

    $('.read_item').each(function () {
        $(this).click(function () {
            $(this).parents('.list_item').addClass('writable');
            $(this).parents('.list_item').find('.input_item').each(function () {
                $(this).removeAttr('readonly').removeAttr('disabled').css('border', '');
            });
        });
    });

    function success_update(parent){
        parent.addClass('success').removeClass('writable').removeClass('danger');
        setTimeout(function () {
            parent.removeClass('success');
        }, 500);
        parent.find('.input_item').each(function () {
            $(this).attr('readonly', 'true').css('border', 'none');
            if ($(this).hasClass('list')) {
                $(this).attr('disabled', 'disabled');
            }
        });
        $('.error').each(function () {
            $(this).css('color', 'black');
        })
    }

    function error_update(data, parent, user){
        $('.error').each(function () {
            $(this).css('color', 'black');
        });
        if (data.responseJSON.errors) {
            $.each(data.responseJSON.errors, function (index) {
                if (user === true && (index == 'first_name' || index == 'last_name')) {
                    $('.error_name').css('color', 'red');
                }
                else {
                    $('.error_' + index).css('color', 'red');
                }
            });
        }
        parent.addClass('danger');
    }

    $('.update_user').each(function () {
        $(this).click(function () {
            var parent = $(this).parents('.list_item');
            if (parent.hasClass('writable')) {
                var full_name = parent.find('.full_name').val().split(' ');
                $.ajax({
                    url: '/admin/user/update/' + parent.attr('id'),
                    type: 'PUT',
                    data: {
                        last_name: full_name[0],
                        first_name: full_name[1],
                        role: parent.find('.role').val(),
                        city: parent.find('.city').val(),
                        address: parent.find('.address').val(),
                        tel: parent.find('.tel_number').val(),
                        login: parent.find('.login').val(),
                        password: parent.find('.password').val()
                    },
                    success: function () {
                        success_update(parent);
                    },
                    error: function (data) {
                        error_update(data, parent, true)
                    }
                });
            }
        });
    });

    $('.update_order').each(function(){
       $(this).click(function(){
           var parent = $(this).parents('.list_item');
           if (parent.hasClass('writable')) {
               $.ajax({
                   url: '/admin/order/update/' + parent.attr('id'),
                   type: 'PUT',
                   data: {
                       service_id: parent.find('.service_id').val(),
                       status: parent.find('.status').val(),
                       payment: parent.find('.payment').val(),
                       payment_status: parent.find('.payment_status').val()

                   },
                   success: function () {
                       success_update(parent);
                   },
                   error: function (data) {
                       error_update(data, parent, false)
                   }
               });
           }
       })
    });

    $('.info_item').each(function () {
       $(this).click(function () {
           var url = $(this).attr('data-type') == 'user' ? '/admin/user/info' : '/admin/order/info';
            $.ajax({
                type: 'GET',
                url: url,
                data: {id: $(this).attr('id')},
                success: function (data) {
                    $('#popup' + data.id).html(data.content);
                }
            });
        });
    });

    $('.delete_item').each(function () {
        $(this).click(function () {
            var url = $(this).attr('data-type') == 'user' ? '/admin/user/delete' : '/admin/order/delete';
            var parent = $(this).parents('.list_item');
            if (confirm('Вы точно хотите удалить?')) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {id: $(this).attr('data-id')},
                    success: function () {
                        parent.hide(600);
                    }
                });
            }
        });
    });

});
