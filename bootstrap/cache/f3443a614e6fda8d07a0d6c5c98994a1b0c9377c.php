<?php $__env->startSection('title','Category Create'); ?>

<?php $__env->startSection('content'); ?>

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
    <!-- <img src="<?php echo e(asset('/images/coding.png')); ?>"> -->
    <div class="row">
        <!-- <?php if(isset($errors)): ?>
                <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>     -->
        <div class="col-md-3 me-5 mt-4">
            <?php echo $__env->make('layout.admin_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
        <div class="col-md-8 ms-3">
            <h1 class=" text-center mt-3 mb-2 " id="cat">Create Category</h1>
            <?php echo $__env->make('layout.report_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php

            use App\classes\Session;

            if (Session::has("delete_success")) :
            ?>
                <?php Session::flash("delete_success") ?>
            <?php endif; ?>

            <?php if (Session::has("delete_fail")) : ?>
                <?php Session::flash("delete_fail") ?>
            <?php endif; ?>

            <form action="<?php

                            use App\classes\CSRFToken;

                            echo URL_ROOT . "admin/category/create"; ?>" method="post" enctype="multipart/form-data" class="mb-5">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Category</label>
                    <input type="text" class="form-control" id="name cat_input" placeholder="category name.." name="name" style="box-shadow:-1px 4px 10px mediumpurple; padding:8px; border:none;">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <input type="hidden" name="token" value="<?php CSRFToken::_token() ?>">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm text-white pb-2" id="create_button" style="box-shadow: 1px 2px 7px black; border:none;padding-top:7px;">Create</button>
                </div>
            </form>

            <!-- category list start -->
            <ul id="side_bar" class="list-group ">
                <?php foreach ($cats as $cat) : ?>
                    <li class="list-group-item">
                        <a href="/admin/category/all" class="text-black"><?php echo $cat->name ?></a>
                        <span class="float-end">
                            <i class="fa fa-plus" aria-hidden="true" style="color:white;margin-right:5px;cursor:pointer;" onclick="showSubCate('<?php echo e($cat->name); ?>','<?php echo e($cat->id); ?>')"></i>
                            <i class="fa fa-pencil-square-o text-info" onclick="fun('<?php echo  $cat->name; ?>','<?php echo $cat->id; ?>')" id="edit_cat"></i>
                            <a href="<?php echo URL_ROOT . "admin/category/$cat->id/delete"; ?>"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="mt-4 offset-md-4">
                <?php echo $pages; ?>

            </div>
            <!-- category list end -->

            <!-- Subcategory list start -->
                <ul id="side_bar" class="list-group mt-5">
                    <?php foreach ($sub_cats as $cat) : ?>
                        <li class="list-group-item">
                            <a href="/admin/category/all" class="text-black"><?php echo $cat->name ?></a>
                            <span class="float-end">
                                <i class="fa fa-pencil-square-o text-info" onclick="subCatEditShow('<?php echo  $cat->name; ?>','<?php echo $cat->id; ?>')" id="edit_cat"></i>
                                <a href="<?php echo URL_ROOT . "admin/subcategory/$cat->id/delete"; ?>"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-4 offset-md-4">
                    <?php echo $sub_pages; ?>

                </div>
            <!-- Subcategory list end -->

        </div>
    </div>
</div>

<!-- category edit modal start -->
<div class="modal " id="CategoryEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <form class="p-4">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Category</label>
                    <input type="text" class="form-control" id="edit-name">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <input type="hidden" id="edit-token" value="<?php CSRFToken::_token() ?>">
                <input type="hidden" id="edit-id">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm text-white pb-2" id="create_button" onclick="startEdit(event)">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- category edit modal end -->

<!-- Sub_category modal start -->
<div class="modal " id="SubCategoryCreateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Sub Category Creation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <form class="p-4">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Parent Category</label>
                    <input type="text" class="form-control" id="pcat-name">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Sub Category Name</label>
                    <input type="text" class="form-control" id="subcat-name">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <input type="hidden" id="subcat-token" value="<?php CSRFToken::_token() ?>">
                <input type="hidden" id="pcat-id">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm text-white pb-2" id="create_button" onclick="CreateSubCate(event)">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Sub_category modal end -->

<!-- category edit modal start -->
<div class="modal " id="SubCategoryEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sub Category Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="p-4">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Category</label>
                    <input type="text" class="form-control" id="subcat-edit-name">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <input type="hidden" id="subcat-edit-token" value="<?php CSRFToken::_token() ?>">
                <input type="hidden" id="subcat-edit-id">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm text-white pb-2" id="create_button" onclick="subEdit(event)">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- category edit modal end -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>
<script>
    function fun(name, id) {
        $("#edit-name").val(name);
        $("#edit-id").val(id);
        $("#CategoryEditModal").modal("show");
    }

    function startEdit(e) {
        e.preventDefault();
        name = $("#edit-name").val();
        token = $("#edit-token").val();
        id = $("#edit-id").val();
        $("#CategoryEditModal").modal("hide");
        // console.log("Name is " + name + "token is " + token + "id is " + id);

        $.ajax({
            type:'POST',
            url:'http://localhost/E-Commerce/public/admin/category/update',
            data:{
                name:name,
                token:token,
                id:id
            },

            success:function(result){
                // console.log("Success is" + result);
                window.location.href = "create";
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('AJAX request failed: ' + errorThrown);
                console.log(xhr.responseText); // Log the server response for debugging
            }
        });

    }

    function showSubCate(name, id) {
        $("#pcat-name").val(name);
        $("#pcat-id").val(id);
        $("#SubCategoryCreateModal").modal("show");
    }

    function CreateSubCate($e) {
        $e.preventDefault();
        var name = $("#subcat-name").val();
        var token = $("#subcat-token").val();
        var pcat_id = $("#pcat-id").val();
        $("#SubCategoryCreateModal").modal("hide");

        $.ajax({
            type: "POST",
            url: "http://localhost/E-Commerce/public/admin/subcategory/create",
            data: {
                name: name,
                token: token,
                pcat_id: pcat_id
            },

            success: function(result) {
                // console.log(result);
                window.location.href = "create";
            },
            error: function(response) {
                var str = "";
                var resp = (JSON.parse(response.responseText));
                alert(resp.name);
            }
        });
    }

    function subCatEditShow(name,id){
        $("#subcat-edit-name").val(name);
        $("#subcat-edit-id").val(id);
        $("#SubCategoryEditModal").modal("show");
    }

    function subEdit($e){
        $e.preventDefault();

        let name = $("#subcat-edit-name").val();
        let id= $("#subcat-edit-id").val();
        let token = $("#subcat-edit-token").val();
        $("#SubCategoryEditModal").modal("hide");


        $.ajax({
            type: "POST",
            url: "http://localhost/E-Commerce/public/admin/subcategory/update",
            data: {
                name: name,
                token: token,
                id: id
            },

            success: function(result) {
                // console.log(result);
                window.location.href = "create";
            },
            error: function(response) {
                var str = "";
                var resp = (JSON.parse(response.responseText));
                alert(resp.name);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>