<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Tipo de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 text-center">
                        <input id="radio-e" type="radio" class="radio-payType" name="radio-payType" value="1" /> <label for="radio-e">Efectivo</label>
                    </div>
                    <div class="col-6 text-center">
                        <input id="radio-t" type="radio" class="radio-payType" name="radio-payType" value="2" /> <label for="radio-t">Tarjeta</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-modal-submit" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var payType = "";
    $('#modal').modal('show');
    $('#modal').on('hidden.bs.modal', function(event) {
        $('#main-modal').html('');
    });

    $('#btn-modal-submit').on('click', function() {
        if (payType != '') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/charge'); ?>",
                data: {
                    'payType': payType,
                    'basketID': '<?php echo $basketID; ?>'
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            $('#modal').modal('hide');
                            getTabContent('tpv');
                            showAlert('success', 'Ticket', 'Cobrado satisfactoriamente');
                            window.open('<?php echo base_url('Admin/printPDF');?>' + '?basketID=' + response.basketID, '_blank');
                            break;
                        case 1:
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                            break;
                    }
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
        } else
            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
    });

    $('.radio-payType').on('click', function() {
        payType = $(this).val();
    });
</script>