<?php
define('DEVELOPMENT_ENVIRONMENT', TRUE);
define('DEFAULT_CONROLLER', 'dashboard');
define('DEFAULT_ACTION', 'index');

define('BASE_PATH', '/Library/Webserver/Documents/blacklist/');

define('TEMP_UPLOAD_PATH', BASE_PATH . 'temp/');
define('FILE_PATH', BASE_PATH . 'public/site/files/');
define('EMAIL_HEADER', "From: Admin <maspblacklist@etisalat.com.ng>" . "\r\n" . "BCC: blacklist@advancedtechnologypark.com");

define('ROOT_URL', 'http://localhost/blacklist/');

define('DB_HOST','localhost');
define('DB_NAME','blacklist');
define('DB_USER','root');
define('DB_PASS','available');

?>