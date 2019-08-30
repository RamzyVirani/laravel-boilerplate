$(function () {
    $('#tabtittle1').removeClass();
    $('#tabtittle3').removeClass();
    $('#tabtittle2').attr('class', 'active');

    $(document).on('click', '.table-display .btn-plus', function () {
        var tr_parent = $(this).parent().parent('tr');
        var clone = $('#tr-sample').clone();

        clone.removeAttr('id');
        clone.removeAttr('style');
        tr_parent.after(clone);
        $('.table-display tr').not('#tr-sample').show();
    });

    //init row
    //$('.btn-plus').last().click();

    $(document).mouseup(function (e) {
        var container = $(".sub");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });

    $(document).on('click', '.sub li', function () {
        var v = $(this).text();
        $(this).parent('ul').prev('input[type=text]').val(v);
        $(this).parent('ul').remove();
    });

    $(document).on('click', '.table-display .btn-delete', function () {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.delete-sample', function () {
        $('#tr-sample').remove();
        $('#form2').submit();
    });

    $(document).on('click', '.table-display .btn-up', function () {
        var tr = $(this).parent().parent();
        var trPrev = tr.prev('tr');
        if (trPrev.length != 0) {
            tr.prev('tr').before(tr.clone());
            tr.remove();
        }
    });

    $(document).on('click', '.table-display .btn-down', function () {
        var tr = $(this).parent().parent();
        var trPrev = tr.next('tr');
        if (trPrev.length != 0) {
            tr.next('tr').after(tr.clone());
            tr.remove();
        }
    });

    $(document).on('change', '.is_image', function () {
        var tr = $(this).parent().parent();
        if ($(this).val() == 1) {
            tr.find('.is_download').val(0);
        }
    });

    // $(document).submit('.ajaxform', function(){
    //     var data = $(this).serialize();
    //     var url = $(this).attr('action');
    //     $.post(url, data).done(function (data) {
    //         if (data.data == 200)
    //             window.location.href = '../step3/'+data.message;
    //     });
    // })
});