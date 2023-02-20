<?php global $host ?>
<!doctype html>
<html>


<!-- Mirrored from www.eakroko.de/flat/more-error.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jun 2015 16:07:17 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>Blacklist - Error page</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/bootstrap.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $host?>/site/css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo $host?>/site/js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="<?php echo $host?>/site/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $host?>/site/js/bootstrap.min.js"></script>

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

<body class='error'>
	<div class="wrapper">
		<div class="code">
			<span>404</span>
			<i class="fa fa-warning"></i>
		</div>
		<div class="desc">Oops! Sorry, that page could'nt be found.</div>
		<form action="<?php echo $host?>/api/search" class='form-horizontal'>
			<div class="input-group">
				<input type="text" name="search" placeholder="Search Blacklist.." class='form-control'>
				<span class="input-group-btn">
					<button type='submit' class='btn'>
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<div class="buttons">
			<div class="pull-left">
				<a href="<?php echo $host?>/dashboard" class="btn btn--icon">
					<i class="fa fa-arrow-left"></i>Go to Dashboard</a>
			</div>
		</div>
	</div>
</body>


<!-- Mirrored from www.eakroko.de/flat/more-error.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jun 2015 16:07:17 GMT -->
</html>
