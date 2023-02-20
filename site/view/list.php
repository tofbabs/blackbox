<?php include_once 'header.php';?>
<!-- VIEW BLACKLIST -->
		
	<div class="row">
		<div class="col-sm-12">

			<div class="box box-color box-bordered">
				<div class="box-title">
				<?php if ($title=='blacklist'): ?>
					<h3><?php echo $blacklist_count . ' '?> Blacklisted MSISDNs</h3>
				<?php elseif ($title=='dnc'): ?>
					<h3><?php echo $dnc_count . ' '?> Do-Not-Charge MSISDNs</h3>
				<?php endif ?>
				</div>
				<div class="box-content nopadding">
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
						<th>Comments</th>
						<?php if($_SESSION['company']->getPrivilege() == 1): ?>
						<th class='hidden-240'>Options</th>
						<?php endif ?>
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
						
						<td class='hidden-1024'><?php $old = strtotime($entity->getUpdateTime()); echo date('d-m-Y', $old ) ?></td>
						<td><?php echo $entity->getComment() ?></td>
						<?php if($_SESSION['company']->getPrivilege() == 1): ?>
						<td class='hidden-480'>
							<a href="<?php echo $host . "/list/delete/" . $entity->getMsisdn() ?>" class="btn" rel="tooltip" title="Delete">
								<i class="fa fa-times"></i>
							</a>
						</td>
						<?php endif ;?>
					</tr>
				<?php endforeach ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
			

<?php include_once 'footer.php'; ?>