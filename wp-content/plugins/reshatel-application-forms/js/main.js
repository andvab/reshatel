jQuery(function ($) {
    $('.wpcf7-date').datetimepicker({"dateFormat": "mm/dd/yy", "timeFormat": "HH:mm", "addSliderAccess": true, "sliderAccessArgs": {"touchonly": true}, "stepMinute": 5, "minDate": "-0"}).datetimepicker('option', $.datepicker.regional['ru']).datetimepicker('option', 'minDate', "-0").datetimepicker('option', 'maxDate', "").datetimepicker('refresh');

    $('.wpcf7-date-small').datepicker({"dateFormat": "dd-mm-yy", "controlType": "slider", "addSliderAccess": true, "sliderAccessArgs": {"touchonly": true}, "stepHour": 1, "stepMinute": 1, "stepSecond": 1, "minDate": "-0"}).datepicker('option', $.datepicker.regional['ru']).datepicker('option', 'minDate', "-0").datepicker('option', 'maxDate', "").datepicker('refresh');

    var $typeSelect = $("#select_type_form");

    if ($typeSelect.length > 0) {
        $typeSelect.on('change', function () {
            changeFormType();
        });

        changeFormType();
    }


    $(".form-spoiler__link").on('click', function () {
        $(".form-spoiler").toggle('blind', {}, 200);
    });

    $("#cbx").on('click', function () {
        var isCheck = $(this).prop('checked');
        $('.wpcf7-submit').prop('disabled', !isCheck).css('opacity', isCheck ? '1' : '0.3');
    });
});


jQuery(document).ready(function ($) {
    // Название куки и полей в форме.
    var email_field = 're_form_email';
    var tel_field = 're_form_tel';
    var name_field = 're_form_name';

    $(".re_form").each(function () {
        $(this).validate({
            submitHandler: function (form) {
                jQuery(".form-more-button-prev").css("display", "none");
                jQuery(".wpcf7-submit").css("display", "none");
                jQuery("#spinningSquaresG").css("display", "block");
                $('#' + $(form).attr('id') + ' .wpcf7-submit').attr("disabled", 'disabled');
                $(form).ajaxSubmit({
                    data: {re_form_is_ajax: 1},
                    dataType: 'json',
                    success: function (msg) {
                        if (msg.url !== undefined) {

                            window.location = msg.url;
                        } else if (msg.error !== undefined) {
                            $('#' + $(form).attr('id') + '-result').removeClass().addClass('send-form-false').text(msg.error);
                        }
                        $('#' + $(form).attr('id') + ' .wpcf7-submit').removeAttr("disabled", 'disabled');
                        $(form).resetForm();
                    }
                });
                return false;
            },
            invalidHandler: function () {
                $('#' + $(this).attr('id') + '-result').text('').removeClass();
            }
        });
    });

    $.validator.messages.required = "Пожалуйста, заполните обязательное поле";
    $.validator.messages.remote = "Пожалуйста, исправьте это поле";
    $.validator.messages.email = "Пожалуйста, введите корректно адрес электронной почты";
    $.validator.messages.maxlength = "Пожалуйста, вводите не более {0} букв";
    $.validator.messages.minlength = "Пожалуйста, введите не менеее {0} букв";
});



var ind = 0;

