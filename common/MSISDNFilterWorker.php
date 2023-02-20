<?php

	ini_set('memory_limit', '-1');
	error_reporting(0);

	require './system/config/config.php';
	require BASE_PATH . 'common/Utils.class.php';
	require BASE_PATH . 'lib/Database.class.php';
	require BASE_PATH . 'lib/Model.class.php';
	require BASE_PATH . 'lib/CacheModel.class.php';
	require BASE_PATH . 'system/config/config.php';
	require BASE_PATH . 'common/model/ParentList.class.php';
	require BASE_PATH . 'common/model/Blacklist.class.php';
	require BASE_PATH . 'common/model/DNCList.class.php';

	$worker = new GearmanWorker();
	$worker->addServer();
	$worker->addFunction("process_filter_file", "filter_file");
	while ($worker->work());	

	function filter_file($job){

		$workload = json_decode($job->workload());

		Utils::trace('Starting Filtering Process' . var_export($workload));

		//Setup database
		Database::getInstance('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);

		$uploadedCSVArray = array_map('str_getcsv', file($workload->file));

	    $uploadedMSISDN = array();
	    foreach($uploadedCSVArray as $s)
	        $uploadedMSISDN[]= filter_var($s[0], FILTER_SANITIZE_NUMBER_INT);

		
		$dbMSISDN = Blacklist::justGet('SELECT DISTINCT(msisdn) FROM list');

	    if (!empty($dbMSISDN))
	        $filteredMSISDN = flip_isset_diff($uploadedMSISDN, $dbMSISDN);
	    else
	        $filteredMSISDN = $uploadedMSISDN;

	    $downloadFile = implode("\n", $filteredMSISDN);


	    $newfile = FILE_PATH . $workload->user_name . time() . '.csv';
	    file_put_contents($newfile, $downloadFile);

	    Utils::sendmail($workload->user_email, $subject, $body, $headers)

	    // $disposition = 'Content-Disposition: attachment; filename="' . $workload->user . time() .'"';
	    // header('Content-Type: application/text');
	    // header($disposition);
	    // header('Content-Length: ' . strlen($downloadFile));
	    // echo $downloadFile;

	}


	/**
	 * This function simply computes the difference between arrays and returns the difference.
	 * It does this by flipping one of the arrays.
	 * @param $uploadedMsisdn
	 * @param $msisdnFromDB
	 * @return array
	 */
	function flip_isset_diff(&$uploadedMsisdn, &$msisdnFromDB) {
		echo 'Blacklist Count: ' . count($msisdnFromDB);
		echo 'uploadedMsisdn Count: ' . count($uploadedMsisdn);
	    $flippedArray = array_flip($msisdnFromDB);
	    $d = array();
	    foreach ($uploadedMsisdn as $i)
	        if (!isset($flippedArray[$i]))
	            $d[] = $i;
	    return $d;
	}

?>
