<?php $__env->startSection('title',"Admin Home"); ?>

<?php $__env->startSection('content'); ?>
    <h1>Welcome back Admin</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $__env->make('layout.admin_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-md-9">

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>