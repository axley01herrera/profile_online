<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12 col-md-3 col-lg-3 ">
            <div class="card card-custom mt-5">
                <div class="card-body pt-4">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="navi navi-hover py-5">
                                    <li class="navi-item">
                                        <a href="#" class="navi-link change-password">
                                            <span class="navi-icon">
                                                <i class="flaticon-cogwheel-2"></i>
                                            </span>
                                            <span class="navi-text">Cambiar mi Contraseña</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a id="delete-profile" href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-trash"></i>
                                            </span>
                                            <span class="navi-text">Eliminar mi Perfil</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            <div class="symbol-label" style="background-image:url('<?php echo base_url('public/assets/media/users/default.jpg'); ?>')"></div>
                            <i class="symbol-badge bg-success"></i>
                        </div>
                        <div>
                            <a href="#" class="edit-customer-profile font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $customer->name; ?></a>
                            <div class="mt-2">
                                <a href="<?php echo base_url('Home'); ?>" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Salir</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">Para reservar una cita, presione en el calendario encima de la fecha deseada.</div>
                    <div class="mt-5">Le ruego cancele su cita si usted no puede asistir por algún motivo, o la reservó por equivocación, Gracias.</div>
                    <div class="col-12 text-center mt-5">
                        <a href="#" class="edit-customer-profile btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Editar Perfil</a>
                    </div>
                </div>
            </div>
            <div class="card card-custom mt-5 mb-lg-5">
                <div class="card-body pt-4">
                    <h5>Próximas Citas</h5>
                    <div id="main-customer-appointments"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 col-lg-9 mt-5">
            <div id="main-calendar"></div>
        </div>
    </div>
</div>

<script>
    var initialDate = '<?php echo $initialDate; ?>';
    var initialView = 'dayGridMonth';

    getCalendar(initialDate);
    getCustomerAppointments();

    function getCalendar(date) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/calendar'); ?>",
            data: {
                'date': date
            },
            dataType: "html",
            success: function(response) {
                $('#main-calendar').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    }

    function getCustomerAppointments() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/getMainCustomerAppointments') ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#main-customer-appointments').html(response);
            }
        });
    }

    $(document).ready(function() {
        $('#btn-newAppointment').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/createAppointment'); ?>",
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

        $('.change-password').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/changePassword'); ?>",
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

        $('.edit-customer-profile').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/editProfile'); ?>",
                data: {
                    'customerID': '<?php echo $customer->id; ?>'
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

        $('#delete-profile').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estás Seguro',
                text: "Esta acción no es reversible y se borran todos su datos",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar',
                customClass: {
                    confirmButton: 'delete'
                }
            });

            $('.delete').on('click', function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Customer/deleteProfile'); ?>",
                    data: "",
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            window.location.href = "<?php echo base_url('Home/index?sessionExpired=true'); ?>";
                        } else
                            showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                    },
                    error: function(error) {
                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                    }
                });

            });
        });
    });
</script>