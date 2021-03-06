<style>
    .createpost{
        margin-left: 90% !important;
        color:black;
    }
    .center{
        text-align: center;
    }
    #image-content{
        width: 120px;
        height: 80px;
    }
    td {
        text-align: center !important;
    }
    th {
        text-align: center !important;
    }
</style>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Posts List</h3>
                <a href="<?= ADMIN_ROOT ?>/post/add" class="createpost"><i class="fa fa-plus fa-2x"></i></a>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="tb" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>PostID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Slug</th>
                                <th>Categories</th>
                                <th>Tags</th>
                                <th>Image</th>
                                <th>PostTime</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <?php
                        $aTagPost = new TagPost();
                        $aCategoryPost = new CategoryPost();
                        $aTag = new Tag();
                        $aCategory = new Category();
                        $i = ($this->data['currentPage'] - 1) *5 + 1;
                        foreach ($this->data['lstPosts'] as $row) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['IDPost']; ?></td>
                                    <td><?= substr($row['Title'], 0, 200); ?></td>
                                    <td><?= substr($row['Content'], 0, 200); ?></td>
                                    <td><?= $row['Slug']; ?></td>
                                    <td>
                                        <?php 
                                            $Categories = "";
                                            foreach($aCategoryPost->selectByIDPost($row['IDPost']) as $rowCategoryPost){
                                                $CategoryName = $aCategory->selectByIDCategory($rowCategoryPost['IDCategory']);
                                                $Categories = $Categories.$CategoryName[0]['Name']."; ";
                                            }
                                            echo $Categories;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $Tags = "";
                                            foreach($aTagPost->selectByIDPost($row['IDPost']) as $rowTagPost){
                                                $TagName = $aTag->selectByID($rowTagPost['IDTag']);
                                                $Tags = $Tags.$TagName['Name']."; ";
                                            }
                                            echo $Tags;
                                        ?>
                                    </td>
                                    <td><img id="image-content" src="<?= WEBROOT_PATH?>/img/upload/<?= $row['Image']; ?>"></td>
                                    <td><?= $row['PostTime']; ?></td>
                                    <td><?= $row['Status'] == 1? 'Enable' : 'Disable'; ?></td>
                                    <td><a href="<?= ADMIN_ROOT ?>/post/edit/<?= $row['IDPost']; ?>"><i class="fa fa-pencil"></i></a></td>
                                    <td><a onclick="return confirm('Do you want delete this record?');" href="<?= ADMIN_ROOT ?>/post/delete/<?= $row['IDPost']; ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="c-gray-box center">
    <ul class="pagination">
        <li class="<?= $this->data['currentPage'] < 2 ? "hide" : "" ?>"><a href="<?= ADMIN_ROOT . "/post/list/page/" . ($this->data['currentPage'] - 1); ?> ">&laquo;</a></li>
        <?php
        foreach ($this->data['paging'] as $page) {
            echo "<li class='" . ($this->data['currentPage'] == $page ? "active" : "") . "'><a href='" . ADMIN_ROOT . "/post/list/page/$page" . "'>$page</a></li>";
        }
        ?>
        <li class="<?= $this->data['currentPage'] > $this->data['currentPage'] - 1 ? "hide" : "" ?>"><a href="<?= ADMIN_ROOT . "/post/list/page/" . ($this->data['currentPage'] + 1); ?>">&raquo;</a></li>
    </ul>
</div>