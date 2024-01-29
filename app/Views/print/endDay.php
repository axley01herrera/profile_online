<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $companyName; ?></title>
    <meta name="Manejo de Reserva de Citas" content="Profile" />
    <meta content="Axley Herrera" name="author" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- App Icon -->
    <link href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" rel="shortcut icon" />
</head>
<body>
    <div align="center">
        <h3>Cierre de Caja</h3>
        <p><?php echo $dateTime; ?></p>
        <table>
            <?php foreach($tickets as $t) : ?>
                <tr>
                    <td><?php echo $t['index']; ?></td>
                    <td><?php echo $t['payType']; ?></td>
                    <td>€<?php echo $t['amount']; ?></td>
                </tr>
            <?php endforeach ?>
        </table>
        <p><strong>Recaudación Total:</strong> €<?php echo $total; ?></p>
        <p><strong>Total de Tickets:</strong> <?php echo $totalTickets; ?></p>
        <p>
            <?php echo $bussinessAddress; ?>,
            <?php echo $bussinessAddress2; ?>
            <br>
            <?php echo $bussinessCity; ?>, <?php echo $bussinessState; ?>
            <br>
            <?php echo $bussinessPostalCode; ?>, <?php echo $bussinessCountry; ?>
        </p>
        <p>C . I . F : <?php echo $cif; ?></p>
    </div>
</body>
</html>
<script>
    window.print();
</script>