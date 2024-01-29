<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title"><?php echo $modalTitle; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <label for="txt-title">Título</label>
                    <input type="text" id="txt-title" class="required-service form-control" value="<?php echo @$service->title; ?>" />
                </div>
                <div class="col-3 mt-5">
                    <label for="txt-price">Precio</label>
                    <input type="text" id="txt-price" class="required-service form-control" value="<?php if (!empty($service->price)) echo  number_format($service->price, 2, ".", ','); ?>" />
                </div>
                <div class="col-12 mt-5">
                    <label for="txt-description">Descripción</label>
                    <textarea id="txt-description" class="form-control" rows="3"><?php echo @$service->description; ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-saveService" type="button" class="btn btn-primary">Guardar</button>
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

        $('#btn-saveService').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                $('#btn-saveService').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/manageService'); ?>",
                    data: {
                        'title': $('#txt-title').val(),
                        'price': $('#txt-price').val(),
                        'description': $('#txt-description').val(),
                        'action': '<?php echo $action; ?>',
                        'id': '<?php echo @$id; ?>'
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                getServices();
                                if ('<?php echo $action; ?>' == 'create')
                                    showAlert('success', 'Perfecto', 'Servicio creado');
                                else
                                    showAlert('success', 'Perfecto', 'Servicio actualizado');
                                $('#modal').modal('hide');
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
        });

        function checkRequiredValues() {
            let response = 0;
            let value = '';

            $('.required-service').each(function() {
                value = $(this).val();
                if (value == '') {
                    $(this).addClass('is-invalid');
                    response = 1
                }
            });

            return response;
        }

        $('.required-service').on('focus', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>