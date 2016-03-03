<style>
    .red{
        color: red;
    }
    .ra{

    }
</style>
<form role="form" method="post">
    <div class="box-body">
        <div class="form-group">
            <label for="">UserName</label><span class="red" ><strong> * </strong></span>
            <input type="text" name="Name" class="form-control" value="<?= $this->data['user'][0]['Name']; ?>" id="exampleInputEmail1" placeholder="UserName" required>
        </div>

        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" name="Fullname" class="form-control" value="<?= isset($this->data['user'][0]['Fullname']) ? $this->data['user'][0]['Fullname'] : ""; ?>" id="exampleInputPassword1" placeholder="Fullname">
        </div>

        <div class="form-group">
            <label for="">Birthday</label>
            <input type="date" name="Birthday" class="form-control" value="<?= isset($this->data['user'][0]['Birthday']) ? $this->data['user'][0]['Birthday'] : ""; ?>" id="exampleInputPassword1" placeholder="Birthday">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="Address" class="form-control" value="<?= isset($this->data['user'][0]['Address']) ? $this->data['user'][0]['Address'] : ""; ?>" id="exampleInputPassword1" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="">Email</label><span class="red" ><strong> * </strong> </span>
            <input type="email" name="Email" class="form-control"  value="<?= isset($this->data['user'][0]['Email']) ? $this->data['user'][0]['Email'] : ""; ?>" id="exampleInputPassword1" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="text" name="PhoneNumber" class="form-control" value="<?= isset($this->data['user'][0]['PhoneNumber']) ? $this->data['user'][0]['PhoneNumber'] : ""; ?>" id="exampleInputPassword1" placeholder="PhoneNumber">
        </div>
        <div class="form-group ra">
            <label for="">Gender</label>
            <br/>
            <input type="radio" class="radio-inline" name="Gender" value="0" <?php if ($this->data['user'][0]['Gender'] == 0) echo 'checked'; ?> > Male<br>
            <input type="radio" class="radio-inline"name="Gender" value="1" <?php if ($this->data['user'][0]['Gender'] == 1) echo 'checked'; ?>> Female<br>
            <input type="radio" class="radio-inline"name="Gender" value="2" <?php if ($this->data['user'][0]['Gender'] == 2) echo 'checked'; ?>> Other
        </div>
        <div class="form-group ra">
            <label for="">Status</label><span class="red" > <strong> * </strong> </span>
            <br/>
            <input type="radio" class="radio-inline"name="Status" value="1" <?php if ($this->data['user'][0]['Status'] == 1) echo 'checked'; ?>> Admin<br>
            <input type="radio" class="radio-inline"name="Status" value="0" <?php if ($this->data['user'][0]['Status'] == 0) echo 'checked'; ?>> Member<br>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>