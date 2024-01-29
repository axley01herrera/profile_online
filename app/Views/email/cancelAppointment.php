<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $companyName; ?></title>
</head>

<body style="margin:0px; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <div style="padding: 10px 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <h1><strong><?php echo $companyName; ?></strong></h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <h5>Cancelada la reserva de <?php echo $customer->name . ' ' . $customer->lastName; ?></h5>
                                <p><?php echo $date; ?></p>
                                <?php if (!empty($service)) : ?>
                                    <p>
                                        Servicio: <?php echo $service; ?>
                                    </p>
                                <?php endif ?>
                                <?php if (!empty($description)) : ?>
                                    <p>
                                        Descripción: <?php echo $description; ?>
                                    </p>
                                <?php endif ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <h5>Datos de Contacto</h5>
                                <p>
                                    Correo electrónico: <?php echo $customer->email; ?>
                                </p>
                                <?php if (!empty($customer->phone)) : ?>
                                    <p>
                                        Teléfono: <?php echo $customer->phone; ?>
                                    </p>
                                <?php endif ?>
                                <?php if (!empty($note)) : ?>
                                    <p>
                                        Nota: <?php echo $note; ?>
                                    </p>
                                <?php endif ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <p>© <?php echo $companyName; ?></p>
            </div>
        </div>
    </div>
</body>

</html>