<?php
include('path.php');
$app = new AddApp('Home', 'StoreLad');
$app->mode();
include($app->controllers('users'));
?>

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Store Lad</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.ico">

        <!-- jvectormap -->
        <link href="<?php echo BASE_URL; ?>/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
        <!-- Bootstrap Css -->
        <link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo BASE_URL; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo BASE_URL; ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            #title{
                z-index: -10;
            }
        </style>

    </head>

        <?php 
            include($app->pager());
        ?>
        <!-- JAVASCRIPT -->
        <script src="<?php echo BASE_URL; ?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts js -->
        <script src="<?php echo BASE_URL; ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="<?php echo BASE_URL; ?>/assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/libs/jqvmap/maps/jquery.vmap.world.js"></script>

        <script src="<?php echo BASE_URL; ?>/assets/js/pages/dashboard.init.js"></script>

        <script>
            var BASE_URL = <?php echo BASE_URL; ?>
        </script>
        <script src="<?php echo BASE_URL; ?>/assets/js/app.js"></script>
        <script>
            title = $('#title').html();
            document.title= title + ' | <?php echo APP::APP_NAME; ?>'
        </script>

    </body>
</html>
