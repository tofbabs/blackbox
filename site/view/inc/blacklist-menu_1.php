			<div class="subnav <?php echo ($title == 'blacklist' || $title == 'dashboard') ? '' : 'subnav-hidden' ?>">
				<div class="subnav-title">
					<a href="<?php echo $host?>/site/#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Blacklist</span>
					</a>
				</div>

				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="<?php echo $host?>/" data-toggle="dropdown">Add</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo $host?>/list/single">Single</a>
							</li>
							<li>
								<a href="<?php echo $host?>/list/bulk">Bulk Upload</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $host?>/list/view">View</a>
					</li>
					<li>
						<a href="<?php echo $host?>/list/approve">Pending</a>
					</li>
                    <li>
                        <a href="<?php echo $host?>/list/history">Approved</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/list/filter">Filter MSISDN</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/list/download-all">Download Entire Blacklist</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/list/download-all">Download Most Recent Blacklist</a>
                    </li>
				</ul>
			</div>


			<div class="subnav <?php echo ($title == 'dnc') ? '' : 'subnav-hidden' ?>">
				<div class="subnav-title">
					<a href="<?php echo $host?>/site/#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>DoNotCharge List</span>
					</a>
				</div>

				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="<?php echo $host?>/" data-toggle="dropdown">Add</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo $host?>/dnc/single">Single</a>
							</li>
							<li>
								<a href="<?php echo $host?>/dnc/bulk">Bulk Upload</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $host?>/dnc/view">View</a>
					</li>
					<li>
						<a href="<?php echo $host?>/dnc/approve">Pending</a>
					</li>
                    <li>
                        <a href="<?php echo $host?>/dnc/history">Approval History</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/dnc/filter">Filter MSISDN</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/dnc/download-all">Download Entire DNC List</a>
                    </li>
                    <li>
                        <a href="<?php echo $host?>/dnc/download-all">Download Most Recent DNC List</a>
                    </li>
				</ul>
			</div>

			