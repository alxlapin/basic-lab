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

    $('#add-input-btn').click(function() {
        $('<input class="post-input-file" type="file" name="UploadForm[files][]"' +
            'accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">').appendTo(".field-uploadform-files");
    });

    $('#top_user-link').click(function () {
        $('#top_user-opts').toggleClass('active');
    });

    //$("<div class='delete-file-input'></div>").insertAfter($('.uploadform-file'));

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
        var $imgId = $(this).data('imgid');
        var $parent = $(this).parent();
        var $relatedInput = $parent.find("input[name='image[" + $imgId + "]']");
        var $imgDesc = $relatedInput.val();
        $.post("update?id=" + $imgId,
            {
                imgdesc : $imgDesc,
                _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
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
        $.post("image-delete",
            {
                id : $imgId,
                _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
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
                        file.id + "]' maxlength='255'><span class='checksave'>Сохранено</span><div data-imgid='" +
                        file.id + "' data-title='Сохранить' class='added-item_descsave'>Сохранить</div></div>" +
                        "<span data-imgid='" + file.id + "' class='delete-added-img'>Удалить</span></div></div>")
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

    $('#delete-selected-rows').click(function() {
        var achecked = [];
        var checks = document.getElementsByName("selection[]");
        for(var i=0;i<checks.length;i++) {
            if (checks[i].checked) { //если флаг был выделен заносим его в конец массива
                achecked.push($(checks[i]).val());
            }
        }
        console.log(achecked);
    });
});