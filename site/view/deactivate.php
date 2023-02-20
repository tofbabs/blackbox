<?php include_once 'header.php';?>
<!-- VIEW BLACKLIST -->
	
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-bordered">
				<div class="box-title">
					<h3>Subscriber Deactivation</h3>
				</div>
				<div class="box-content nopadding">
					<form action="#" method="POST" class='form-horizontal form-striped'>

						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2">MSISDN</label>	
							<div class="col-sm-10">
								<input type="text" name="name" placeholder="e.g. 2348096327823" class="form-control" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2">Shortcode</label>	
							<div class="col-sm-10">
								<input type="text" name="name" placeholder="e.g. 38474" class="form-control" value="<?php echo !empty($user) ? $user->getName() : '' ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2">Provider</label>	
							<div class="col-sm-10">
								<input type="text" name="provider" placeholder="Email" class="form-control" value="PROVIDER">
							</div>
						</div>

						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2">Role</label>
							<div class="col-sm-10">
								<select name="role" id="select" class='chosen-select form-control'>
									<option value="1" >SERVICE 1</option>
									<option value="2" >SERVICE 2</option>
								</select>
							</div>
						</div>
						<div class="form-actions col-sm-offset-2 col-sm-10">
							<button type="submit" name="addNewUserBtn" class="btn btn-primary">Deactivate Now</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>