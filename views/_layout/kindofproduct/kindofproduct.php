<h2>sản phẩm</h2>

<div class="panel-group category-products" id="accordian">
    <div class="panel panel-default">
        <?php
        foreach ($this->data['kindofproductLeftbar'] as $item) {
            ?>
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#<?= $item['Slug'] ?>">
                        <?php if (!empty($item['children'])) echo "<span class='badge pull-right'><i class='fa fa-plus'></i></span>"; ?>
                        <?= $item['Name']; ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $item['Slug'] ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php foreach ($item['children'] as $row) { ?>
                        <li><a href="<?= ROOT_PATH?>vn/product/kindofproduct/<?= $row['Slug']?>/page/1"><?= $row['Name']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php }
        ?>
    </div>

</div>