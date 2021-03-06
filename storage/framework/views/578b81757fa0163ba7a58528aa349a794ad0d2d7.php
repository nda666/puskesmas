<!DOCTYPE html>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <!-- Site Properties -->
        <title>Login Example - Semantic</title>
        <link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>">
        <style type="text/css">
        body {
        background-color: #DADADA;
        }
        body > .grid {
        height: 100%;
        }
        .image {
        margin-top: -100px;
        }
        .column {
        max-width: 450px;
        }
        </style>
        <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"type="text/javascript" charset="utf-8"></script>
    
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>
        <script src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>" type="text/javascript" charset="utf-8"></script>
        <?php echo $__env->yieldContent('javascript'); ?>
        
    </body>
</html>