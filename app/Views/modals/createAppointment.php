<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Nueva Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h5 class="text-dark"><i class="flaticon-calendar-with-a-clock-time-tools"></i> <?php echo $dateFormat; ?></h5>
                </div>
                <div class="row">
                    <?php if (!empty($customers)) : ?>
                        <div class="col-12 mt-5">
                            <label for="sel-customer">Seleccione un Cliente (Obligatorio)</label>
                            <select id="sel-customer" class="form-control">
                                <option value="" hidden></option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?> <?php echo $customer->lastName; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endif ?>
                    <div class="col-12 mt-5">
                        <label for="sel-service">Seleccione un Servicio (Opcional)</label>
                        <select id="sel-service" class="form-control">
                            <option value="" hidden></option>
                            <?php foreach ($services as $service) : ?>
                                <option value="<?php echo $service->id; ?>"><?php echo $service->title; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div id="main-appointment" class="mt-5"></div>
                <div class="row mt-5">
                    <div class="col-12">
                        <label for="txt-description">Descripción (Opcional)</label>
                        <textarea id="txt-description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="alert alert-custom alert-light-warning fade show mt-5" role="alert">
                    <div class="alert-text text-dark">Importante rectifique que la fecha seleccionada es la deseada! <span class="small text-dark"><?php echo $dateFormat; ?></span> </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-create" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    var dateSelected = '<?php echo $dateSelected; ?>';
    var timeSelected = '';
    $(document).ready(function() {
        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#main-modal').html('');
        });

        $('#btn-create').on('click', function() {
            if (dateSelected != '' && timeSelected != '') {

                let execute = 1;
                let customerID = '';
                <?php if (!empty($customers)) : ?>
                    customerID = $('#sel-customer').val();
                    if (customerID == '') {
                        execute = 0;
                        $('#sel-customer').addClass('is-invalid');
                        showAlert('warning', 'Importante', 'Debe seleccionar un cliente');
                    }
                <?php endif ?>

                if (execute == 1) {
                    $('#btn-create').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/createAppointmentProcess'); ?>",
                        data: {
                            'date': dateSelected,
                            'time': timeSelected,
                            'service': $('#sel-service').val(),
                            'description': $('#txt-description').val(),
                            'customerID': customerID,
                            'dateFormated': '<?php echo $dateFormat; ?>'
                        },
                        dataType: "json",
                        success: function(response) {
                            switch (response.error) {
                                case 0:
                                    showAlert('success', 'Perfecto', 'Su cita ha sido reservada satisfactoriamente');
                                    $('#modal').modal('hide');
                                    getCalendar(initialDate);
                                    <?php if (empty($admin)) : ?>
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
                }
            } else
                showAlert('warning', 'Importante', 'Debe seleccionar una cita disponible');
        });

        if (dateSelected != '') {
            getAppointments();
        }

        function getAppointments() {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Customer/getFreeAppointments'); ?>",
                data: {
                    'date': dateSelected
                },
                dataType: "html",
                success: function(response) {
                    $('#main-appointment').html(response);
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
        }

        $('#sel-customer').on('change', function() {
            $(this).removeClass('is-invalid');

        });
    });
</script>