 <?php
            if ($_POST && isset($_POST['username']) && isset($_POST['password'])) {
                $data = array();
                $userModel = new User();
                $user = $userModel->getByLogin($_POST['username']);
                $hash = md5(Config::get('salt') . $_POST['password']);
                if ($user && $user['Status'] == 0 && $hash == $user['Password']) {
                    Session::set('UserName', $user['Name']);
                    Session::set('UserRole', $user['Status']);
                    Session::set('UserID', $user['IDUser']);
                    $data = array(
                        'id' => $user['IDUser'],
                        'username' => $user['Name'],
                        'status' => 'success',
                    );
                    // role = 1 : admin
                    // role = 0 : member 
                    Router::redirect(ROOT_PATH);
                }
                echo json_encode($data);
            }
            ?>
            <!-- Username & Password Login form -->
            <div class="user_login">
                <form method="post" action="">
                    <label>Email / Username</label>
                    <input type="text" name="username" />
                    <br />

                    <label>Password</label>
                    <input type="password" name="password" />
                    <br />

                    <div class="checkbox">
                        <input id="remember" type="checkbox" />
                        <label for="remember">Remember me on this computer</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><button class="btn btn_red" type="submit" name="login" >Login</button></div>
                    </div>
                </form>

                <a href="#" class="forgot_password">Forgot password?</a>
            </div>
            <style>
                button.btn.btn_red{ width: 133px;height: 42px; border-radius: 4px; border: 1px solid; }
            </style>