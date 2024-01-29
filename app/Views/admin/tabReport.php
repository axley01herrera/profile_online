<div class="row">
    <div class="col-12 col-md-6 col-lg-6 text-center mt-1">
        <label for="txt-dateStart" class="text-primary fs-5">
            Desde
            <input type="date" id="txt-dateStart" class="form-control focus required" />
            <p id="msg-txt-dateStart" class="text-danger text-end"></p>
        </label>
    </div>
    <div class="col-12 col-md-6 col-lg-6 text-center mt-1">
        <label for="txt-dateEnd" class="text-primary fs-5">
            Hasta
            <input type="date" id="txt-dateEnd" class="form-control focus required" />
            <p id="msg-txt-dateEnd" class="text-danger text-end"></p>
        </label>
    </div>
    <div class="col-12 text-center">
        <button id="btn-createReport" class="btn btn-primary">Reporte</button>
    </div>
</div>

<div id="report-content"></div>

<script>
    $('#btn-createReport').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues();
        let dateStart = $('#txt-dateStart').val();
        let dateEnd = $('#txt-dateEnd').val();
        if (dateStart != '' && dateEnd != '') {
            const objDateStart = new Date(dateStart);
            const objDateEnd = new Date(dateEnd);
            if (objDateEnd >= objDateStart) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/returnReportContent'); ?>",
                    data: {
                        'dateStart': dateStart,
                        'dateEnd': dateEnd
                    },
                    dataType: "html",
                    success: function(response) {
                        $('#report-content').html(response);
                    },
                    error: function(error) {
                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                    }
                });

            } else {
                $('#txt-dateStart').val('');
                $('#txt-dateEnd').val('');
                showAlert('warning', 'Lo Sentimos', 'Complete los rangos de fecha correctamente');
            }
        } else
            showAlert('warning', 'Lo Sentimos', 'Complete los rangos de fecha');


    });

    $('.focus').on('change input', function() {
        $(this).removeClass('is-invalid');
        let inputID = $(this).attr("id");
        $('#msg-' + inputID).html("");
    });

    function checkRequiredValues() {
        let response = 0;
        let value = '';

        $('.required').each(function() {
            value = $(this).val();
            if (value == '') {
                $(this).addClass('is-invalid');
                response = 1
            }
        });

        return response;
    }
</script>