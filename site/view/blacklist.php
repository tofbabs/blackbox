<?php include_once 'header.php';?>
<!-- DASHBOARD -->
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='satgreen'>
								<i class="fa fa-tasks"></i>
								<div class="details">
									<span class="big">120</span>
									<span>Approved Set</span>
								</div>
							</li>
							<li class='lightred'>
								<i class="fa fa-exclamation-triangle"></i>
								<div class="details">
									<span class="big">456,384</span>
									<span>Blacklisted Numbers</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="more-login.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="index-2.html">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-color lightred box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									Daily Update Summary
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">
								<div class="statistic-big">
									<div class="top">
										<div class="left">
											<select name="category" class='chosen-select' data-nosearch="true" style="width:150px;">
												<option value="1">Today</option>
												<option value="2">Yesterday</option>
												<option value="3">Last week</option>
												<option value="4">Last month</option>
											</select>
										</div>
										<div class="right">
											50%
											<span>
												<i class="fa fa-arrow-circle-right"></i>
											</span>
										</div>
									</div>
									<div class="bottom">
										<div class="flot medium" id="flot-hdd"></div>
									</div>
									<div class="bottom">
										<ul class="stats-overview">
											<li>
												<span class="name">
													Usage
												</span>
												<span class="value">
													50%
												</span>
											</li>
											<li>
												<span class="name">
													Usage % / User
												</span>
												<span class="value">
													0.031
												</span>
											</li>
											<li>
												<span class="name">
													Avg. Usage %
												</span>
												<span class="value">
													60%
												</span>
											</li>
											<li>
												<span class="name">
													Idle Usage %
												</span>
												<span class="value">
													12%
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box box-color box-bordered green">
							<div class="box-title">
								<h3>
									<i class="fa fa-bullhorn"></i>Feeds</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini custom-checkbox checkbox-active">Automatic refresh
										<i class="fa fa-square-o"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="400" data-visible="true">
								<table class="table table-nohead" id="randomFeed">
									<tbody>
										<tr>
											<td>
												<span class="label label-default"><i class="fa fa-plus-square"></i></span>
												<a href="#">John Doe</a>added a new photo</td>
										</tr>
										<tr>
											<td>
												<span class="label label-success"><i class="fa fa-user"></i></span>New user registered</td>
										</tr>
										<tr>
											<td>
												<span class="label label-info"><i class="fa fa-shopping-cart"></i></span>New order received</td>
										</tr>
										<tr>
											<td>
												<span class="label label-warning"><i class="fa fa-comment"></i></span><a href="#">John Doe</a>commented on<a href="#">News #123</a>
											</td>
										</tr>
										<tr>
											<td>
												<span class="label label-success"><i class="fa fa-user"></i></span>New user registered</td>
										</tr>
										<tr>
											<td>
												<span class="label label-info"><i class="fa fa-shopping-cart"></i></span>New order received</td>
										</tr>
										<tr>
											<td>
												<span class="label label-warning"><i class="fa fa-comment"></i></span><a href="#">John Doe</a>commented on<a href="#">News #123</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include_once 'footer.php'; ?>