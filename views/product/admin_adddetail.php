<script type="text/javascript" src="<?= WEBROOT_PATH ?>/plugins/ckeditor/sample.js"></script>
<script type="text/javascript" src="<?= WEBROOT_PATH ?>/plugins/ckeditor/ckeditor.js"></script>
<style>
    .red-require{
        color: red;
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
            <h2>Add Detail Product</h2>
            <label for="">Product Name</label>
            <input type="text" disable name="Name" readonly="readonly" value="<?= $this->data['ProductName'][0]['Name'] ?>" class="form-control " id="exampleInputEmail1" placeholder="Name" >
        </div>
        <div class="form-group">
            <label for="">Caption</label>
            <input type="text" name="Caption"  class="form-control" id="exampleInputEmail1" placeholder="Caption">
        </div>
        <div class="form-group" style="height: 100px;">
            <label for="">Image</label><br>
            <input type="text" name="uploadedimage" class="form-control" id="fieldID" placeholder="Image" required>
            <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="button" type="button">Select Image</a>
        </div>

    </div><!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add</button>
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