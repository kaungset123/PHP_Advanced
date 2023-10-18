<?php $__env->startSection("title","Product Create Page"); ?>

<?php $__env->startSection("content"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 " >
            <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-8" >
            <h2 class="mt-4 text-center ">Create Product</h2>
                <?php echo $__env->make("layout.report_message", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <form action="<?php
                use App\classes\CSRFToken;
                echo URL_ROOT . "admin/product/create";?>" method="post" enctype="multipart/form-data" style="background:#fd92da;" class="p-5">
                <div class="row">
                        <div class="col-md-6" >                  
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" style="box-shadow: 1px 2px 9px black;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="any" class="form-control" id="price" name="price" style="box-shadow: 1px 2px 9px black;">
                            </div>
                        </div>
                </div>     
                
                <div class="row mt-4">
                        <div class="col-md-6 ">                  
                            <div class="form-group">
                                <!-- <label for="name" class="form-label">Name</label> -->
                                <select class="form-control" name="cat_id" id="cat_ie" style="box-shadow: 1px 2px 9px black;">
                                    <?php foreach($cats as $cat):?>
                                        <option value="<?php echo $cat->id ;?>"><?php echo $cat->name ?></option>
                                    <?php endforeach ;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <!-- <label for="name" class="form-label">Price</label> -->
                                <select class="form-control" name="sub_cat_id" id="sub_cat_id" style="box-shadow: 1px 2px 9px black;">
                                    <?php foreach($sub_cats as $sub_cat):?>
                                        <option value="<?php echo $sub_cat->id ;?>"><?php echo $sub_cat->name ?></option>
                                    <?php endforeach ;?>
                                </select>
                            </div>
                        </div>
                </div>  

                <div class="form-group col-md-5 ">
                        <label for="file"></label>
                        <input type="file" class="form-control-file" id="file" name="file" style="box-shadow: 1px 2px 9px black;">
                </div>
                
                <div class="form-group mt-3">
                        <label for="description" class="mb-2">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="6" style="box-shadow: 1px 2px 9px black;"></textarea>
                </div>

                <input type="hidden" name="token" value="<?php CSRFToken::_token();?>">

                <div class="d-flex justify-content-end mt-3 ">
                        <button type="reset" class="btn btn-sm bg-danger me-4 text-white" style="box-shadow: 1px 2px 9px black;">
                            cancel
                        </button>
                        <button type="submit" class="btn btn-sm bg-primary text-white" style="box-shadow: 1px 2px 9px black;">submit</button>
                </div>
                </form>

           
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>