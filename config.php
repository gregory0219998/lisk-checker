<?php
	/**
	 * @author original script Jan
	 * @modified Gregorst
	 * @link original script https://github.com/lepetitjan/shift-checker
	 * @license https://github.com/lepetitjan/shift-checker/blob/master/LICENSE
	 */

/*  GENERAL CONFIG
__________________________ */

// You should have installed Lisk-Checker as normal user, so the line below should work by default.
// However, if you installed as root (please don't..) change the path below to $homeDir = "/root/";
    $homeDir        = "/home/".get_current_user()."/";

// You may leave the settings below as they are...
	$date		= date("Y-m-d H:i:s");			// Current date
	$pathtoapp	= $homeDir."lisk-main/";		// Full path to your lisk installation	
	$baseDir	= dirname(__FILE__)."/";		// Folder which contains THIS file
	$lockfile	= $baseDir."checkdelegate.lock";	// Name of our lock file
	$database	= $baseDir."check_fork.sqlite3";	// Database name to use
	$table 		= "forks";				// Table name to use
	$msg 		= "\"cause\":3";			// Message that is printed when forked
	$lisklog 	= $pathtoapp."logs/lisk.log";		// Needs to be a FULL path, so not ~/lisk-main
	$linestoread	= 30;					// How many lines to read from the end of $lisklog
	$max_count 	= 3;					// How may times $msg may occur
	$okayMsg 	= "√";					// 'Okay' message from bash lisk.sh 

// Consensus settings
/// Please use a valid ssl certificate and a domain, not ip
	$consensusEnable= false;                                // Enable consensus check? Be sure to check $nodes first..
	$master         = true;                                 // Is this your master node? True/False
	$masternode     = "https://lisk1.yourdomain.org";       // Master node
	$masterport     = 2443;                                 // Master port
	$slavenode      = "https://lisk2.yourdomain.org";      // Slave node
	$slaveport      = 2443;                                 // Slave port
	$threshold      = 50;                                   // Percentage of consensus threshold
	$apiHost        = "https://login.lisk.io/";	// Used to calculate $publicKey by $secret. Use $masternode or $slavenode
	$secret         = array("");                            // Add your secrets here. If you want to forge multiple, add extra to the array. 

// Snapshot settings
// LEAVE IT TO FALSE Function not developed yet
// DO NOT MODIFY
	$snapshotDir	= $homeDir."lisk-snapshot/";	// Base folder of lisk-snapshot
// DO NOT MODIFY
	$createsnapshot	= false;					// Do you want to create daily snapshots?
// DO NOT MODIFY
	$max_snapshots	= 3;					// How many snapshots to preserve? (in days)

// Log file rotation
	$logfile 	= $baseDir."logs/checkdelegate.log";	// The location of your log file (see section crontab on Github)
	$max_logfiles	= 3;					// How many log files to preserve? (in days)  
	$logsize 	= 524280;				// Max file size, default is 5 MB

// Telegram Bot
/// real time monitoring
	$telegramId 	= ""; 					// Your Telegram ID
	$telegramApiKey = ""; 					// Your Telegram API key 
	$telegramEnable = false;				// Change to true to enable Telegram Bot
	$telegramSendMessage 	= "https://api.telegram.org/bot".$telegramApiKey."/sendMessage"; // Full URL to post message
?>
