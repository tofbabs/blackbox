<?php include_once 'header.php'; global $host;?>
<!-- VIEW BLACKLIST -->
	
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-th-list"></i><?php echo ucfirst($title)?> MSISDN</h3>
				</div>
				<?php $list_type = ($title == 'blacklist') ? 'list' : $title ?>
				<div class="box-content nopadding">
					<form action="<?php echo $host . '/'.$list_type.'/single' ?>" method="POST" class='form-horizontal form-striped'>
						
						
						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2">MSISDN(s)<small>Separate Multiple by comma</small></label>	
							<div class="col-sm-10">
								<input type="text" name="msisdn" id="msisdn" placeholder="23480.." class="form-control" required>
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="textfield" class="control-label col-sm-2">List Type</label>
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
								<textarea id="comment" name="comment" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-actions col-sm-offset-2 col-sm-10">
							<button type="submit" name="addSingleBtn" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>