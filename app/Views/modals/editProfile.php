<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Editando Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-5">
                        <label for="txt-name">Nombre</label>
                        <input type="text" id="txt-name" class="form-control modal-required" value="<?php echo $customer->name; ?>">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <label for="txt-lastName">Apellidos</label>
                        <input type="text" id="txt-lastName" class="form-control modal-required" value="<?php echo $customer->lastName; ?>">
                    </div>
                    <div class="col-12 mt-5">
                        <label for="txt-email">Correo Electrónico</label>
                        <input type="text" id="txt-email" class="form-control modal-required modal-email" value="<?php echo $customer->email; ?>">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <label for="txt-phone">Teléfono</label>
                        <input type="text" id="txt-phone" class="form-control modal-number" maxlength="9" value="<?php if (!empty($customer->phone)) echo $customer->phone; ?>">
                    </div>
                    <?php if (empty($customer->emailVerified)) : ?>
                        <div class="col-12 mt-5">
                            <div class="alert alert-custom alert-light-warning fade show mt-5" role="alert">
                                <div class="alert-text text-danger text-center">
                                    No tienes verificada tu cuenta de correo
                                    <div class="text-center">
                                        <button id="send-verified-email" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Enviar Correo de Verificación</button>
                                    </div>
                                </div>
                            </div>
                            Si verificas tu cuenta de correo podrás recibir notificaciones sobre el estado de tus citas.
                        </div>
                    <?php else : ?>
                        <div class="col-12 mt-5">
                            <label for="">Notificaciones</label>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-emailSubscription" type="checkbox" <?php if ($customer->emailSubscription == 1) echo "checked"; ?> data-id="<?php echo $customer->id; ?>" data-value="<?php echo $customer->emailSubscription; ?>" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-updateProfile" type="button" class="btn btn-primary">Guardar</button>
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

        $('#btn-updateProfile').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                let resultEmailFormat = checkEmailFormat();
                if (resultEmailFormat == 0) {
                    $('#btn-updateProfile').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/editProfileProcess'); ?>",
                        data: {
                            'name': $('#txt-name').val(),
                            'lastName': $('#txt-lastName').val(),
                            'email': $('#txt-email').val(),
                            'phone': $('#txt-phone').val(),
                            'customerID': '<?php echo $customer->id; ?>'
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showAlert('success', 'Perfecto', 'Perfil Actualizado');
                                    $('#btn-updateProfile').removeAttr('disabled');
                                    <?php if ($admin == 1) : ?>
                                        getCustomerDT();
                                    <?php endif ?>
                                    break;
                                case 1:
                                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                                    break;
                                case 2:
                                    window.location.href = "<?php echo base_url('Home/index?sessionExpired=true'); ?>";
                                    break;
                                case 3:
                                    showAlert('error', 'Lo Sentimos', 'Ya existe un cliente registrado con esa cuenta de correo electrónico');
                                    $('#btn-updateProfile').removeAttr('disabled');
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
                showAlert('warning', 'Lo Sentimos', '¡Hay campos requeridos sin completar');
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

        $('.modal-number').on('input change', function() {
            jQuery(this).val(jQuery(this).val().replace(/[^0-9+]/g, ''));
        });

        $('#send-verified-email').on('click', function() {
            $('#send-verified-email').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/sendEmailConfirmation'); ?>",
                data: {
                    'customerID': '<?php echo $customer->id; ?>'
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showAlert('success', 'Perfecto', 'Te hemos enviado un email de verificación');
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

        $('.cbx-emailSubscription').on('click', function() {
            let customerID = $(this).attr('data-id');
            let emailSubscription = $(this).attr('data-value');
            let newValue = '';
            let msg = '';

            if (emailSubscription == 0) {
                newValue = 1;
                msg = 'Notificaciones Activadas';
            } else {
                newValue = 0;
                msg = 'Notificaciones Desactivadas';
            }

            $(this).attr('data-value', newValue);

            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/updateEmailSubscription'); ?>",
                data: {
                    'customerID': customerID,
                    'emailSubscription': newValue
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showAlert('success', 'Perfecto', msg);
                            $('#btn-updateProfile').removeAttr('disabled');
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