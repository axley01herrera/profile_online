<?php
if (empty($config->avatar))
    $urlImage = 'background-image: url("' . base_url('public/assets/media/users/blank.png') . '")';
else
    $urlImage = 'background-image: url(data:image/png;base64,' . base64_encode($config->avatar) . ')';
?>
<div class="tab-pane show active" id="profile" role="tabpanel">


    <div class="card mt-1">
        <div class="card-body">
            <h5>Información del Negocio</h5>
            <!-- Avatar -->
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar" style="<?php echo $urlImage; ?>">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambiar Avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input id="avatar" type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- CompanyName -->
                <div class="col-12 col-lg-6 mt-5">
                    <label for="txt-companyName">Nombre del Negocio</label>
                    <input type="text" id="txt-companyName" class="form-control " value="<?php echo $config->companyName; ?>" />
                </div>
                <!-- Cif -->
                <div class="col-12 col-lg-2 mt-5">
                    <label for="txt-cif">C.I.F</label>
                    <input type="text" id="txt-cif" class="form-control" maxlength="9" value="<?php echo $config->cif; ?>" />
                </div>
            </div>
            <div class="row">
                <!-- Name -->
                <div class="col-12 col-lg-4 mt-5">
                    <label for="txt-name">Tu Nombre</label>
                    <input type="text" id="txt-name" class="form-control" placeholder="Nombre" value="<?php echo $config->name; ?>" />
                </div>
                <!-- Last Name -->
                <div class="col-12 col-lg-4 mt-5">
                    <label for="txt-lastName">Apellidos</label>
                    <input type="text" id="txt-lastName" class="form-control" value="<?php echo $config->lastName; ?>" />
                </div>
                <!-- Profession -->
                <div class="col-12 col-lg-4 mt-5">
                    <label for="txt-profession">A qué te dedicas</label>
                    <input type="text" id="txt-profession" class="form-control" value="<?php echo $config->profession; ?>" />
                </div>
            </div>
            <div class="row">
                <!-- Phone -->
                <div class="col-12 col-lg-3 mt-5">
                    <label for="txt-phone">Teléfono (Móvil)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                        <input type="text" id="txt-phone" class="form-control" value="<?php echo $config->phone; ?>" />
                    </div>
                </div>
                <!-- Phone -->
                <div class="col-12 col-lg-3 mt-5">
                    <label for="txt-phone2">Teléfono (Fijo)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                        <input type="text" id="txt-phone2" class="form-control" value="<?php echo $config->phone2; ?>" />
                    </div>
                </div>
                <!-- email -->
                <div class="col-12 col-lg-6 mt-5">
                    <label for="txt-email">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-envelope"></i>
                            </span>
                        </div>
                        <input type="text" id="txt-email" class="form-control" value="<?php echo $config->email; ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2 ">
        <div class="card-body">
            <h5>Localización</h5>
            <div class="row">
                <!-- Address -->
                <div class="col-12 col-lg-6 mt-5">
                    <label for="txt-bussinessAddress">Línea 1</label>
                    <input type="text" id="txt-bussinessAddress" class="form-control" value="<?php echo $config->bussinessAddress; ?>" />
                </div>
                <!-- Address2 -->
                <div class="col-12 col-lg-6 mt-5">
                    <label for="txt-bussinessAddress2">Línea 2</label>
                    <input type="text" id="txt-bussinessAddress2" class="form-control" value="<?php echo $config->bussinessAddress2; ?>" />
                </div>
                <!-- City -->
                <div class="col-12 col-lg-4 mt-5">
                    <label for="txt-bussinessCity">Ciudad</label>
                    <input type="text" id="txt-bussinessCity" class="form-control" value="<?php echo $config->bussinessCity; ?>" />
                </div>
                <!-- State -->
                <div class="col-12 col-lg-4 mt-5">
                    <label for="txt-bussinessState">Provincia</label>
                    <input type="text" id="txt-bussinessState" class="form-control" value="<?php echo $config->bussinessState; ?>" />
                </div>
                <!-- Postal Code -->
                <div class="col-12 col-lg-2 mt-5">
                    <label for="txt-bussinessPostalCode">Código Postal</label>
                    <input type="text" id="txt-bussinessPostalCode" class="form-control number" value="<?php echo $config->bussinessPostalCode; ?>" maxlength="5" />
                </div>
                <!-- Country -->
                <div class="col-12 col-lg-2 mt-5">
                    <label for="txt-bussinessPostalCode">País</label>
                    <input type="text" id="txt-bussinessCountry" class="form-control" value="<?php echo $config->bussinessCountry; ?>" />
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <h5>Redes Sociales</h5>
            <!-- Facebook -->
            <div class="col-12 mt-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="socicon-facebook"></i>
                        </span>
                    </div>
                    <input type="text" id="txt-facebook" class="form-control" value="<?php echo $config->facebookLink; ?>" />
                </div>
            </div>
            <!-- Instagram -->
            <div class="col-12 mt-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="socicon-instagram"></i>
                        </span>
                    </div>
                    <input type="text" id="txt-instagram" class="form-control" value="<?php echo $config->instagramLink; ?>" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12 text-right">
        <button id="btn-save-profile" class="btn btn-primary font-weight-bold">Guardar Perfil</button>
        <a id="change-password" class="btn btn-secondary font-weight-bold" href="#">Clave de Acceso</a>
    </div>
</div>

<script>
    var avatar = new KTImageInput('kt_user_edit_avatar');
    avatar.on('cancel', function(imageInput) {});
    avatar.on('remove', function(imageInput) {});
    avatar.on('change', function(imageInput) {
        let formData = new FormData();
        formData.append('file', $("#avatar")[0].files[0]);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/uploadPhoto'); ?>",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                getTabContent('profile');
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    });

    $(document).ready(function() {
        $('#btn-save-profile').on('click', function() {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/updateProfile'); ?>",
                data: {
                    'companyName': $('#txt-companyName').val(),
                    'name': $('#txt-name').val(),
                    'cif': $('#txt-cif').val(),
                    'lastName': $('#txt-lastName').val(),
                    'profession': $('#txt-profession').val(),
                    'phone': $('#txt-phone').val(),
                    'phone2': $('#txt-phone2').val(),
                    'email': $('#txt-email').val(),
                    'bussinessAddress': $('#txt-bussinessAddress').val(),
                    'bussinessAddress2': $('#txt-bussinessAddress2').val(),
                    'bussinessCity': $('#txt-bussinessCity').val(),
                    'bussinessState': $('#txt-bussinessState').val(),
                    'bussinessPostalCode': $('#txt-bussinessPostalCode').val(),
                    'bussinessCountry': $('#txt-bussinessCountry').val(),
                    'facebook': $('#txt-facebook').val(),
                    'instagram': $('#txt-instagram').val()
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showAlert('success', 'Perfecto', 'Perfil Actualizado');
                            break
                        case 1:
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                            break
                        case 2:
                            window.location.href = '<?php echo base_url('Home/loginAdmin?sessionExpired=true'); ?>';
                            break
                    }
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });

        });

        $('#change-password').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/changePassword'); ?>",
                data: "",
                dataType: "html",
                success: function(response) {
                    $('#main-modal').html(response);
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
        });
    });

    $('.number').on('input change', function() {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9+]/g, ''));
    });
</script>