<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <meta name="Manejo de Reserva de Citas" content="Profile" />
    <meta content="Axley Herrera" name="author" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- App Icon -->
    <link href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" rel="shortcut icon" />

    <!-- Global CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/plugins/custom/prismjs/prismjs.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/assets/datatable/dataTables.bootstrap5.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/assets/timepicker/timepicker.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/assets/apexcharts/dist/apexcharts.css'); ?>" />
    
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        table.dataTable td,
        table.dataTable th {
            vertical-align: middle;
        }
    </style>

    <!-- Global JS -->
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#0BB783",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#D7F9EF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/prismjs/prismjs.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/scripts.bundle.js'); ?>"></script>
    <script src='<?php echo base_url('public/assets/fullcalendar/dist/index.global.js'); ?>'></script>
    <script src='<?php echo base_url('public/assets/fullcalendar/packages/core/locales/es.global.js'); ?>'></script>
    <script src="<?php echo base_url('public/assets/datatable/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/datatable/dataTables.bootstrap5.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/timepicker/timepicker.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/apexcharts/dist/apexcharts.min.js'); ?>"></script>
</head>

<body style="background-color: #181c32;">
    <div id="main-modal"></div>
    <?php echo view($page); ?>
</body>

</html>
<script>
    let confirmation = '<?php echo @$confirmation; ?>';
    if (confirmation == 'true') {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Perfecto',
            text: 'Cuenta de Correo Electrónico Confirmada',
            showConfirmButton: true,
            timer: 5000
        });
    }

    let sessionExpired = '<?php echo @$sessionExpired; ?>';
    if (sessionExpired == 'true') {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Ops',
            text: 'Su sesión ha expirado',
            showConfirmButton: true,
            timer: 5000
        });
    }

    function showAlert(icon, title, text) {
        Swal.fire({
            position: 'center',
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: true,
            timer: 5000
        });
    }
</script>