<?php include_once 'header.php';?>
<!-- VIEW BLACKLIST -->
	
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-file"></i><?php echo ucfirst($title)?> Bulk Update</h3>
				</div>
				<div class="box-content nopadding">

				<?php $list_type = ($title == 'blacklist') ? 'list' : $title ?>

					<form action="<?php echo $host . '/'. $list_type ?>/bulk" method="POST" enctype="multipart/form-data" class='form-horizontal form-striped'>
						
						<div class="form-group">
							<label for="file" class="control-label col-sm-2">File-input</label>
							<div class="col-sm-10">
								<input type="file" name="file" id="file" class="form-control">
								<span class="help-block"> (Max Size: 100MB)</span>
							</div>
						</div>

						<!-- <div class="form-group">
							<label for="textfield" class="control-labe-l col-sm-2">List Type</label>
							<div class="col-sm-10">
								<div class="radio-demo-col">
									<div class="check-line">
										<input type="radio" class='icheck-me' value="blacklist" data-skin="minimal" name="type">
										<label class='inline' for="c1">Blacklist</label>
									</div>
									<div class="check-line">
										<input type="radio" class='icheck-me' value="dnc" data-skin="minimal" name="type" checked>
										<label class='inline' for="c2">Do Not Charge</label>
									</div>
								</div>
							</div>
						</div> -->

						<div class="form-group">
							<label for="textarea" class="control-label col-sm-2">Comment</label>
							<div class="col-sm-10">
								<textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-actions col-sm-offset-2 col-sm-10">
							<button type="submit" name="addBulkListBtn" class="btn btn-primary">Submit Request</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>