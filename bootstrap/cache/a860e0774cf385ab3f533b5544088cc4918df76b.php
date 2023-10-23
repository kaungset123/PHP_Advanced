<?php $__env->startSection("title","Product Home Page"); ?>

<?php $__env->startSection("content"); ?>
<style>
    .pagination>li {
        padding: 5px 15px;
        background: black;
        color: white;
        margin-right: 2px;
    }

    #edit_cat {
        cursor: pointer;
    }
</style>
        <div class="container">
            <div class="row">
                <div class="col-md-4 me-5" >
                    <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <?php use App\classes\Session;;?>
                <div class="col-md-6 mt-4">
                    <?php if(Session::has("product_insert_success")):?>                   
                        <?php echo Session::flash("product_insert_success");?>
                    <?php endif ;?>

                        <!-- product table start -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                   
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($product->id); ?></td>
                                        <td><img src="<?php echo e($product->image); ?>" width="70" height="70"></td>
                                        <td><?php echo e($product->name); ?></td>
                                        <th ><?php echo e($product->price); ?></th>
                                        <td>
                                            <a href="<?php echo URL_ROOT . "admin/product/$product->id/edit";?>"><i class="fa fa-pencil-square-o text-primary"></i></a>
                                            <a href="<?php echo URL_ROOT . "admin/product/$product->id/delete";?>"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                            </tbody>
                        </table>     
                        <div class="mt-4 offset-md-4">
                            <?php echo $pages; ?>

                        </div>  
                        <!-- product table end -->
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>