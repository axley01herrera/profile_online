<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-5">
                        <label for="txt-name">Nombre</label>
                        <input type="text" id="txt-name" class="form-control modal-required" />
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <label for="txt-lastName">Apellidos</label>
                        <input type="text" id="txt-lastName" class="form-control modal-required" />
                    </div>
                    <div class="col-12 mt-5">
                        <label for="txt-email">Correo Electrónico</label>
                        <input type="text" id="txt-email" class="form-control modal-required modal-email" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-newCustomer" type="button" class="btn btn-primary">Guardar</button>
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

        $('#btn-newCustomer').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                let resultEmailFormat = checkEmailFormat();
                if (resultEmailFormat == 0) {
                    $('#btn-newCustomer').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Admin/signupProcess'); ?>",
                        data: {
                            'name': $('#txt-name').val(),
                            'lastName': $('#txt-lastName').val(),
                            'email': $('#txt-email').val(),
                            'pass': $('#txt-name').val(),
                            'term': 1.
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showAlert('success', 'Perfecto', 'Cliente creado');
                                    $('#btn-newCustomer').removeAttr('disabled');
                                    getCustomerDT();
                                    $('#modal').modal('hide');
                                    break;
                                case 1:
                                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                                    break;
                                case 2:
                                    window.location.href = "<?php echo base_url('Home/index?sessionExpired=true'); ?>";
                                    break;
                                case 3:
                                    showAlert('error', 'Lo Sentimos', 'Ya existe un cliente registrado con esa cuenta de correo electrónico');
                                    $('#btn-newCustomer').removeAttr('disabled');
                                    $('#txt-email').addClass('is-invalid');
                                    break;
                            }
                        },
                        error: function(error) {
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                        }
                    });
                } else
                    showAlert('warning', 'Lo Sentimos', 'Debe introducir un formato de correo electrónico válido');
            } else
                showAlert('warning', 'Lo Sentimos', 'Hay campos requeridos sin completar');
        });

        function checkRequiredValues() {
            let response = 0;
            let value = '';

            $('.modal-required').each(function() {
                value = $(this).val();
                if (value == '') {
                    $(this).addClass('is-invalid');
                    response = 1
                }
            });

            return response;
        }

        function checkEmailFormat() {
            let response = 0;
            let value = '';
            let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

            $('.modal-email').each(function() {
                value = $(this).val();
                if (value !== '') {
                    if (!regex.test(value)) {
                        $(this).addClass('is-invalid');
                        response = 1;
                    }
                }
            });
            return response;
        }

        $('.modal-required').on('focus', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>