<!-- Modal-->
<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Clave de Acceso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-5">
                    <label for="txt-password">Nueva Clave</label>
                    <input id="txt-password" class="form-control required" type="password" />
                </div>
                <div class="form-group mb-5">
                    <label for="txt-passwordc">Confirmar</label>
                    <input id="txt-passwordc" class="form-control required" type="password" />
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-setNewPassword" type="button" class="btn btn-primary">Guardar</button>
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

        $('#btn-setNewPassword').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                let pass = $('#txt-password').val();
                let passc = $('#txt-passwordc').val();
                if (pass == passc) {
                    $('#btn-setNewPassword').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Admin/changePasswordProcess'); ?>",
                        data: {
                            'pass': pass
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showAlert('success', 'Perfecto', 'Su clave de acceso ha sido actucalizada satisfactoriamente');
                                    $('#modal').modal('hide');
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
                } else
                    $('#txt-passwordc').addClass('is-invalid');
            }
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

        $('.required').on('focus', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>