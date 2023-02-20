<?php include_once 'header.php';?>
<!-- VIEW BLACKLIST -->

	<div class="row">
		<div class="col-sm-12">
			<div class="box box-color box-bordered">

				<div class="box-title">
					<h3>
						<i class="fa fa-user"></i>
						<?php echo ucfirst($role) ?>
					</h3>
				</div>

				<div class="box-content nopadding">
					<table class="table table-hover table-nomargin table-bordered dataTable">

					<!-- <table id="users" class="table table-hover table-nomargin table-colored-header"> -->
						<thead>
							<tr>
								<th>No</th>
								<th>Company Name</th>
								<th>Role</th>
								<th class='hidden-350'>Primary Contact Email</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $key => $user): ?>

							<tr>
								<td><?php echo $key + 1 ?> </td>
								<td><?php echo $user['company'] ?></td>
								<td><?php echo $user['role'] ?></td>
								<td class='hidden-350'><?php echo $user['email'] ?></td>

								<td class='hidden-480'>
									<a href="<?php echo $host . '/user/profile/' . $user['company_id'] ?>" class="btn" rel="tooltip" title="View">
										<i class="fa fa-eye"></i>
									</a>
									<a href="<?php echo $host . '/user/edit/' . $user['company_id'] ?>" class="btn" rel="tooltip" title="Edit">
										<i class="fa fa-edit"></i>
									</a>
									<a href="<?php echo $host . '/user/delete/' . $user['company_id'] ?>" class="btn confirmation" rel="tooltip" title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


<?php include_once 'footer.php'; ?>