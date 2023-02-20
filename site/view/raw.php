<?php

header('Content-Type: text/plain');

// $check = Utils::checkAccess();

// if($check === TRUE){

	if (isset($response) && !is_array($response)){

		if (($handle = fopen($response, "r")) !== FALSE) {
		    $count = 0;
		    while (($data = fgetcsv($handle, 20, "\n")) !== FALSE) {

		        $msisdn = $data[0];
		        echo $msisdn . PHP_EOL;
		       
		    }

		    fclose($handle);
		}else{
			echo $response;
		}

	}elseif(isset($response) && is_array($response)){
		// Utils::printOut($response);
		foreach ($response as $list) {
			echo $list->getMsisdn(). "\n";
		}
	}else{
		echo 'Output Buffer Not Set';
	}

// }else{
// 	echo '501:' . $default;
// }


?>