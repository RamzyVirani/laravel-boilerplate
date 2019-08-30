@if($model->status == 1)
<input type="checkbox" name="status" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="status" data-value="{{ $model->id }}" checked id="get_status{{ $model->id }}">

    @else

    <input type="checkbox" name="status" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="status" data-value="{{ $model->id }}" id="get_status{{ $model->id }}">

@endif

<script type="text/javascript">
    $(function () {
        $('input[type="checkbox"]').bootstrapToggle({
            on: 'Enabled',
            off: 'Disabled'
        });
    });

    $("#get_status{{ $model->id }}").change(function () {
        var i = $(this).data("value");
        statusChange(i);
        return false;
    });

    function statusChange(id) {
        console.log(id);
        $.ajax({
            url: "statusChange/" + id,
            method: 'GET'
        }).done(function (response) {
            if (response === 'Success') {
                swal({
                    title: "Success",
                    icon: "success"
                }).then(function () {
                    location.reload();
                });
            }
            else {
                location.reload();
            }

        });
    }


    /*$(function () {

        $(document).on('click', '.btn-up', function () {

            var tr = $(this).parents('tr');
            var trPrev = tr.prev('tr');

            if (trPrev.length != 0) {
                var prevChPos = $('input.inputSort', trPrev).val();
                var prevChId = $('input.inputSort', trPrev).data('id');
                var chPos = $('input.inputSort', tr).val();
                var chId = $('input.inputSort', tr).data('id');

                // Handle UI
                trPrev.before(tr.clone());
                tr.remove();

                // Init Ajax to send sort values.
                var result = swappingRequest(prevChPos, prevChId, chPos, chId);

                if (result) {
                    // Update chanel position - UI
                    $('input.inputSort', tr).val('');
                    $('input.inputSort', tr).val(prevChPos);

                    $('input.inputSort', trPrev).val('');
                    $('input.inputSort', trPrev).val(chPos);
                }
            }
        });

        $(document).on('click', '.btn-down', function () {
            var tr = $(this).parents('tr');
            var trPrev = tr.next('tr');
            if (trPrev.length != 0) {
                var prevChPos = $('input.inputSort', trPrev).val();
                var prevChId = $('input.inputSort', trPrev).data('id');
                var chPos = $('input.inputSort', tr).val();
                var chId = $('input.inputSort', tr).data('id');

                // Init Ajax to send sort values.
                swappingRequest(prevChPos, prevChId, chPos, chId, function (response) {
                    result = response.msg;
                    if (result) {
                        // Update chanel position - UI
                        $('span.hidden', tr).html(prevChPos);
                        $('input.inputSort', tr).val(prevChPos);

                        $('span.hidden', trPrev).html(chPos);
                        $('input.inputSort', trPrev).val(chPos);

                        // Handle UI
                        tr.next('tr').after(tr.clone());
                        tr.remove();
                    }
                });


            }
        });

    });

    function swappingRequest(prevChPos, prevChId, chPos, chId, cb) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            method: "POST",
            url: "updateChannelPosition",
            type: "JSON",
            async: false,
            data: {
                channelId: chId,
                channelPosition: chPos,
                prevChannelId: prevChId,
                prevChannelPosition: prevChPos
            },
            success: cb
        });
    }*/
</script>