<!DOCTYPE html>
<html>
    <head>
        <title>404 Not Found.</title>
        <link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/components/icon.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/components/button.min.css')); ?>">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            p {
                font-size: 1.4em;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"><i class="icon warning"></i>404 Konten Tidak Ditemukan</div>
                <p>Maaf content ini tidak tersedia. Silahkan klik button Kembali untuk kembali ke Halaman Muka</p>
                <a class="ui button primary" href="<?php echo e(url('/')); ?>">Kembali</a>
            </div>
        </div>
    </body>
</html>
