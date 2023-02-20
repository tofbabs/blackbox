<!doctype html>
<html>
<?php global $host ?>

<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jun 2015 15:59:16 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>BLACKBOX - <?php echo isset($title) ?  $title : 'HOME' ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/jquery-ui/jquery-ui.min.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/datatable/TableTools.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/fullcalendar/fullcalendar.css">

	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/themes.css">

	<!-- jQuery -->
	<script src="<?php echo $host?>/site/js/jquery.min.js"></script>


	<!-- Nice Scroll -->
	<script src="<?php echo $host?>/site/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo $host?>/site/js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="<?php echo $host?>/site/js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo $host?>/site/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $host?>/site/js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="<?php echo $host?>/site/js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo $host?>/site/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="<?php echo $host?>/site/js/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?php echo $host?>/site/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="<?php echo $host?>/site/js/plugins/pageguide/jquery.pageguide.js"></script>

	<!-- Chosen -->
	<script src="<?php echo $host?>/site/js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="<?php echo $host?>/site/js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo $host?>/site/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- CKEditor -->
	<script src="<?php echo $host?>/site/js/plugins/ckeditor/ckeditor.js"></script>

	<!-- New DataTables -->
	<script src="<?php echo $host?>/site/js/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/momentjs/moment-range.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
	<script src="<?php echo $host?>/site/js/plugins/datatables/extensions/dataTables.scroller.min.js"></script>


	<!-- Theme framework -->
	<script src="<?php echo $host?>/site/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo $host?>/site/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo $host?>/site/js/demonstration.min.js"></script>


	<!-- Chosen -->
	<script src="<?php echo $host?>/site/js/plugins/chosen/chosen.jquery.min.js"></script>


	<!--[if lte IE 9]>
		<script src="<?php echo $host?>/site/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
		<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $host?>/site/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $host?>/site/img/apple-touch-icon-precomposed.png" />
</head>

<body>
	<div id="navigation">
		<div class="container-fluid">
			<a href="<?php echo $host?>/dashboard" id="brand">BLACKBOX</a>
			<a href="<?php echo $host?>/site/#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>
			<ul class='main-nav'>

				<li class='<?php echo ($title == 'Dashboard') ? 'active' : null ?>'>
					<a href="<?php echo $host?>/dashboard">
						<span>Dashboard</span>
					</a>
				</li>
				<li class='<?php echo ($title == 'List') ? 'active' : null ?>'>
					<a href="<?php echo $host?>/list">
						<span>Blacklist</span>
					</a>
				</li>
				<li class='<?php echo ($title == 'Help') ? 'active' : null ?>'>
					<a href="<?php echo $host?>/#">
						<span>Help</span>
					</a>
				</li>

			</ul>
			<div class="user">
				<div class="dropdown">
					<a href="<?php echo $host?>/site/#" class='dropdown-toggle' data-toggle="dropdown"> <?php echo $_SESSION['company']->getName() ?>
						<img src="<?php echo $host?>/site/img/demo/user-avatar.png" alt="">
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo $host . '/user/edit/' . str_replace(' ', '+', $_SESSION['company']->getName())?>">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li>
						<li>
							<a href="<?php echo $host?>/login">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid" id="content">
		<div id="left">
			<form action="<?php echo $host?>/list/search" method="post" class='search-form'>
				<div class="search-pane">
					<input type="text" name="msisdn" placeholder="Enter Phone or Shortcode...">
					<button type="submit" name="searchBtn">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
			<div class="subnav">
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
				</ul>
			</div>
			
			<div class="subnav hidden">
				<div class="subnav-title">
					<a href="<?php echo $host?>/site/#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Deactivate</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="<?php echo $host?>/" data-toggle="dropdown">Start</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo $host?>/list/single">Do</a>
							</li>
							
						</ul>
					</li>
				</ul>
			</div>

			<div class="subnav subnav-hidden">
				<div class="subnav-title">
					<a href="<?php echo $host?>/site/#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Help</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="<?php echo $host?>/site/#">Documentation</a>
					</li>
					<li class='dropdown'>
						<a href="<?php echo $host?>/site/#" data-toggle="dropdown">License</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo $host?>/site/#">Usage Rights</a>
							</li>
							<li>
								<a href="<?php echo $host?>/site/#">Sharing Rights</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $host?>/site/#">Security settings</a>
					</li>
				</ul>
			</div>

			
		</div>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $title ?></h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='satgreen'>
								<i class="fa fa-tasks"></i>
								<div class="details">
									<span class="big"><?php echo Set::getCount(); ?></span>
									<span>Approved Set</span>
								</div>
							</li>
							<li class='lightred'>
								<i class="fa fa-exclamation-triangle"></i>
								<div class="details">
									<span class="big"><?php echo Blacklist::getCount(array('status' => 1)); ?></span>
									<span>Blacklisted Numbers</span>
								</div>
							</li>f
						</ul>
					</div>
				</div>
            <?php
                if (isset($url)) :
                    # code...
                    $url = $_REQUEST['url'];
                    $arrUrl = explode('/',$url);

                    $_SESSION['host'] = $host;

                
            ?>
				<div class="breadcrumbs">
					<ul>
                        <li>
                            <a href="<?php echo $host?>/">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <?php foreach ($arrUrl as $link) :?>
						<li>
                            <a href="<?php echo $host . "/" . $link ?>"><?php echo ucfirst($link )?></a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                    <?php endforeach; ?>
					</ul>
					<div class="close-bread">
						<a href="<?php echo $host?>/site/#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
            <?php endif ?>