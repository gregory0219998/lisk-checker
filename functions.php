<?php

// Tail function
function tailCustom($filepath, $lines = 1, $adaptive = true) {

	// Current date
	$date = date("Y-m-d H:i:s");

	// Open file
	$f = @fopen($filepath, "rb");
	//if ($f === false) return false;
	if ($f === false) return $date." - [ FORKING ] Unable to open file!\n";

	// Sets buffer size, according to the number of lines to retrieve.
	// This gives a performance boost when reading a few lines from the file.
	if (!$adaptive) $buffer = 4096;
	else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

	// Jump to last character
	fseek($f, -1, SEEK_END);

	// Read it and adjust line number if necessary
	// (Otherwise the result would be wrong if file doesn't end with a blank line)
	if (fread($f, 1) != "\n") $lines -= 1;

	// Start reading
	$output = '';
	$chunk = '';

	// While we would like more
	while (ftell($f) > 0 && $lines >= 0) {

		// Figure out how far back we should jump
		$seek = min(ftell($f), $buffer);

		// Do the jump (backwards, relative to where we are)
		fseek($f, -$seek, SEEK_CUR);

		// Read a chunk and prepend it to our output
		$output = ($chunk = fread($f, $seek)) . $output;

		// Jump back to where we started reading
		fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

		// Decrease our line counter
		$lines -= substr_count($chunk, "\n");

	}

	// While we have too many lines
	// (Because of buffer size we might have read too many)
	while ($lines++ < 0) {

		// Find first newline and remove all text before that
		$output = substr($output, strpos($output, "\n") + 1);

	}

	// Close file and return
	fclose($f);
	return trim($output);

}

// Log rotation function
function rotateLog($logfile, $max_logfiles=3, $logsize=10485760){

	// Current date
	$date = date("Y-m-d H:i:s");
	
	if(file_exists($logfile)){
		
		// Check if log file is bigger than $logsize
		if(filesize($logfile) >= $logsize){
			echo $date." - [ LOGFILES ] Log file exceeds size: $logsize. Let me rotate that for you...\n";
			$rotate = passthru("gzip -c $logfile > $logfile.".time().".gz && rm $logfile");
			if($rotate){
				echo $date." - [ LOGFILES ] Log file rotated.\n";
			}
		}else{
			echo $date." - [ LOGFILES ] Log size has not reached the limit yet. (".filesize($logfile)."/$logsize)\n";
		}

		// Clean up old log files
		echo $date." - [ LOGFILES ] Cleaning up old log files...\n";
			$logfiles = glob($logfile."*");
		  	foreach($logfiles as $file){
		    	if(is_file($file)){
		      		if(time() - filemtime($file) >= 60 * 60 * 24 * $max_logfiles){
		        		if(unlink($file)){
		        			echo $date." - [ LOGFILES ] Deleted log file $file\n";
		        		}
		      		}
		    	}
		  	}

	}else{
		echo $date." - [ LOGFILES ] Cannot find a log file to rotate..\n";
	}
}

// Get balance
function getBalance($host, $address){
	// Current date
	$date = date("Y-m-d H:i:s");

	if(!empty($host) $$ !empty($address)){
		ob_start();
	   	$getBal 		= passthru("curl -k -X GET '$host/api/accounts/getBalance?address=$address'");
		$getBalOutput 	= ob_get_contents();
		ob_end_clean();

		if(!empty($getBalOutput)){
			return $getBalOutput."\n";
		}else{
			return $date." - [ BALANCE ] Something went wrong whilst getting a balance.\n";
		}
	}else{
		return $date." - [ BALANCE ] You forgot something...Did you enter a host and address?\n";
	}
}