$(document).ready(function () {

    $(".fancybox-button").fancybox({
        prevEffect: 'none',
        nextEffect: 'none',

        helpers: {
            title: {
                type: 'inside'
            }
        }
    });

    $('#user-user_phone').mask('(999) 999-9999');
    $('#user-spin_id').mask('9999-9999');
    $('#user-orcid').mask('9999-9999-9999-9999');
    $('#user-researcher_id').mask('a-9999-9999');
    $('#user-scopus_id').mask('99999999999');

    $('#requestcourse-user_phone, #requestproject-user_phone').mask('(999) 999-9999');

    $('.show-desc').click(function () {
        $elem = $(this).parent().next('.public-item_desc');
        if ($elem.css('display') == 'none') {
            $elem.show(300);
            $(this).addClass('open');
        } else {
            $elem.hide(300);
            $(this).removeClass('open');
        }
    });

    $('#fileupload2').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $('#user_img').attr('src', '/images/users/' + data.result.files[0].name);
            $('#delete-avatar').attr('data-image', data.result.files[0].name);
            $('#delete-avatar').css('display', 'inline-block');
            $('input[name="avatar"]').val(data.result.files[0].name);
        }
    });

    $('#delete-avatar').click(function () {
        var imageName = $(this).data('image');
        var url = $(this).data('url');
        var uid = $(this).data('id');
        $.post(url,
            {
                name: imageName,
                uid: uid
            },
            function onAjaxSuccess(response) {
                if (response == 'Ok') {
                    $('#user_img').attr('src', '/images/users/user-default.png' );
                    $('#delete-avatar').attr('data-image', '');
                    $('#delete-avatar').css('display', 'none');
                    $('input[name="avatar"]').val('');
                } else {
                    console.log(response);
                }
            }
        )
    });

    $('input[type="checkbox"]').click(function() {
        setTimeout(function () {
            var checks = document.getElementsByName('selection[]');
            var counter = 0;
            $(checks).each(function(indx) {
                if ($(this).prop('checked')) {
                    counter++;
                }
            });
            $('.multi-delete span').text(counter);
        }, 100);
    });

    $('.multi-delete').click(function(e) {
        e.preventDefault();
        var checks = $('input[name="selection[]"]:checked');
        var mass = [];
        $(checks).each(function(indx) {
            mass.push(parseInt($(this).val()));
        });
        $.post($(this).data('url'),
            {
                mass : mass
            },
            function onAjaxSuccess(response) {
                if (response == 'Files deleted') {
                    location.reload(true);
                } else {
                    console.log('Нечего удалять');
                }
            }
        );
    });

});