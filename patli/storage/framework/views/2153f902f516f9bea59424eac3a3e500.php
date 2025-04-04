<?php $__env->startSection('content'); ?>

<?php echo $__env->make('home.banner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('home.health', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('home.news', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('home.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>



<script src="<?php echo e(asset('/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.bundle.js.map')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.bundle.min.js.map')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.js.map')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.min.js.map')); ?>"></script>
<script src="<?php echo e(asset('/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery-3.0.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.validate.js')); ?>"></script>
<script src="<?php echo e(asset('/js/plugin.js')); ?>"></script>
<script src="<?php echo e(asset('/js/popper.js')); ?>"></script>
<script src="<?php echo e(asset('/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/slider-setting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\YaYaG\Desktop\patli\patli\resources\views/home/homepage.blade.php ENDPATH**/ ?>