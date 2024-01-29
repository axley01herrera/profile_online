
<script>
    var initialDate = '<?php echo $initialDate; ?>';
    var initialView = 'dayGridMonth';
    getCalendar(initialDate);
    function getCalendar(date) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/calendar'); ?>",
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
</script>