$(function () {
    $('#tab3').click();

    $('#tabtittle1').removeClass();
    $('#tabtittle2').removeClass();
    $('#tabtittle3').attr('class', 'active');

    $(document).on('click', '.btn-plus', function () {
        var tr_parent = $(this).parent().parent('tr');
        var clone = $('#tr-sample').clone();
        clone.removeAttr('id');
        tr_parent.after(clone);
        $('.table-form tr').not('#tr-sample').show();
    });

    //init row
    //$('.btn-plus').last().click();

    $(document).mouseup(function (e) {
        var container = $(".sub");
        if (!container.is(e.target)
            && container.has(e.target).length === 0) {
            container.hide();
        }
    });

    $(document).on('click', '.table-form .btn-delete', function () {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.table-form .btn-up', function () {
        var tr = $(this).parent().parent();
        var trPrev = tr.prev('tr');
        if (trPrev.length != 0) {

            tr.prev('tr').before(tr.clone());
            tr.remove();
        }
    });

    $(document).on('click', '.table-form .btn-down', function () {
        var tr = $(this).parent().parent();
        var trPrev = tr.next('tr');
        if (trPrev.length != 0) {

            tr.next('tr').after(tr.clone());
            tr.remove();
        }
    });

    $(document).on('click', '.sub li', function () {
        var v = $(this).attr('value');

        var input_name = $(this).parent().parent('td').find('input[type=text]').attr('name');

        if (input_name == 'validation[]') {
            var currentVal = $(this).parent('ul').prev('input[type=text]').val();
            if (currentVal != '') {
                v = currentVal + '|' + v;
            }
            $(this).parent('ul').prev('input[type=text]').val(v);
            $(this).parent('ul').remove();
        } else {
            $(this).parent('ul').prev('input[type=text]').val(v);
            $(this).parent('ul').remove();
        }
    });

    $(document).on('click', '.delete-sample', function () {
        $('#tr-sample').remove();
        $('#form3').submit();
    });

    // $(document).on('click','#submit_step3',function() {
    //     data = $("#form3").serialize();
    //     $.post("../../step3", data).done(function (data) {
    //         if (data.data == 200)
    //             window.location.href = '/infyom/admin/home';
    //     });
    // });
});