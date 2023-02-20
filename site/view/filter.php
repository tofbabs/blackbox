<?php include_once 'header.php'; global $privileges;?>
<!-- VIEW BLACKLIST -->
		
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-sort"></i>
						Filter MSISDN
					</h3>
				</div>
				<div class="box-content nopadding">
					<ul class="tabs tabs-inline tabs-top">
						<li class='active'>
							<a href="#fileUpload" data-toggle='tab'>
								<i class="fa fa-file"></i>File Filter</a>
						</li>
						<li>
							<a href="#onScreen" data-toggle='tab'>
								<i class="fa fa-lock"></i>On Screen</a>
						</li>
						
					</ul>

					<div class="tab-content padding tab-content-inline tab-content-bottom">
						<div class="tab-pane fadeInRight active" id="fileUpload">
							<?php include_once 'flash.php'; ?>
							<form action="<?php echo $host?>/list/filter" method="POST" enctype="multipart/form-data" class='form-horizontal form-striped'>
					
								<div class="row">

									<div class="offset-2 col-sm-10">
										<!-- <h4>Coming Soon</h4> -->
										<?php if (!isset($link)) : ?>
										<div class="form-group">
											
											<label for="file" class="control-label col-sm-2">File-input</label>
											<div class="col-sm-10">
												<input type="file" name="file" id="file" class="form-control">
												<span class="help-block"> (Max Size: 100MB)</span>
											</div>
											
										</div>
										<div class="form-actions col-sm-offset-2 col-sm-10">
											<button type="submit" name="fileFilterBtn" class="btn btn-primary">Submit Filter Request</button>
											<button type="reset" class="btn">Cancel</button>
										</div>

										<?php else: ?>
										<!-- <div class="col-sm-10">
											<h3><a href="<?php echo $link?>">Download Processed File</a></h3>
										</div> -->
										<?php endif ?>
									</div>
								</div>
							</form>
						</div>
						<!-- Tab user messages -->
						<div class="tab-pane" id="onScreen">
							<form action="<?php echo $host?>/list/filter" method="POST" enctype="multipart/form-data" class='form-horizontal form-striped'>
							
								<div class="row">

									<div class="offset-2 col-sm-10">
										
										<div class="form-group">
											<label for="textarea" class="control-label col-sm-2">Add MSISDNs</label>
											<div class="col-sm-10">
												<textarea name="dirty" id="dirty" rows="5" class="form-control" required><?php echo isset($clean[0]) ? implode(',', $clean) : ''?></textarea>
												<span class="help-block"> (Maximum of 100 MSISDNs. Use File Filter if more)</span>
											</div>
										</div>
										<div class="form-actions col-sm-offset-2 col-sm-10">
											<button type="submit" name="screenFilterBtn" class="btn btn-primary">Filter</button>
											<button type="reset" class="btn">Cancel</button>
										</div>
									</div>
								</div>
							</form>
						</div><!-- End div .tab-pane -->
					</div>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>