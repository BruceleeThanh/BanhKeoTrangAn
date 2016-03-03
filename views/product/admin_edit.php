<script type="text/javascript" src="<?= WEBROOT_PATH ?>/plugins/ckeditor/sample.js"></script>
<script type="text/javascript" src="<?= WEBROOT_PATH ?>/plugins/ckeditor/ckeditor.js"></script>
<style>
    .red-require{
        color: red;
    }
    .image-exist{
        width: 80px;
        height: 80px;
    }
    .button {
        display: block;
        width: 115px;
        height: 33px;
        background: #4E9CAF;
        padding: 6px;
        text-align: center;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        margin-top: 8px;
    }
</style>
<form role="form" method="post" enctype="multipart/form-data">
    <div class="box-body">
        <div class="form-group">
            <label for="">Product Name</label><span class="red-require"><strong>*</strong></span>
            <input type="text"disable name="Name" value="<?= $this->data['item'][0]['Name']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="">Slug</label><span class="red-require"><strong>*</strong></span>
            <input type="text" name="Slug" value="<?= $this->data['item'][0]['Slug']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Slug" required>
        </div>
        <div class="form-group">
            <label for="">Model</label><span class="red-require"><strong>*</strong></span>
            <input type="text" name="Model" value="<?= $this->data['item'][0]['Model']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Model" required>
        </div>
        <div class="form-group">
            <label for="">UnitPrice</label><span class="red-require"><strong>*</strong></span>
            <input type="text" name="UnitPrice"  value="<?= $this->data['item'][0]['UnitPrice']; ?>"class="form-control" id="exampleInputPassword1" placeholder="UnitPrice" required>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea class="form-control ckeditor"  rows="10" id="dataInput" placeholder="Description" name="Description"><?= $this->data['item'][0]['Description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="imageexist"></label>
            <img class="image-exist" src="<?= WEBROOT_PATH ?>/img/upload/<?= $this->data['item'][0]['Image']; ?>">
        </div>
        <div class="form-group" style="height: 100px;">
            <label for="">Image</label><br>
            <input type="text" name="uploadedimage" class="form-control" id="fieldID" value="<?= $this->data['item'][0]['Image']; ?>" placeholder="Image" required>
            <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="button" type="button">Select Image</a>
        </div>
        <div class="form-group">
            <label for="">Tags</label><br>
            <?php foreach ($this->data['listTag'] as $row) { ?>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox" name="Tags[]" value="<?= $row['IDTag']; ?>" <?php if ($row['Name'] == $this->data['listTagExist'][0]['Name']) echo 'checked'; ?> > <?= isset($row['Name']) ? $row['Name'] : ''; ?>
                </label>
            <?php } ?>

        </div>
        <div class="form-group">
            <label for="">Kind Of Product</label><span class="red-require"><strong>*</strong></span><br><br>
            <?php foreach ($this->data['listKop'] as $row) { ?>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox" name="Kop[]" <?php if ($this->data['listKopExist'] != null) {
                    foreach ($this->data['listKopExist'] as $row1){
                        if ($row['IDKindOfProduct'] == $row1['IDKindOfProduct']) echo 'checked';
                    }} ?> value="<?= $row['IDKindOfProduct']; ?>"> <?= isset($row['Name']) ? $row['Name'] : ""; ?>
                </label>
<?php } ?>
        </div>
        <div class="form-group">
            <label for="">Rate</label>
            <input type="text" name="Rate" value="<?= $this->data['item'][0]['Rate']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Rate">
        </div>
        <div class="form-group">
            <label for="">RatePeople</label>
            <input type="text" name="RatePeople" value="<?= $this->data['item'][0]['RatePeople']; ?>" class="form-control" id="exampleInputPassword1" placeholder="RatePeople">
        </div>
        <div class="form-group">
            <label for="">Status</label><span class="red-require"><strong>*</strong></span>
            <select class="form-control" id="postStatus" name="Status">
                <option value="1" <?php if ($this->data['item'][0]['Status'] == 1) echo 'selected' ?>>Enable</option>
                <option value="0" <?php if ($this->data['item'][0]['Status'] == 0) echo 'selected' ?>>Disable</option>
            </select>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<div class="modal fade" id="myModal" style="width: 100%; display: none; position: center;" aria-hidden="true">
    <div class="modal-dialog" style="width: 100%;">
        <div class="modal-content" style=" width: 80%; margin-left: 13%; margin-top: 3%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Choose Image</h4>
            </div>
            <div class="modal-body" style="width: 100%;">
                <iframe width="100%" height="410" src="<?= WEBROOT_PATH ?>/plugins/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>