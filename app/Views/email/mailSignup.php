<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $config->companyName; ?></title>
    <style>
        .btn {
            color: #f8f8f8 !important;
            background-color: #5fd0f3;
            border-color: #5fd0f3;
            width: 50% !important;
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            padding: .47rem .75rem;
            font-size: .9rem;
            border-radius: .25rem;
            text-decoration: none !important;
        }
    </style>
</head>
<body style="margin:0px; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <div style="padding: 10px 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <h1><strong><?php echo $config->companyName; ?></strong></h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    Este es un correo de confirmación para verificar que su dirección de correo electrónico es válida y que puede recibir notificaciones de la plataforma. Las notificaciones puede desactivarlas Editando su Perfil. Para que quede verificada su cuenta de correo electrónico presione el botón Confirmar mas abajo. Gracias!
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr align="center">
                            <td align="center">
                                <a class="btn" href="<?php echo @$url; ?>">Confirmar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <p>© <?php echo @$config->companyName; ?></p>
            </div>
        </div>
    </div>
</body>
</html>