<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Cancelar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">Desea usted cancelar esta cita! Esta acción no es reversible y la cita quedará disponible!</div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <label for="txt-description">Motivo por el cuál cancela la cita (Opcional)</label>
                        <textarea id="txt-description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btn-cancel" type="button" class="btn btn-danger">Si, Cancelar la Cita</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#main-modal').html('');
        });

        $('#btn-cancel').on('click', function() {
            $('#btn-cancel').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/removeAppointmentProcess'); ?>",
                data: {
                    'id': '<?php echo $appointmentID; ?>',
                    'note': $('#txt-description').val()
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showAlert('success', 'Perfecto', 'Su cita ha sido cancelada satisfactoriamente');
                            $('#modal').modal('hide');
                            getCalendar(initialDate);
                            <?php if(!empty($customer)) : ?>
                                getCustomerAppointments();
                            <?php endif ?>
                            break;
                        case 1:
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                            break;
                        case 2:
                            window.location.href = "<?php echo base_url('Home/index?sessionExpired=true'); ?>";
                            break;
                    }
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
        });
    });
</script>