<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $companyName; ?></title>
    <meta name="Manejo de Reserva de Citas" content="Profile" />
    <meta content="Axley Herrera" name="author" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- App Icon -->
    <link href="<?php echo base_url('public/assetsv2/media/logos/favicon.ico'); ?>" rel="shortcut icon" />
</head>
<body>
    <div align="center">
        <h1><?php echo $companyName; ?></h1>
        <p>
            Fecha: <?php echo $date; ?>
            <br>
            Tipo de Pago: <?php echo $payType; ?>
        </p>
        <table style="border: none;">
            <?php foreach ($tiketInfo as $ticket) : ?>
                <tr>
                    <td>
                        <?php echo $ticket['title']; ?>:
                    </td>
                    <td>
                        €<?php echo $ticket['Precio']; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <p><strong>Total:</strong> €<?php echo $total; ?></p>
        <p>
            <?php echo $bussinessAddress; ?>,
            <?php echo $bussinessAddress2; ?>
            <br>
            <?php echo $bussinessCity; ?>, <?php echo $bussinessState; ?>
            <br>
            <?php echo $bussinessPostalCode; ?>, <?php echo $bussinessCountry; ?>
        </p>
        <p>C . I . F : <?php echo $cif; ?></p>
        <p><strong>Gracias por su Visita!</strong></p>
    </div>
</body>
</html>

<script>
    window.print();
</script>