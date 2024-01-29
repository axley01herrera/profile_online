<div class="row">
    <?php $total = 0; foreach ($basket as $bask) :  $total = $total + $bask->amount;?>
        <div class="col-12 mt-2 bg-light-dark" style="border-radius: 0.42rem;">
            <span class="font-size-h5"><?php echo $bask->title; ?></span>
            <span class="ml-1 mr-1 font-size-h5 float-right"><a href="#" class="del-service" data-id="<?php echo $bask->id; ?>"><i class="flaticon2-trash text-danger"></i></a></span>
            <span class="ml-1 mr-1 font-size-h5 float-right"><?php echo '€' . number_format($bask->amount, 2, ".", ','); ?></span>
        </div>
    <?php endforeach ?>
</div>
<div class="row">
    <div class="col-12 mt-2 text-right">
        <span class="font-size-h3 font-weight-boldest text-right">Total: <?php echo '€' . number_format($total, 2, ".", ','); ?></span>
        <br>
        <button id="btn-charge" class="btn btn-sm btn-primary">Cobrar</button>
    </div>
</div>

<script>
    $('.del-service').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/removeServiceFromBasket'); ?>",
            data: {
                'id': $(this).attr('data-id')
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

    $('#btn-charge').on('click', function () {
        let total = Number(<?php echo $total; ?>);
        if (total > 0) {
            $('#btn-charge').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/modalPayType'); ?>",
                data: {
                    'basketID': basketID
                },
                dataType: "html",
                success: function(response) {
                    $('#main-modal').html(response);
                    $('#btn-charge').removeAttr('disabled');
                },
                error: function(error) {
                    showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                }
            });
        } else
            showAlert('warning', 'Lo Sentimos', 'Añada servicios al ticket');
    });
</script>