jQuery('.files_container input[type=file]').fileupload({
    url: '/wp-admin/admin-ajax.php?action=re_upload_files_form',
    maxFileSize: 50000000,
    dataType: 'json',
}).bind('fileuploaddone', function (e, data) {
    jQuery.each(data.files, function (index, file) {
        jQuery(".js-files a[data-ind=" + file.i + "] .load").remove();
        jQuery(".js-files a[data-ind=" + file.i + "] input").val(data.result.fileId);

        var iconDel = jQuery('<a href="#" class="remove glyphicon glyphicon-remove-circle"></a>').on('click', function () {
            jQuery(this).parent().remove();
            return false;
        });

        jQuery(".js-files a[data-ind=" + file.i + "]").append(iconDel);
        jQuery(".js-files a[data-ind=" + file.i + "] .progress").hide();

        jQuery(".js-files a[data-ind=" + file.i + "]").attr('href', data.result.url).attr('download', data.result.file);
    });
}).bind('fileuploadprocessalways', function (e, data) {
    jQuery.each(data.files, function (index, file) {
        if (file.error == "File is too large") {
            var iconError = jQuery('<a href="#" class="remove glyphicon glyphicon-remove-circle"></a>').on('click', function () {
                var a = jQuery(this);
                a.parent().remove();
                return false;
            });
            jQuery(".js-files a[data-ind=" + file.i + "] .load").remove();
            jQuery(".js-files a[data-ind=" + file.i + "]").append(iconError);
            jQuery(".js-files a[data-ind=" + file.i + "] .progress").hide();
            jQuery(".js-files a[data-ind=" + file.i + "]").addClass('sizeError');
        }
    });
}).bind('fileuploadfail', function (e, data) {
    jQuery.each(data.files, function (index, file) {
        var iconError = jQuery('<a href="#" class="remove glyphicon glyphicon-remove-circle"></a>').on('click', function () {
            var a = jQuery(this);
            a.parent().remove();
            return false;
        });
        jQuery(".js-files a[data-ind=" + file.i + "] .load").remove();
        jQuery(".js-files a[data-ind=" + file.i + "]").append(iconError);
        jQuery(".js-files a[data-ind=" + file.i + "] .progress").hide();
        jQuery(".js-files a[data-ind=" + file.i + "]").addClass('sizeError');
    });
}).bind('fileuploadadd', function (e, data) {
    var files_container = jQuery(".js-files");

    jQuery.each(data.files, function (index, file) {
        ind = ind + 1;
        data.files[index].i = ind;

        var input = jQuery('<input/>').attr("type", "hidden").attr("name", "files[]");
        var progress = jQuery('<div class="progress"><div class="inside"></div></div>');
        var iconLoad = jQuery('<i class="load glyphicon glyphicon-upload"></i>');
        var p = jQuery("<a/>").addClass("file").attr("data-ind", ind).html(file.name);
        p.append(progress);
        p.append(iconLoad);
        p.append(input);
        files_container.append(p);
    });
}).bind('fileuploadprogress', function (e, data) {
    var progress = parseInt(data.loaded / data.total * 100, 10);
    jQuery.each(data.files, function (index, file) {
        jQuery(".js-files a[data-ind=" + file.i + "] .progress .inside").css(
                'width',
                progress + '%'
                );
    });
}).bind('fileuploadsubmit', function (e, data) {
    data.formData = {type: "new"};
});


function changeFormType() {
    var type = jQuery("#select_type_form option:selected").attr('data-type');

    if (type) {
        jQuery(".form-group-custom").hide();
        jQuery(".form-group-" + type).show();
        jQuery(".form-group-custom input").attr("disabled", 'disabled');
        jQuery(".form-group-custom select").attr("disabled", 'disabled');
        jQuery(".form-group-" + type + " input").removeAttr("disabled");
        jQuery(".form-group-" + type + " select").removeAttr("disabled");
        if (type === '3') {
            jQuery("#files-offline").hide();
            jQuery("#files-online").show();
        } else {
            jQuery("#files-offline").show();
            jQuery("#files-online").hide();
        }
        if (type === '2' || type === '4') {
            jQuery(".form-spoiler").hide();
            jQuery("#theme").html('Тема');
            if (jQuery("#select_type_form option:selected").val() !== '9') {
                jQuery(".form-spoiler__link").show();
            } else {
                jQuery(".form-spoiler__link").hide();
                jQuery(".form-spoiler").show();
            }
        } else {
            jQuery(".form-spoiler").show();
            jQuery("#theme").html('Название заказа');
            jQuery(".form-spoiler__link").hide();
        }
    } else {
        jQuery(".form-group-custom").hide();
        jQuery(".form-spoiler__link").hide();
        jQuery("#files-offline").show();
        jQuery("#files-online").hide();
        jQuery(".form-spoiler").show();
    }
}


