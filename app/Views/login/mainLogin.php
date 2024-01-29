<?php
if (empty($config->avatar))
    $urlImage = 'background-image: url("' . base_url('public/assets/media/users/blank.png') . '")';
else
    $urlImage = 'background-image: url(data:image/png;base64,' . base64_encode($config->avatar) . ')';
?>
<link href="<?php echo base_url('public/assets/css/pages/login/classic/login-4.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('public/assets/js/pages/custom/login/login-general.js'); ?>"></script>
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
                        <h3 class="text-white">Inicio de Sesión</h3>
                        <div class="text-muted font-weight-bold">Ingresa tus credenciales</div>
                    </div>
                    <form class="form" id="kt_login_signup_form">
                        <div class="form-group mb-5">
                            <input id="txt-email" class="form-control h-auto form-control-solid py-4 px-8 required email" type="text" placeholder="Correo Electrónico" autocomplete="on" />
                        </div>
                        <div class="form-group mb-5">
                            <input id="txt-password" class="form-control h-auto form-control-solid py-4 px-8 required" type="password" placeholder="Contraseña" />
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-muted">
                                    <input id="cbx-remember" type="checkbox" data-value="0">
                                    <span></span>Recuérdame</label>
                            </div>
                            <a href="<?php echo base_url('Home/forgotPassword'); ?>" class="text-muted text-hover-primary">Recuperar Contraseña</a>
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button type="button" id="btn-login" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Entrar</button>
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
            $('#txt-email').focus();
        }, "1500");

        if (localStorage.remember != undefined && localStorage.remember != '') {
            $('#cbx-remember').trigger('click');
            $('#cbx-remember').attr('data-value', '1');

            let emailInput = document.getElementById("txt-email");
            let passInput = document.getElementById("txt-password");

            emailInput.value = localStorage.username;
            passInput.value = localStorage.pass;
        } else {
            clearRemember();
            $('#cbx-remember').attr('data-value', '0');
        }

        $('#btn-login').on('click', function(e) {
            e.preventDefault();

            let result = checkRequiredValues();
            let emailFormat = checkEmailFormat();

            if (result == 0 && emailFormat == 0) {
                $('#btn-login').attr('disabled', true);

                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Home/verifyCredentials'); ?>",
                    data: {
                        'email': $('#txt-email').val(),
                        'pass': $('#txt-password').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                let remember = $('#cbx-remember').attr('data-value');
                                if(remember == 1) {
                                    localStorage.remember = '1';
                                    localStorage.username = $('#txt-email').val(); 
                                    localStorage.pass = $('#txt-password').val();
                                }
                                window.location.href = "<?php echo base_url('Customer'); ?>";
                                break;
                            case 1:
                                showAlert('error', 'Lo Sentimos', 'Rectifique sus Contaseña');
                                $('#txt-password').addClass('is-invalid');
                                $('#btn-login').removeAttr('disabled');
                                break
                            case 403:
                                showAlert('error', 'Lo Sentimos', 'Su acceso no está activo');
                                $('#btn-login').removeAttr('disabled');
                                break
                            case 500:
                                showAlert('error', 'Lo Sentimos', 'Rectifique su Correo Electrónico');
                                $('#txt-email').addClass('is-invalid');
                                $('#btn-login').removeAttr('disabled');
                                break;
                        }
                    },
                    error: function(error) {
                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                    }
                });
            } else {
                showAlert('error', 'Lo Sentimos', 'Rectifique sus Credenciales');
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

        function clearRemember() {
            localStorage.remember = '';
            localStorage.username = '';
            localStorage.pass = '';
        }

        $('#cbx-remember').on('click', function () {
            let value = $(this).attr('data-value');

            if(value == 0) 
                $('#cbx-remember').attr('data-value', '1');
            else {
                $('#cbx-remember').attr('data-value', '0');
                clearRemember();
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
                $('#btn-login').trigger('click');
            }
        });
    });
</script>