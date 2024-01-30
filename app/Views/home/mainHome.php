<?php
if (empty($config->avatar))
    $urlImage = 'background-image: url(' . base_url('public/assetsv2/media/logos/default.png') . ')';
else
    $urlImage = 'background-image: url(data:image/png;base64,' . base64_encode($config->avatar) . ')';
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Bussines Info -->
        <div class="col-12 col-lg-3 mt-5">
            <div class="card card-custom">
                <div class="card-body pt-5">
                    <div class="text-center mb-5">
                        <!-- Logo -->
                        <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                            <div class="symbol-label" style="<?php echo $urlImage; ?>"></div>
                            <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                        </div>
                        <!-- Manager -->
                        <h4 class="font-weight-bold my-2" title="<?php echo $config->profession; ?>">
                            <?php echo $config->name . ' ' . $config->lastName; ?>
                        </h4>
                        <!-- Bussines Name -->
                        <div class="text-muted mb-2">
                            <a href="<?php echo base_url('Home/loginAdmin'); ?>">
                                <?php
                                if (!empty($config->companyName))
                                    echo $config->companyName;
                                else
                                    echo 'Nombre del Negocio';
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <!-- Email -->
                        <?php if (!empty($config->email)) : ?>
                            <span class="font-weight-bold mr-2">Correo Electrónico</span>
                            <br>
                            <a href="mailto:<?php echo $config->email; ?>" class="text-muted text-hover-primary"><?php echo $config->email; ?></a>
                            <br><br>
                        <?php endif ?>
                        <!-- Phone -->
                        <?php if (!empty($config->phone)) : ?>
                            <span class="font-weight-bold mr-2">Teléfono Móvil</span>
                            <br>
                            <a href="tel:<?php echo str_replace(' ', '', $config->phone); ?>" class="text-muted text-hover-primary"><?php echo $config->phone; ?></a>
                        <?php endif ?>
                        <!-- Phone 2 -->
                        <?php if (!empty($config->phone2)) : ?>
                            <br><br>
                            <span class="font-weight-bold mr-2">Teléfono Fijo</span>
                            <br>
                            <a href="tel:<?php echo str_replace(' ', '', $config->phone2); ?>" class="text-muted text-hover-primary"><?php echo $config->phone2; ?></a>
                        <?php endif ?>
                    </div>
                    <!-- Welcome msg -->
                    <div class="pb-6 mt-2">Bienvenido a mi perfil profesional en línea, te invito a registrarte para que reserves tus citas aquí</div>
                    <a id="btn-registration" href="<?php echo base_url('Home/signup'); ?>" class="btn btn-light-success font-weight-bold py-3 px-6 mb-2 text-center btn-block">Regístrate</a>
                    <div class="text-center mt-5">
                        <h3 class="card-title font-weight-bolder">Ya eres cliente</h3>
                        <p class="text-center font-weight-normal font-size-lg">Inicia sesión para gestionar tus citas</p>
                    </div>
                    <!-- btn login -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="<?php echo base_url('Home/login'); ?>" class="btn btn-success btn-shadow-hover font-weight-bolder py-3">Iniciar Sesión</a>
                        </div>
                    </div>
                    <!-- Recover Password -->
                    <div class="text-center mt-5">
                        <a href="<?php echo base_url('Home/forgotPassword'); ?>" class="text-dark-50 text-hover-primary my-3 mr-2">Recuperar Contraseña</a>
                    </div>
                    <!-- Social Networks Links -->
                    <div class="mt-10 text-center">
                        <?php if (!empty($config->facebookLink)) : ?>
                            <a href="<?php echo $config->facebookLink; ?>" target="_blank" class="btn btn-icon btn-circle btn-light-facebook mr-2">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($config->instagramLink)) : ?>
                            <a href="<?php echo $config->instagramLink; ?>" target="_blank" class="btn btn-icon btn-circle btn-light-instagram mr-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($config->bussinessAddress)) : ?>
                            <a id="open-maps" href="#" class="btn btn-icon btn-circle btn-light-primary">
                                <i class="fab fa-periscope"></i>
                            </a>
                        <?php endif ?>
                    </div>
                    <!-- Bussines Address -->
                    <div class="mt-5">
                        <span class="text-muted">
                            <?php
                            if (!empty($config->bussinessAddress))
                                echo $config->bussinessAddress;
                            ?>
                            <?php
                            if (!empty($config->bussinessAddress2)) : ?>
                                , <?php echo $config->bussinessAddress2; ?>
                            <?php endif ?>
                        </span>
                        <br>
                        <span class="text-muted">
                            <?php
                            if (!empty($config->bussinessCity))
                                echo $config->bussinessCity . ', ';
                            if (!empty($config->bussinessState))
                                echo $config->bussinessState . ', ';
                            if (!empty($config->bussinessPostalCode))
                                echo $config->bussinessPostalCode . ', ';
                            if (!empty($config->bussinessCountry))
                                echo $config->bussinessCountry;
                            ?>
                        </span>
                    </div>
                    <!-- Copy Right-->
                    <div class="row">
                        <div class="col-12 text-center mt-5">
                            <a target="_blank" href="https://axleyherrera.com/">2023© Axley Herrera Vázquez</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-9 ">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card card-custom wave wave-animate-slow wave-primary mb-lg-0">
                        <div class="card-header align-items-center border-0">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="font-weight-bolder text-dark">Horarios</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if ($config->monday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Lunes</h5>
                                        <?php if (!empty($config->monday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->monday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->monday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->monday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->monday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->monday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->monday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->monday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->tuesday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Martes</h5>
                                        <?php if (!empty($config->tuesday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->tuesday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->tuesday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->tuesday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->tuesday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->tuesday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->tuesday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->tuesday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->wednesday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Miércoles</h5>
                                        <?php if (!empty($config->wednesday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->wednesday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->wednesday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->wednesday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->wednesday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->wednesday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->wednesday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->wednesday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->thursday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Jueves</h5>
                                        <?php if (!empty($config->thursday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->thursday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->thursday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->thursday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->thursday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->thursday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->thursday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->thursday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->friday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Viernes</h5>
                                        <?php if (!empty($config->friday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->friday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->friday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->friday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->friday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->friday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->friday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->friday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->saturday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Sábado</h5>
                                        <?php if (!empty($config->saturday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->saturday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->saturday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->saturday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->saturday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->saturday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->saturday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->saturday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if ($config->sunday == 1) : ?>
                                    <div class="col-6 col-md-4 col-lg-3 mt-5">
                                        <h5>Domingo</h5>
                                        <?php if (!empty($config->sunday_start1)) : ?>
                                            <?php echo date("h:i A", strtotime($config->sunday_start1)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->sunday_end1)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->sunday_end1)); ?>
                                        <?php endif ?>
                                        <br>
                                        <?php if (!empty($config->sunday_start2)) : ?>
                                            <?php echo date("h:i A", strtotime($config->sunday_start2)); ?>
                                        <?php endif ?>
                                        <?php if (!empty($config->sunday_end2)) : ?>
                                            - <?php echo date("h:i A", strtotime($config->sunday_end2)); ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="card card-custom wave wave-animate-slow wave-primary">
                        <div class="card-header align-items-center border-0">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="font-weight-bolder text-dark">Servicios</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($services as $service) : ?>
                                    <div class="col-12 col-md-3 col-lg-4 mt-5">
                                        <div class="d-flex align-items-center">
                                            <span class="bullet bullet-bar bg-success align-self-stretch"></span>
                                            <a data-id="<?php echo $service->id; ?>" href="#" class="service text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                                                <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
                                                    <input type="checkbox" name="select" value="1" checked disabled>
                                                    <span></span>
                                                </label>
                                            </a>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a data-id="<?php echo $service->id; ?>" href="#" class="service text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1"><?php echo $service->title; ?></a>
                                                <span class="text-muted font-weight-bold">
                                                    <?php
                                                    if (!empty($service->price))
                                                        echo '€' . number_format($service->price, 2, ".", ',');
                                                    else
                                                        echo 'Gratis';
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#open-maps').on('click', function(e) {
        e.preventDefault();
        let address = "<?php echo $config->bussinessAddress; ?><?php if (!empty($config->bussinessAddress2)) : ?> , <?php echo $config->bussinessAddress2;
                                                                                                                endif ?><?php echo $config->bussinessCity . ', ' . $config->bussinessState . ', ' . $config->bussinessPostalCode . ', ' . $config->bussinessCountry; ?>";
        let encodedAddress = encodeURIComponent(address);
        let mapUrl = "https://www.google.com/maps/search/?api=1&query=" + encodedAddress;
        window.open(mapUrl, '_blank');
    });

    $('.service').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Home/showServiceDescription'); ?>",
            data: {
                'id': id
            },
            dataType: "html",
            success: function(response) {
                $('#main-modal').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    });
</script>