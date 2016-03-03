<h2>Tin tức</h2>

<div class="panel-group category-products" id="accordian2">
    <div class="panel panel-default">
        <?php
        foreach ($this->data['categoryLeftbar'] as $item) {
            ?>
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian2" href="#<?= $item['Slug'] ?>">
                        <?php if (!empty($item['children'])) echo "<span class='badge pull-right'><i class='fa fa-plus'></i></span>"; ?>
                        <?= $item['Name']; ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $item['Slug'] ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php foreach ($item['children'] as $row) { ?>
                            <li><a href=""><?= $row['Name']; ?></a></li>  
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php }
        ?>
    </div>

</div>