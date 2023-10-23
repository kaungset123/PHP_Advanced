<?php $__env->startSection('title','Home page'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .pagination>li {
        padding: 5px 15px;
        background: black;
        color: white;
        margin-right: 2px;
    }
</style>
    <div class="container my-4">
        <h1 class="text-center my-5">Popular Items</h1>
        <div class="row">
            <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card mb-3" >
                        <div class="card-header text-center"><?php echo e($fav->name); ?></div>
                        <div class="card-block"><img src="<?php echo e($fav->image); ?>" class="img-fluid"></div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-white btn-sm " href="<?php echo URL_ROOT . "product/$fav->id/detail"?>">
                                    <i class="fa fa-eye" aria-hidden="true" style="font-size:15px;"></i>
                                </a>
                                <span><?php echo e($fav->price); ?>$</span>
                                <button class="btn btn-white btn-sm ">
                                    <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;" onclick="addToCart('<?php echo e($fav->id); ?>')"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="container my-4">
        <h1 class="text-center my-5">All Product</h1>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card mb-3" >
                        <div class="card-header text-center"><?php echo e($product->name); ?></div>
                        <div class="card-block"><img src="<?php echo e($product->image); ?>" class="img-fluid"></div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-white btn-sm " href="<?php echo URL_ROOT . "product/$product->id/detail"?>">
                                    <i class="fa fa-eye" aria-hidden="true" style="font-size:15px;"></i>
                                </a>
                                <span><?php echo e($product->price); ?>$</span>
                                <button class="btn btn-white btn-sm ">
                                    <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;" onclick="addToCart('<?php echo e($product->id); ?>')"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="mt-4 offset-md-4">
        <?php echo $pages; ?>

    </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>