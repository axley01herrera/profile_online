<?php if (empty($appointments)) : ?>
    <div class="alert alert-custom alert-light-warning fade show mt-5" role="alert">
        <div class="alert-text text-danger text-center">No existen próximas citas</div>
    </div>
    <?php else : foreach ($appointments as $appointment) : ?>
        <div class="mt-5 p-1 border">
            <span class="bullet bullet-bar bg-success align-self-stretch mr-5"></span>
            <div class="d-flex flex-column flex-grow-1">
                <span><?php echo $appointment['date']; ?></span>
                <span class="small text-muted font-weight-bold"><?php echo $appointment['time']; ?></span>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button class="cancel-my-appointment btn btn-sm btn-light-danger" data-id="<?php echo $appointment['id']; ?>">Cancelar</button>
                </div>
            </div>
        </div>
<?php endforeach;
endif ?>

<script>
    $('.cancel-my-appointment').on('click', function() {
        let appointmentID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/removeAppointment'); ?>",
            data: {
                'id': appointmentID,
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