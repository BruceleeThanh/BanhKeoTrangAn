<div class="col-sm-7">
    <form method="post">
        <div class="shop-menu pull-right">
            <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-user"></i> <?php
                        if (Session::get("UserName"))
                            echo Session::get("UserName");
                        else
                            echo "Account";
                        ?></a></li>
                <?php
                $wishlist = ROOT_PATH . "en/wishlist/index/userid/" . Session::get('UserID');
                $cart = ROOT_PATH . "en/cart/cart_log/userid/" . Session::get('UserID');
                ?>
                <li><a href="<?= !empty(Session::get('UserID')) ? $wishlist : "#" ?>"><i class="fa fa-star"></i> Wishlist<span class="badge" style="background-color: #000;"><?php if (Session::get('count-wishlist') == NULL) echo "";
                else echo Session::get('count-wishlist'); ?></span></a></li>
                <li><a href="#"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                <li><a href="<?= !empty(Session::get('UserID')) ? $cart : "#" ?>"><i class="fa fa-shopping-cart"></i> Cart <span class="badge" style="background-color: #000;"><?php if (Session::get('count-cart') == NULL) echo "";
                else echo Session::get('count-cart'); ?></span></a></li>                  
                <li><a id="modal_trigger" class="btn <?php if (Session::get("UserName")) echo "hidden"; ?>" href="#modal"><i class="fa fa-lock"></i>Login</a></li>
                <?php if (Session::get("UserName")) echo "<li><button id='logout' class='btn flat' name='logout' onmouseover='changeColor(this);'><i class='fa fa-lock'></i>Logout</button></li>"; ?>
                <?php
                if (isset($_POST['logout'])) {
                    Session::destroy();
                    Router::redirect(ROOT_PATH);
                }
                ?>
                <style>
                    #logout{
                        background: transparent;
                        border: none !important;
                    }
                </style>
                <script type="text/javascript" language="javascript">

                    window.onload = function () {
                        document.getElementById("logout").onmouseover = function ()
                        {
                            this.style.backgroundColor = "#FF9933";
                        }

                        document.getElementById("logout").onmouseout = function ()
                        {
                            this.style.backgroundColor = "#FFFFFF";
                        }
                    }
                </script>
            </ul>
        </div>
    </form>
</div>
