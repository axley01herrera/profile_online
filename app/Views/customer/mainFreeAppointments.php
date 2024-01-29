<?php
# Get Day Off Week
$timestamp = strtotime($date);
$dayWeek = strtolower(date("l", $timestamp));

if ($config->$dayWeek == 1) { // Validate Bussines Day

    # Shift 1
    $startIndex1 = $dayWeek . '_start1';
    $start1 = $config->$startIndex1;
    $endIndex1 = $dayWeek . '_end1';
    $end1 = $config->$endIndex1;

    # Shift 2
    $startIndex2 = $dayWeek . '_start2';
    $start2 = $config->$startIndex2;
    $endIndex2 = $dayWeek . '_end2';
    $end2 = $config->$endIndex2;

    # Time Off
    $timeOff = $config->timeOff * 60;
?>
    <div class="row">
        <?php if (!empty($start1)) : ?>
            <div class="col-12">
                <h5>Primer Turno</h5>
                <div class="row mt-5">
                    <?php
                    while (strtotime($start1) < strtotime($end1)) {
                        $disabled = "";
                        $disabledInput = "";
                        foreach ($appointments as $appointment) {
                            if (date("H:i:s", strtotime($start1)) == $appointment->time){
                                $disabled = 'radio-disabled';
                                $disabledInput = 'disabled';
                            }
                        }

                        $currentDateTieme = date('Y-m-d H:i:s');
                        $dateTime = $date.' '.$start1; 

                        if(strtotime($dateTime) <= strtotime($currentDateTieme)) {
                            $disabled = 'radio-disabled';
                            $disabledInput = 'disabled';
                        }
                    ?>
                        <div class="col-4 mb-1 ">
                            <div class="radio-inline">
                                <label class="radio radio-outline radio-outline-2x radio-primary <?php echo $disabled; ?>">
                                    <input <?php echo $disabledInput; ?> class="radio-sel" type="radio" name="radios16" value="<?php echo date("H:i", strtotime($start1)); ?>">
                                    <span></span><?php echo date("g:i a", strtotime($start1)); ?></label>
                            </div>
                        </div>
                    <?php
                        $start1 = date("H:i", strtotime($start1) + $timeOff);
                    }
                    ?>
                </div>
            </div>
        <?php endif ?>

        <?php if (!empty($start2)) : ?>
            <div class="col-12 mt-5">
                <h5>Segundo Turno</h5>
                <div class="row mt-5">
                    <?php
                    while (strtotime($start2) < strtotime($end2)) {
                        $disabled = "";
                        $disabledInput = "";
                        foreach ($appointments as $appointment) {
                            if (date("H:i:s", strtotime($start2)) == $appointment->time) {
                                $disabled = 'radio-disabled';
                                $disabledInput = 'disabled';
                            }
                        }

                        $currentDateTieme = date('Y-m-d H:i:s');
                        $dateTime = $date.' '.$start2; 

                        if(strtotime($dateTime) <= strtotime($currentDateTieme)) {
                            $disabled = 'radio-disabled';
                            $disabledInput = 'disabled';
                        }
                    ?>
                        <div class="col-4 mb-1 ">
                            <div class="radio-inline">
                                <label class="radio radio-outline radio-outline-2x radio-primary <?php echo $disabled; ?>">
                                    <input <?php echo $disabledInput; ?> class="radio-sel" type="radio" name="radios16" value="<?php echo date("H:i", strtotime($start2)); ?>">
                                    <span></span><?php echo date("g:i a", strtotime($start2)); ?></label>
                            </div>
                        </div>
                    <?php
                        $start2 = date("H:i", strtotime($start2) + $timeOff);
                    }
                    ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    </div>

<?php
} else {
?>
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Lo siento pero no tengo citas disponibles para la fecha seleccionada!</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php
}
?>

<script>
    $(document).ready(function() {
        $('.radio-sel').on('click', function() {
            timeSelected = $(this).val();
        });
    });
</script>