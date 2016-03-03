

<title>Management | Bánh kẹo Tràng An</title>

<style>
    .login-page,.register-page {
        background:#ecf0f5 !important;
    }
    .wrapper{
        background:#ecf0f5 !important;
    }
</style>

<div class="hold-transition login-page" style="margin-left: -20%;">
    <div id="loginform" class="login-box">
        <div class="login-logo">
            <a href="#"><b>Bánh kẹo</b> TRÀNG AN</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="UserName">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="col-xs-6" style="margin-left: 25%;">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
                <div class="col-xs-6">
                    <input id="temp" class="hide"></input>
                </div><!-- /.col -->
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" style="margin-left: auto;"> 
                                <span style="margin-left: 20px;">Remember Me</span>
                            </label>
                        </div>
                    </div><!-- /.col -->

                </div>
            </form>

            <a href="#">I forgot my password</a><br>
            <a href="<?= ROOT_PATH ?>/views/user/resgiter.php" class="text-center">Register a new membership</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div>


