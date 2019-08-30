function confirmDelete(form) {
    console.log(form);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            $(form).submit();
        }
    });
}

function formatFaIcon(state) {
    if (!state.id) return state.text; // optgroup
    return "<i class='fa fa-" + state.id + "'></i> " + state.text;
}

function defaultFormat(state) {
    return state.text;
}

$(function () {
    $('input:checkbox, input:radio').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    /* $('.select2').each(function () {
         var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
         $(this).select2({
             theme: "bootstrap",
             templateResult: window[format],
             templateSelection: window[format],
             escapeMarkup: function (m) {
                 return m;
             }
         });
     });*/

    $('input:checkbox.checkall').on('ifToggled', function (event) {
        var newState = $(this).is(":checked") ? 'check' : 'uncheck';
        var css = $(this).data('check');
        $('input:checkbox.' + css).iCheck(newState);
    });

    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();

    $('.select2').css('width', '100%');

    // dependent select 2
    $.fn.customLoad = function () {
        //Timepicker
        // $('.timepicker').timepicker({
        //     showInputs: false,
        //     containerClass: 'bootstrap-timepicker',
        //     timeFormat: 'HH:mm:ss p'
        // });

        $('.select2').each(function () {
            var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
            var thisSelectElement = this;
            var options = {
                theme: "bootstrap",
                templateResult: window[format],
                templateSelection: window[format],
                escapeMarkup: function (m) {
                    return m;
                }
            };

            if ($(thisSelectElement).data('url')) {
                var depends;
                if ($(thisSelectElement).data('depends')) {
                    depends = $('[name=' + $(thisSelectElement).data('depends') + ']');
                    depends.on('change', function () {
                        $(thisSelectElement).val(null).trigger('change')
                        // $(thisSelectElement).trigger('change');
                    });
                }
                var url = $(thisSelectElement).data('url');

                options.ajax = {
                    url: url,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term,
                            locale: 'en',
                            depends: $('option:selected', depends).val()
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (obj, id) {
                                return {id: obj.id, text: obj.name};
                            })
                        };
                    }

                }
            }

            var tabindex = $(thisSelectElement).attr('tabindex');

            $(thisSelectElement).select2(options);

            $(thisSelectElement).attr('tabindex', tabindex);
            $(thisSelectElement).on(
                'select2:select', (
                    function () {
                        $(this).focus();
                    }
                )
            );
        });
    };

    $(document).customLoad();

    $(document).on('click', '.btn-up-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.prev('tr');

        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');

            // Handle UI
            trPrev.before(tr.clone());
            tr.remove();

            // Init Ajax to send sort values.
            var result = swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token);

            if (result) {
                // Update chanel position - UI
                $('input.inputSort', tr).val('');
                $('input.inputSort', tr).val(prevRowPos);

                $('input.inputSort', trPrev).val('');
                $('input.inputSort', trPrev).val(RowPos);
            }
        }
    });

    $(document).on('click', '.btn-down-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.next('tr');
        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');


            // Init Ajax to send sort values.
            swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, function (response) {
                var result = response.data.msg;
                if (result) {
                    // Update chanel position - UI
                    $('input.inputSort', tr).val(prevRowPos);
                    $('input.inputSort', trPrev).val(rowPos);

                    // Handle UI
                    tr.next('tr').after(tr.clone());
                    tr.remove();
                }
            });

        }
    });
});

function swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, cb) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token
        }
    });
    $.ajax({
        method: "PUT",
        url: url,
        type: "JSON",
        async: false,
        data: {
            rowId: rowId,
            rowPosition: rowPos,
            prevRowId: prevRowId,
            prevRowPosition: prevRowPos
        },
        success: cb
    });
}