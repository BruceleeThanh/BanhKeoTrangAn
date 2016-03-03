
            <!-- Username & Password Login form -->
            <div class="user_login">
                <form method="post" action="">
                    <label>Email / Tên đăng nhập</label>
                    <input type="text" name="username" />
                    <br />

                    <label>Mật khẩu</label>
                    <input type="password" name="password" />
                    <br />

                    <div class="checkbox">
                        <input id="remember" type="checkbox" />
                        <label for="remember">Ghi nhớ</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Trở về</a></div>
                        <div class="one_half last"><button class="btn btn_red" type="submit" name="login" >Đăng nhập</button></div>
                    </div>
                </form>

                <a href="#" class="forgot_password">Quên mật khẩu?</a>
            </div>
            <style>
                button.btn.btn_red{ width: 133px;height: 42px; border-radius: 4px; border: 1px solid; }
            </style>