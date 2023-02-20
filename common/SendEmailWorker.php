<?php

	/*
	** @Gearman Worker
	** Send Email via an API
	*/
	require_once "SendMail.php";

	$worker = new GearmanWorker();
	$worker->addServer();

	$worker->addFunction("send_email", function(GearmanJob $job) {
	    $workload = json_decode($job->workload());
	    // print_r($workload);
	    // You would then, of course, actually call this:
	    sleep(5);
	    cmail($workload->email, $workload->subject, $workload->body, $workload->headers);
	});

	while ($worker->work());

	function cmail($to, $subject, $body, $from, $retry=FALSE){

		$headers = array(
		    'From' => $from,
		    'To' => $to,
		    'Subject' => $subject
		);

		$smtp = SendMail::getSession('ssl://smtp.gmail.com','465','maspblacklist@gmail.com','available247');
		$mail = $smtp->send($to, $headers, $body);

		if (PEAR::isError($mail)) {
		    echo date('Y-m-d H:i:s') . ' Email Failed to ' . $to . '. Reason:' . $mail->getMessage() . PHP_EOL;
			// Refresh Connection
			if(!$retry)cmail($to, $subject, $body, $from, TRUE);
			SendMail::destroy();
			 		    
		} else {
			echo date('Y-m-d H:i:s') . ' Email Successfully Sent to ' . $to .PHP_EOL ;
		}
	}

?>
