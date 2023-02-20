<?php include_once 'header.php'; ?>
<!-- VIEW BLACKLIST -->

<div class="row">
    <div class="col-sm-12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="fa fa-user"></i><?php echo!empty($user) ? 'Edit' : 'Add' ?> User</h3>
            </div>
            <div class="box-content nopadding pre-scrollable">

                <form action="<?php echo isset($company_id) ? $host.'/user/add/'.$company_id : $host.'/user/add/' ?>" method="POST" class='form-horizontal form-striped'>

                    <input type="hidden" name="user_id" value="<?php echo isset($company_id) ? $company_id : '' ?>">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Company Name</label>	
                        <div class="col-sm-10">
                            <input type="text" name="company_name" placeholder="Company Name" class="form-control" value="<?php echo isset($company_name) ? $company_name : '' ?>" required>
                        </div>
                    </div>

                    <!-- Add Primary Contact-->

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Primary Contact </label>	
                        <div class="col-sm-10">
                            <input type="email" name="primary_email" placeholder="Email Address" class="form-control" value="<?php echo isset($primary_user) ? $primary_user->getEmail() : '' ?>" required>
                        </div>
                    </div>                

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Role</label>
                        <div class="col-sm-10">

                            <select name="role" id="select" class='chosen-select form-control'>
                                <option value="1">Administrator</option>
                                <option value="2">List Accumulator</option>
                                <option value="3" selected="selected">Provider</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="dynamicInput">
                    
                        <label for="textfield" class="control-label col-sm-2">Secondary Contact</label>
                        <div class="col-sm-8">
                            <input id="email1" type="email" name="secondary_email" class="form-control" value="<?php echo isset($secondary_user) ? $secondary_user->getEmail() : '' ?>" >
                        </div>

                    </div>

                    <div class="form-actions col-sm-offset-2 col-sm-10">
                        <button type="submit" name="addNewUserBtn" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_once 'footer.php'; ?>