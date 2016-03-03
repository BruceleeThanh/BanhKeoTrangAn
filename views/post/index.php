<style>
    .imgProduct{
        width: 180px !important;
        height: 180px !important;
    }
    .center{
        text-align: center;
    }
</style>
<?php include VIEWS_PATH . '/_layout/link.php'; ?>
<body>
    <?php include VIEWS_PATH . '/_layout/header.php'; ?>

    <div class="container">
        <div class="row">
            <?php include VIEWS_PATH . '/_layout/leftbar.php'; ?>

            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Tin mới</h2>
                    <?php foreach ($this->data['lstPosts'] as $key => $row) {
                        ?>
                        <div class="single-blog-post" style="margin-top: 100px;margin-bottom: 100px;">
                            <h3><?= $row['Title'] ?></h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> Admin</li>
                                    <li><i class="fa fa-calendar"></i><?= $row['PostTime'] ?></li>
                                </ul>
                                <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </span>
                            </div>
                            <a href="">
                                <img src="<?= WEBROOT_PATH ?>/img/upload/<?= $row['Image'] ?>" alt="" style="width: 900px;height: 450px;">
                            </a>
                            <p><?= substr($row['Content'], 0, 1000) ?></p>
                            <a  class="btn btn-primary" href="<?=ROOT_PATH ?>vn/post/detail/<?=$row['Slug'] ?>-<?=$row['IDPost'] ?>">Chi tiết</a>
                        </div>
                    <?php } ?>
                    <div class="c-gray-box center">
                        <ul class="pagination">
                            <li class="<?= $this->data['currentPage'] < 2 ? "hide" : "" ?>"><a href="<?= ROOT_PATH . "/post/index/page/" . ($this->data['currentPage'] - 1); ?> ">&laquo;</a></li>
                            <?php
                            foreach ($this->data['paging'] as $page) {
                                echo "<li class='" . ($this->data['currentPage'] == $page ? "active" : "") . "'><a href='" . ROOT_PATH . "/post/index/page/$page" . "'>$page</a></li>";
                            }
                            ?>
                            <li class="<?= $this->data['currentPage'] > $this->data['currentPage'] - 1 ? "hide" : "" ?>"><a href="<?= ROOT_PATH . "/post/index/page/" . ($this->data['currentPage'] + 1); ?>">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include VIEWS_PATH . '/_layout/footer.php'; ?> 

    <script src="<?= WEBROOT_PATH ?>/js/jquery.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/bootstrap.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.scrollUp.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/price-range.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main1.js"></script> <!-- Gem jQuery -->
</body>
</html>