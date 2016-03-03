<style>
    .get-it-now {
        background: #D8D8D1;
        border: 0 none;
        border-radius: 0;
        color: #FFFFFF;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 300;
        margin-top: 23px;
    }
</style>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < count($this->data['sliderShow']); $i++) {
                            if ($i == 0) {
                                ?>
                                <li data-target="#slider-carousel" data-slide-to="<?= $i ?>" class="active"></li>
                            <?php } else {
                                ?>
                                <li data-target="#slider-carousel" data-slide-to="<?= $i ?>"></li>
                            <?php }
                        }
                        ?>
                    </ol>

                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($this->data['sliderShow'] as $row) {
                            ?>
                            <div class="item <?php
                            if ($i == 0) {
                                $i = 1;
                                echo "active";
                            }
                            ?>">
                                <div class="col-sm-6">
                                    <h1 style="font-family: Segoe UI Light !important;"><span><?= $row['Title']; ?></span></h1>
                                    <h2><?= $row['Header']; ?></h2>
                                    <p><?= $row['Content']; ?></p>
                                    <button onclick="location.href = '<?= ROOT_PATH . $row['Link']; ?>';" type="button" id="btn-getitnow" class="btn btn-default get-it-now">Xem ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img  class="slider-image" src="<?= WEBROOT_PATH?>/img/upload/<?= $row['Image'] ?>" class="girl img-responsive" alt="" />
                                    <img src="<?= WEBROOT_PATH?>/img/logo/sale.png" class="pricing" alt="" style="margin-top: -232px; margin-right: -207px;"/>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<style>
    .slider-image{
        width: 450px !important;
        height: 441px !important;
    }
</style>