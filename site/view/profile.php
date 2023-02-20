<?php include_once 'header.php'; global $privileges;?>
<!-- VIEW BLACKLIST -->
		
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-user"></i>
						Profile
					</h3>
				</div>

				<div class="box-content nopadding">
					<ul class="tabs tabs-inline tabs-top">
						<li class='active'>
							<a href="#profile" data-toggle='tab'>
								<i class="fa fa-user"></i>Details</a>
						</li>
		
					
						<li>
							<a href="#activities" data-toggle='tab'>
								<i class="fa fa-lock"></i>Activities</a>
						</li>
					</ul>
					<div class="tab-content padding tab-content-inline tab-content-bottom">
						<div class="tab-pane active" id="profile">
							<form action="#" class="form-horizontal">
								<div class="row">

									<div class="offset-2 col-sm-10">
										<div class="form-group">
											<label for="name" class="control-label col-sm-2 right">Name:</label>
											<div class="col-sm-10">
												<input type="text" name="name" class='form-control' value="<?php echo $company->getName() ?> " disabled>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="control-label col-sm-2 right">Primary Contact Email:</label>
											<div class="col-sm-10">
												<input type="text" name="email" class='form-control' value="<?php echo $primary_contact ?> " disabled>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="control-label col-sm-2 right">Role</label>
											<div class="col-sm-10">
												<input type="text" name="role" class='form-control' value="<?php echo ucfirst($privileges[$company->getPrivilege()]) ?> " disabled>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- Tab user messages -->
						<div class="tab-pane  fadeInRight" id="activities">
							<div class="scroll-user-widget">
								<ul class="media-list pre-scrollable">

									<?php 
										if (empty($activities)) {
											# code...
											echo "<h3>No Activity Yet </h3>";
										}else{
										foreach ($activities as $activity): ?>
								  <li class="media">
									<a class="pull-left" href="#fakelink">
									  <span><i class="fa fa-clock"></i></span>
									</a>
									<div class="media-body">
									  <h4 class="media-heading"><small><?php echo $activity->getTimestamp()?></small></h4>
									  <p><?php echo $activity->getAction() . " " . $activity->getObject(); ?></p>
									</div>
								  </li>
								<?php endforeach ; }?>
								</ul>
							</div><!-- End div .scroll-user-widget -->
						</div><!-- End div .tab-pane -->
					</div>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>