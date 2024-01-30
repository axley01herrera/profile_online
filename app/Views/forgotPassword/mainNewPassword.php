<?php
if (empty($config->avatar))
    $urlImage = 'background-image: url("' . base_url('public/assetsv2/media/users/blank.png') . '")';
else
    $urlImage = 'background-image: url(data:image/png;base64,' . base64_encode($config->avatar) . ')';
?>
<link href="<?php echo base_url('public/assetsv2/css/pages/login/classic/login-4.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('public/assetsv2/js/pages/custom/login/login-general.js'); ?>"></script>
<div class="d-flex flex-column flex-root">
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <div class="login-signin" hidden>
                    <form class="form" id="kt_login_signin_form">
                    </form>
                    <div class="mt-10">
                        <a href="javascript:;" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                    </div>
                </div>
                <div class="login-signup">
                    <div class="d-flex flex-center mb-15">
                        <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                            <div class="symbol-label" style="<?php echo $urlImage; ?>"></div>
                            <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                        </div>
                    </div>
                    <div class="mb-20">
                        <h3 class="text-white">Nueva Contraseña</h3>
                        <div class="text-muted font-weight-bold">Ingresa tu nueva clave de acceso!</div>
                    </div>
                    <form class="form" id="kt_login_signup_form">
                        <div class="form-group mb-5">
                            <input id="txt-password" class="form-control h-auto form-control-solid py-4 px-8 required" type="password" placeholder="Contraseña" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-passwordc" class="form-control h-auto form-control-solid py-4 px-8 required" type="password" placeholder="Confirmar Contraseña" />
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button type="button" id="btn-newPassword" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Enviar</button>
                            <a href="<?php echo base_url('Home'); ?>" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancelar</a>
                        </div>
                    </form>
                </div>
                <div class="login-forgot">
                    <form class="form" id="kt_login_forgot_form">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#kt_login_signup').trigger('click');
        $('#btn-newPassword').on('click', function(e) {
            e.preventDefault();
            let result = checkRequiredValues();
            if (result == 0) {
                let pass = $('#txt-password').val();
                let passc = $('#txt-passwordc').val();
                if (pass == passc) {
                    $('#btn-forgotPassword').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Home/setNewPassword'); ?>",
                        data: {
                            'pass': pass,
                            'customer_id': '<?php echo $customer->id; ?>'
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showAlert('success', 'Perfecto', 'Contraseña creada satisfactoriamente');
                                    setTimeout(() => {
                                        window.location.href = "<?php echo base_url('Home'); ?>";
                                    }, "5000");
                                    break
                                case 1:
                                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                                    break
                            }
                        },
                        error: function(error) {
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                        }
                    });
                } else {
                    $('#txt-passwordc').addClass('is-invalid');
                    showAlert('warning', 'Lo Sentimos', 'Las contraseñas no coinciden');
                }
            } else
                showAlert('warning', 'Lo Sentimos', 'Todos los campos son requeridos');
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