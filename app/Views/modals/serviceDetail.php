<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Detalle del Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom mt-2">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon2-correct text-primary"></i>
                            </span>
                            <h3 class="card-label">
                                <?php echo $service->title; ?>
                                <small>
                                    <?php
                                    if (!empty($service->price))
                                        echo '€' . number_format($service->price, 2, ".", ',');
                                    else
                                        echo 'Gratis';
                                    ?>
                                </small>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($service->description)) : echo $service->description;
                        else : echo 'Servicio sin descripción';
                        endif ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#main-modal').html('');
        });
    });
</script>