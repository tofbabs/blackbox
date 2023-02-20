<?php include_once 'header.php';?>
<!-- VIEW BLACKLIST -->
	
	<div class="row">
		<div class="col-sm-12">
			
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3><i class="fa fa-exclamation-triangle"></i>
						<?php if (isset($header_info)) echo $header_info ?>
					</h3>
				</div>
				<?php if (!isset($toggle)) : ?>
				<?php $list_type = ($title == 'blacklist') ? 'list' : $title ?>

				<div class="box-content nopadding">
					<form action="<?php echo $host . '/' . $list_type ?>/approve" method="POST" class='form-horizontal form-striped'>
						
						<div class="form-group">
							<label for="textarea" class="control-label col-sm-2">Comment</label>
							<div class="col-sm-10">
								<textarea id="comment" name="comment" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-actions col-sm-offset-2 col-sm-10">
							<button type="submit" name="approveBtn" class="btn btn-primary">Approve All</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
					</form>
					<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="null,select,text,select,daterange,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
						<thead>
							<tr>
								<th class='with-checkbox'>
									<input type="checkbox" name="check_all" class="dataTable-checkall">
								</th>
								<th>Accumulator</th>
								<th>MSISDN</th>
								<th class='hidden-350'>Status</th>
								<th class='hidden-1024'>Date Added</th>
								<th class='hidden-480'>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($blacklist as $entity) : ?>
							<tr>
								<td class="with-checkbox">
									<input type="checkbox" name="check" value="1">
								</td>
								<td><?php echo $entity->getAccumulator() ?></td>
								<td><?php echo $entity->getMsisdn() ?></td>
								<td class='hidden-350'>
									<?php echo ($entity->getStatus() == 0) ? 'pending' : 'published' ?>
								</td>
								<td class='hidden-1024'><?php echo $entity->getUpdateTime() ?></td>
								<td class='hidden-480'>
									<a href="<?php echo $host . "/list/approve/" . $entity->getMsisdn() ?>" class="btn" rel="tooltip" title="Approve">
										<i class="fa fa-check"></i>
									</a>
									<a href="<?php echo $host . "/list/delete/" . $entity->getMsisdn() ?>" class="btn" rel="tooltip" title="Delete">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<?php endif?>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>