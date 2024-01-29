<div class="row mt-2">
    <div class="col-12 text-right">
        <button id="btn-new-customer" class="btn btn-primary font-weight-bold">Crear Cliente</button>
    </div>
</div>
<div id="main-customers"></div>
<script>
    getCustomerDT();

    function getCustomerDT() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/getCustomerDT'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-customers').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    }

    $('#btn-new-customer').on('click', function () {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/newCustomer');?>",
            data: "",
            dataType: "html",
            success: function (response) {
                $('#main-modal').html(response);
            },
            error: function (error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
        
    });
</script>