<div class="row mt-2">
    <div class="col-12 text-right">
        <button id="print-day-end" class="btn btn-danger">Imprimir Cierre del Día</button>
    </div>
</div>
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 ">
                <h5>Servicios</h5>
                <div class="row">
                    <?php 
                        foreach ($services as $service) : 

                    ?>
                        <div class="col-12 col-lg-4 mt-5">
                            <div class="card card-custom card-shadowless">
                                <div class="card-body">
                                    <div class="overlay">
                                        <div class="overlay-wrapper rounded bg-light text-center">
                                            <img src="<?php echo 'data:image/png;base64,' . base64_encode($config->avatar); ?>" alt="img" class="w-50 w-50px">
                                        </div>
                                    </div>
                                    <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column" >
                                        <span class="font-size-h5 font-weight-bolder text-dark-75 mb-1"><?php echo $service->title; ?></span>
                                        <span class="font-size-lg"><?php echo '€' . number_format($service->price, 2, ".", ','); ?></span>
                                        <button data-id="<?php echo $service->id; ?>" class="btn btn-sm btn-primary add-product">Añadir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <h5>Ticket</h5>
                <div id="main-basket"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var basketID = "<?php echo $basketID; ?>";
    dtBasket();

    function dtBasket() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/dtBasket') ?>",
            data: {
                'basketID': basketID
            },
            dataType: "html",
            success: function(response) {
                $('#main-basket').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    }

    $('.add-product').on('click', function() {
        let serviceID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/addServiceToBasket'); ?>",
            data: {
                'basketID': basketID,
                'serviceID': serviceID
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        dtBasket();
                        break;
                    case 1:
                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                        break;
                }
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    });

    $('#print-day-end').on('click', function () {
        window.open('<?php echo base_url('Admin/printDayEnd');?>', '_blank');
    });
</script>