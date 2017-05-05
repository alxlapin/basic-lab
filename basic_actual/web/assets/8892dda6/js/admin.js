$(document).ready(function () {

    $('a[href="' + window.location.pathname + window.location.search + '"]').parent().addClass('active');

    $(".single_2").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none',

        helpers : {
            title : {
                type : 'inside'
            }
        }
    });

    $('#user-user_phone').mask('(999) 999-9999');
    $('#user-spin_id').mask('9999-9999');
    $('#user-orcid').mask('9999-9999-9999-9999');
    $('#user-researcher_id').mask('a-9999-9999');
    $('#user-scopus_id').mask('99999999999');

    $('#add-input-btn').click(function() {
        $('<input class="post-input-file" type="file" name="UploadForm[files][]"' +
            'accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">').appendTo(".field-uploadform-files");
    });

    $('#top_user-link').click(function () {
        $('#top_user-opts').toggleClass('active');
    });

    $('.delete-file').click(function () {
        var $fileId = $(this).data('id');
        if ($(this).hasClass('file-selected')) {
            $(this).removeClass('file-selected');
            $('#file-' + $fileId).remove();
        } else {
            $(this).addClass('file-selected');
            $("<input type='hidden' id='file-" + $fileId + "' " + "name='filesToBeDeleted[]' value='" + $fileId + "'>").appendTo($('#files-to-delete'));
        }
    });

    $('.delete-file-input').click(function () {
        $(this).parent().remove();
    });

    $('#added-files').on('click', '.added-item_descsave', function () {
        var $parent = $(this).parent();
        var $relatedInput = $parent.find('input');
        var $imgDesc = $relatedInput.val();
        $.post($(this).data('urlupdate'),
            {
                imgdesc : $imgDesc
            },
            function(response) {
                if (response == 'Ok') {
                    var $checkSave = $parent.find('.checksave');
                    $checkSave.css('opacity', 1);
                    setTimeout(function () { $checkSave.css('opacity', 0); }, 1000);
                }
            }
        );
    });

    $('#added-files').on('click', '.delete-added-img', function () {
        var $imgId = $(this).data('imgid');
        var $addedItem = $(this).closest('.added-item');
        $.post($(this).data('urldelete'),
            {
                id : $imgId
            },
            function(response) {
                if (response == 'Ok') {
                    $addedItem.addClass('prehide');
                    setTimeout(function () { $addedItem.remove(); }, 500);
                }
            }
        );
    });

    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#added-files').prepend(
                    $("<div class='added-item'><div class='added-item_imgblock'><a class='added-item_img single_2' href='" +
                        file.url + "'>" +
                        "<img src='" + file.thumbnailUrl + "'></a></div>" +
                        "<div class='added-item_info'>" +
                        "<label>Описание</label>" +
                        "<div class='input-desc_container'><input type='text' class='form-control added-item_desc' name='image[" +
                        file.id + "]' maxlength='255'><span class='checksave'>Сохранено</span><div data-urlupdate='" +
                        file.updateUrl + "' data-title='Сохранить' class='added-item_descsave'>Сохранить</div></div>" +
                        "<span data-imgid='" + file.id + "' data-urldelete='" + file.deleteUrl + "' class='delete-added-img'>Удалить</span></div></div>")
                );
            });
        },
        progressall: function (e, data) {
            var $progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress-bar').css(
                'width',
                $progress + '%'
            );
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