  <div class="category-tab"><!--category-tab-->
                    <!-- title -->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <?php foreach ($this->data['kindofproduct'] as $key => $row) {
                                ?>
                                <li <?php if ($key == 0) echo "class = 'active' "; ?> ><a href="#kind<?= $row['IDKindOfProduct'] ?>" data-toggle="tab"><?= $row['Name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--content  -->
                    <div class="tab-content">
                        <?php foreach ($this->data['kindofproduct'] as $key1 => $row1) {
                            ?>
                            <div <?php
                            if ($key1 == 0)
                                echo "class='tab-pane fade active in' ";
                            else
                                echo "class='tab-pane fade ' ";
                            ?> id="kind<?= $row1['IDKindOfProduct'] ?>" >
                                <?php
                                /* hien thi san pham theo loai */
                                $homeModel = new Home();
                                $product = $homeModel->showProductByKind($row1['IDKindOfProduct']);
                                foreach ($product as $key2 => $row2) {
                                    if (isset($product)) {
                                        ?>
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($row2['Image'])?$row2['Image']:'default.jpg' ?>" alt="" />
                                                        <h2>$<?= $row2['UnitPrice'] ?></h2>
                                                        <p><?= substr($row2['Description'], 0, 30) ?></p>
                                                        <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        echo "<div class='col-sm-3'>";
                                        echo "<div class='product-image-wrapper'>";
                                        echo " <div class='single-products'>";
                                        echo "<div class='productinfo text-center'>";
                                        echo "<img src='<?= WEBROOT_PATH ?>/img/upload/default.jpg' alt='' />";
                                        echo "<h2>Không có giá</h2>";
                                        echo "<p>Không có miêu tả</p>";
                                        echo "<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Thêm vào giỏ</a>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div><!--/category-tab-->
