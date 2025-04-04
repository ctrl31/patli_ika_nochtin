<!DOCTYPE html>
<html>
<head>
    <title><?php echo $__env->yieldContent('title'); ?>

    </title>

  <!--css -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">

 
    <!-- Aquí pueden ir tus enlaces a hojas de estilo -->
</head>
<body>
    
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!-- Contenido principal -->
     <?php echo $__env->yieldContent('content'); ?>


     <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    <!-- Scripts comunes -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <!-- Espacio para scripts específicos de vistas -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\YaYaG\Desktop\patli\patli\resources\views/layouts/app.blade.php ENDPATH**/ ?>