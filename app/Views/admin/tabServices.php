<div class="row">
    <div class="col-12 mt-2 text-right">
        <button id="btn-new-service" type="button" class="btn btn-primary font-weight-bold">Nuevo Servicio</button>
    </div>
</div>
<div id="main-services"></div>

<script>
    getServices();

    function getServices() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/getServices'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-services').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    }

    $('#btn-new-service').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/modalService'); ?>",
            data: {
                'action': 'create'
            },
            dataType: "html",
            success: function(response) {
                $('#main-modal').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    });
</script>