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
                        <h3 class="text-white">Formulario de Registro</h3>
                        <div class="text-muted font-weight-bold">Ingresa tus datos para crear tu cuenta</div>
                    </div>
                    <form class="form" id="kt_login_signup_form">
                        <div class="form-group mb-5">
                            <input id="txt-name" class="form-control h-auto form-control-solid py-4 px-8 required" type="text" placeholder="Nombre" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-lastName" class="form-control h-auto form-control-solid py-4 px-8 required" type="text" placeholder="Apellidos" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-email" class="form-control h-auto form-control-solid py-4 px-8 required email" type="text" placeholder="Correo Electrónico" autocomplete="off" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-password" class="form-control h-auto form-control-solid py-4 px-8 required" type="password" placeholder="Contraseña" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-passwordc" class="form-control h-auto form-control-solid py-4 px-8 required" type="password" placeholder="Confirmar Contraseña" />
                        </div>
                        <div class="form-group mb-5 text-left">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-light">
                                    <input id="cbx-terms" type="checkbox" value="0" />
                                    <span></span>Estoy de acuerdo con
                                    <a id="show-terms" href="#" class="font-weight-bold ml-1">Política de Privacidad</a>
                                </label>
                            </div>
                            <div id="msg-term" class="fv-plugins-message-container" hidden>
                                <div data-field="agree" data-validator="notEmpty" class="fv-help-block">Debe aceptar la Política de Privacidad</div>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button type="button" id="btn-signup" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Inscribirse</button>
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

        setTimeout(() => {
            $('#txt-name').focus();
        }, "1500");

        $('#btn-signup').on('click', function(e) {
            e.preventDefault();
            let result = checkRequiredValues();
            let emailFormat = checkEmailFormat();
            if (result == 0 && emailFormat == 0) {
                let pass = $('#txt-password').val();
                let passc = $('#txt-passwordc').val();
                if (pass == passc) {
                    let term = $('#cbx-terms').val();
                    if (term == 1) {
                        $('#btn-signup').attr('disabled', true);
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('Home/signupProcess'); ?>",
                            data: {
                                'name': $('#txt-name').val(),
                                'lastName': $('#txt-lastName').val(),
                                'email': $('#txt-email').val(),
                                'pass': pass,
                                'term': term
                            },
                            dataType: "json",
                            success: function(response) {
                                switch (response.error) {
                                    case 0:
                                        showAlert('success', 'Perfecto', 'Ya puedes iniciar sesión');
                                        setTimeout(() => {
                                            window.location.href = "<?php echo base_url('Home'); ?>";
                                        }, "5000");
                                        break
                                    case 1:
                                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                                        break
                                    case 100:
                                        showAlert('warning', 'Lo Sentimos', 'Ya existe este correo electrónivo en mis registros');
                                        $('#txt-email').addClass('is-invalid');
                                        $('#btn-signup').removeAttr('disabled');
                                        break
                                }
                            },
                            error: function(error) {
                                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                            }
                        });
                    } else {
                        $('#msg-term').removeAttr('hidden');
                        showAlert('warning', 'Importante', 'Acepte la política de privacidad');
                    }
                } else
                    $('#txt-passwordc').addClass('is-invalid');

            } else
                showAlert('warning', 'Importante', 'Rectifique los datos del formulario, todos los campos son requeridos');

        });

        $('#show-terms').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Home/showTerms'); ?>",
                data: "",
                dataType: "html",
                success: function(response) {
                    $('#main-modal').html(response);
                },
                error: function() {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
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

        function checkEmailFormat() {
            let response = 0;
            let value = '';
            let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

            $('.email').each(function() {
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

        $('.required').on('focus', function() {
            $(this).removeClass('is-invalid');
        });

        $('#cbx-terms').on('click', function() {
            let value = $(this).val();
            if (value == 0) {
                $(this).val('1');
                $('#msg-term').attr('hidden', true);
            } else {
                $('#msg-term').removeAttr('hidden');
                $(this).val('0');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var formulario = document.getElementById("kt_login_signup_form");

        formulario.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault(); // Evita que el formulario se envíe
                $('#btn-signup').trigger('click');
            }
        });
    });
</script>