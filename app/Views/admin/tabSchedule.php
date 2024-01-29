<div class="tab-pane show" id="schedule" role="tabpanel">
    <div class="alert alert-custom alert-success mt-1" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Configure su horario. Puede utilizar el switch para asignar si un día es laborable o no. El sistema está diseñado para que pueda crear un horario de turno corrido o un horario de tuno partido configurable para cada día de la semana. Si usted quiere configurar turno corrido solo debe rellenar la información del primer turno, si, por el contrario, desea configurar un turno partido debe rellenar además el segundo turno.</div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <label for="txt-timeOff">Intervalo entre citas</label>
                    <input type="text" id="txt-timeOff" class="form-control" value="<?php echo $config->timeOff; ?>" />
                    <div class="col-12 mt-2 text-center">
                        <button id="save-timeOff" type="button" class="btn btn-primary font-weight-bold">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Monday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Lunes</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->monday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->monday == 1) echo "checked"; ?> data-field="monday" data-value="<?php echo $config->monday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-monday_start1">Hora de Inicio</label>
                                    <input type="text" id="txt-monday_start1" class="form-control timepicker" value="<?php if (!empty($config->monday_start1)) echo date('H:i', strtotime($config->monday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-monday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-monday_end1" class="form-control timepicker" value="<?php if (!empty($config->monday_end1)) echo date('H:i', strtotime($config->monday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-monday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-monday_start2" class="form-control timepicker" value="<?php if (!empty($config->monday_start2)) echo date('H:i', strtotime($config->monday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-monday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-monday_end2" class="form-control timepicker" value="<?php if (!empty($config->monday_end2)) echo date('H:i', strtotime($config->monday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-monday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Lunes</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Tuesday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Martes</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->tuesday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->tuesday == 1) echo "checked"; ?> data-field="tuesday" data-value="<?php echo $config->tuesday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-tuesday">Hora de Inicio</label>
                                    <input type="text" id="txt-tuesday_start1" class="form-control timepicker" value="<?php if (!empty($config->tuesday_start1)) echo date('H:i', strtotime($config->tuesday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-tuesday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-tuesday_end1" class="form-control timepicker" value="<?php if (!empty($config->tuesday_end1)) echo date('H:i', strtotime($config->tuesday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-tuesday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-tuesday_start2" class="form-control timepicker" value="<?php if (!empty($config->tuesday_start2)) echo date('H:i', strtotime($config->tuesday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-tuesday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-tuesday_end2" class="form-control timepicker" value="<?php if (!empty($config->tuesday_end2)) echo date('H:i', strtotime($config->tuesday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-tuesday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Martes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wednesday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Miércoles</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->wednesday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->wednesday == 1) echo "checked"; ?> data-field="wednesday" data-value="<?php echo $config->wednesday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-wednesday">Hora de Inicio</label>
                                    <input type="text" id="txt-wednesday_start1" class="form-control timepicker" value="<?php if (!empty($config->wednesday_start1)) echo date('H:i', strtotime($config->wednesday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-wednesday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-wednesday_end1" class="form-control timepicker" value="<?php if (!empty($config->wednesday_end1)) echo date('H:i', strtotime($config->wednesday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-wednesday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-wednesday_start2" class="form-control timepicker" value="<?php if (!empty($config->wednesday_start2)) echo date('H:i', strtotime($config->wednesday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-wednesday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-wednesday_end2" class="form-control timepicker" value="<?php if (!empty($config->wednesday_end2)) echo date('H:i', strtotime($config->wednesday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-wednesday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Miércoles</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thursday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Jueves</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->thursday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->thursday == 1) echo "checked"; ?> data-field="thursday" data-value="<?php echo $config->thursday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-thursday">Hora de Inicio</label>
                                    <input type="text" id="txt-thursday_start1" class="form-control timepicker" value="<?php if (!empty($config->thursday_start1)) echo date('H:i', strtotime($config->thursday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-thursday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-thursday_end1" class="form-control timepicker" value="<?php if (!empty($config->thursday_end1)) echo date('H:i', strtotime($config->thursday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-thursday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-thursday_start2" class="form-control timepicker" value="<?php if (!empty($config->thursday_start2)) echo date('H:i', strtotime($config->thursday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-thursday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-thursday_end2" class="form-control timepicker" value="<?php if (!empty($config->thursday_end2)) echo date('H:i', strtotime($config->thursday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-thursday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Jueves</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Friday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Viernes</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->friday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->friday == 1) echo "checked"; ?> data-field="friday" data-value="<?php echo $config->friday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-friday">Hora de Inicio</label>
                                    <input type="text" id="txt-friday_start1" class="form-control timepicker" value="<?php if (!empty($config->friday_start1)) echo date('H:i', strtotime($config->friday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-friday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-friday_end1" class="form-control timepicker" value="<?php if (!empty($config->friday_end1)) echo date('H:i', strtotime($config->friday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-friday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-friday_start2" class="form-control timepicker" value="<?php if (!empty($config->friday_start2)) echo date('H:i', strtotime($config->friday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-friday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-friday_end2" class="form-control timepicker" value="<?php if (!empty($config->friday_end2)) echo date('H:i', strtotime($config->friday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-friday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Viernes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Saturday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Sábado</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->saturday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->saturday == 1) echo "checked"; ?> data-field="saturday" data-value="<?php echo $config->saturday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-saturday">Hora de Inicio</label>
                                    <input type="text" id="txt-saturday_start1" class="form-control timepicker" value="<?php if (!empty($config->saturday_start1)) echo date('H:i', strtotime($config->saturday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-saturday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-saturday_end1" class="form-control timepicker" value="<?php if (!empty($config->saturday_end1)) echo date('H:i', strtotime($config->saturday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-saturday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-saturday_start2" class="form-control timepicker" value="<?php if (!empty($config->saturday_start2)) echo date('H:i', strtotime($config->saturday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-saturday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-saturday_end2" class="form-control timepicker" value="<?php if (!empty($config->saturday_end2)) echo date('H:i', strtotime($config->saturday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-saturday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Sábado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sunday -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h5>Domingo</h5>
                    <div class="row">
                        <div class="col-12 text-end">
                            <?php
                            $label = '';
                            $disabled = '';
                            if ($config->sunday == 1) {
                                $label = 'Laborable';
                            } else {
                                $label = 'No Laborable';
                                $disabled = 'disabled';
                            }
                            ?>
                            <span class="switch switch-outline switch-icon switch-primary">
                                <label>
                                    <input class="cbx-bussinessDay" type="checkbox" <?php if ($config->sunday == 1) echo "checked"; ?> data-field="sunday" data-value="<?php echo $config->sunday; ?>" />
                                    <span></span>
                                </label> <span><?php echo $label; ?></span>
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-success p-2">Primer Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-sunday">Hora de Inicio</label>
                                    <input type="text" id="txt-sunday_start1" class="form-control timepicker" value="<?php if (!empty($config->sunday_start1)) echo date('H:i', strtotime($config->sunday_start1)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-sunday_end1">Hora de Finalización</label>
                                    <input type="text" id="txt-sunday_end1" class="form-control timepicker" value="<?php if (!empty($config->sunday_end1)) echo date('H:i', strtotime($config->sunday_end1)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mt-5">
                            <h6 class="bg-primary p-2">Segundo Turno</h6>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <label for="txt-sunday_start2">Hora de Inicio</label>
                                    <input type="text" id="txt-sunday_start2" class="form-control timepicker" value="<?php if (!empty($config->sunday_start2)) echo date('H:i', strtotime($config->sunday_start2)); ?>" <?php echo $disabled; ?> />
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="txt-sunday_end2">Hora de Finalización</label>
                                    <input type="text" id="txt-sunday_end2" class="form-control timepicker" value="<?php if (!empty($config->sunday_end2)) echo date('H:i', strtotime($config->sunday_end2)); ?>" <?php echo $disabled; ?> />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button id="schedule-sunday" type="button" class="btn btn-primary font-weight-bold" <?php echo $disabled; ?>>Guardar Horario del Domingo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.timepicker').timepicker({});

        $('#save-timeOff').on('click', function() {
            let timeOff = $('#txt-timeOff').val();
            if (timeOff != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/updateScheduleBussinessDay') ?>",
                    data: {
                        'field': 'timeOff',
                        'value': timeOff
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Tiempo entre turnos actualizado');
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
            } else
                $('#txt-timeOff').addClass('is-invalid');
        });

        $('#txt-timeOff').on('focus', function() {
            $(this).removeClass('is-invalid');
        });

        $('.cbx-bussinessDay').on('click', function() {
            let field = $(this).attr('data-field');
            let value = $(this).attr('data-value');
            let newValue = '';
            let msg = '';

            if (value == 0) {
                newValue = 1;
                msg = 'Día laborable';
                $('#schedule-' + field).removeAttr('disabled');
                $('#txt-' + field + '_start1').removeAttr('disabled');
                $('#txt-' + field + '_end1').removeAttr('disabled');
                $('#txt-' + field + '_start2').removeAttr('disabled');
                $('#txt-' + field + '_end2').removeAttr('disabled');
            } else if (value == 1) {
                newValue = 0;
                msg = 'Día no laborable';
                $('#schedule-' + field).attr('disabled', true);
                $('#txt-' + field + '_start1').attr('disabled', true);
                $('#txt-' + field + '_end1').attr('disabled', true);
                $('#txt-' + field + '_start2').attr('disabled', true);
                $('#txt-' + field + '_end2').attr('disabled', true);
            }

            $(this).attr('data-value', newValue);

            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/updateScheduleBussinessDay') ?>",
                data: {
                    'field': field,
                    'value': newValue
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            showAlert('success', 'Perfecto', msg);
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

        $('#schedule-monday').on('click', function() {
            if ($('#txt-monday_start1').val() != '' && $('#txt-monday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'monday_start1',
                        'value1': $('#txt-monday_start1').val(),

                        'field2': 'monday_end1',
                        'value2': $('#txt-monday_end1').val(),

                        'field3': 'monday_start2',
                        'value3': $('#txt-monday_start2').val(),

                        'field4': 'monday_end2',
                        'value4': $('#txt-monday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horario del Lunes guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-tuesday').on('click', function() {
            if ($('#txt-tuesday_start1').val() != '' && $('#txt-tuesday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'tuesday_start1',
                        'value1': $('#txt-tuesday_start1').val(),

                        'field2': 'tuesday_end1',
                        'value2': $('#txt-tuesday_end1').val(),

                        'field3': 'tuesday_start2',
                        'value3': $('#txt-tuesday_start2').val(),

                        'field4': 'tuesday_end2',
                        'value4': $('#txt-tuesday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horarios del Martes guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-wednesday').on('click', function() {
            if ($('#txt-wednesday_start1').val() != '' && $('#txt-wednesday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'wednesday_start1',
                        'value1': $('#txt-wednesday_start1').val(),

                        'field2': 'wednesday_end1',
                        'value2': $('#txt-wednesday_end1').val(),

                        'field3': 'wednesday_start2',
                        'value3': $('#txt-wednesday_start2').val(),

                        'field4': 'wednesday_end2',
                        'value4': $('#txt-wednesday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horario del Miércoles guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-thursday').on('click', function() {
            if ($('#txt-thursday_start1').val() != '' && $('#txt-thursday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'thursday_start1',
                        'value1': $('#txt-thursday_start1').val(),

                        'field2': 'thursday_end1',
                        'value2': $('#txt-thursday_end1').val(),

                        'field3': 'thursday_start2',
                        'value3': $('#txt-thursday_start2').val(),

                        'field4': 'thursday_end2',
                        'value4': $('#txt-thursday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horario del Jueves guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-friday').on('click', function() {
            if ($('#txt-friday_start1').val() != '' && $('#txt-friday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'friday_start1',
                        'value1': $('#txt-friday_start1').val(),

                        'field2': 'friday_end1',
                        'value2': $('#txt-friday_end1').val(),

                        'field3': 'friday_start2',
                        'value3': $('#txt-friday_start2').val(),

                        'field4': 'friday_end2',
                        'value4': $('#txt-friday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horarios del Viernes guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-saturday').on('click', function() {
            if ($('#txt-saturday_start1').val() != '' && $('#txt-saturday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'saturday_start1',
                        'value1': $('#txt-saturday_start1').val(),

                        'field2': 'saturday_end1',
                        'value2': $('#txt-saturday_end1').val(),

                        'field3': 'saturday_start2',
                        'value3': $('#txt-saturday_start2').val(),

                        'field4': 'saturday_end2',
                        'value4': $('#txt-saturday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horario del Sábado guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });

        $('#schedule-sunday').on('click', function() {
            if ($('#txt-sunday_start1').val() != '' && $('#txt-sunday_end1').val() != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/setSchedule'); ?>",
                    data: {
                        'field1': 'sunday_start1',
                        'value1': $('#txt-sunday_start1').val(),

                        'field2': 'sunday_end1',
                        'value2': $('#txt-sunday_end1').val(),

                        'field3': 'sunday_start2',
                        'value3': $('#txt-sunday_start2').val(),

                        'field4': 'sunday_end2',
                        'value4': $('#txt-sunday_end2').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                showAlert('success', 'Perfecto', 'Horario del Domingo guardado');
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
            } else
                showAlert('warning', 'Lo Sentimos', 'El primer turno es obligatorio');
        });
    });
</script>