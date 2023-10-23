<?php $__env->startSection("title","UserLogin"); ?>

<?php $__env->startSection("content"); ?>
    <h1 class="text-center my-3">User Login</h1>
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <form action="<?php echo URL_ROOT . "user/login";?>" method="post">
                <input type="hidden" id="token" name="token" value="<?php
                use App\classes\CSRFToken;
                use App\classes\Session;
                echo CSRFToken::_token();?>">
                    <?php echo $__env->make('layout.report_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php if(Session::has("success_message")):?>                   
                        <?php echo Session::flash("success_message");?>
                    <?php endif ;?>
                    <?php if(Session::has("error_message")):?>                   
                        <?php echo Session::flash("error_message");?>
                    <?php endif ;?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="register">Not a member yet! ? please register</a>
                        <span >
                            <button class="btn btn-warning btn-sm">Cancle</button>
                            <button class="btn btn-primary btn-sm">Login</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>