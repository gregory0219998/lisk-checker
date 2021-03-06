<?php
// MODIFIED BY GREGORST
echo "[ STATUS ]\n";
echo "\t\t\tLet's check if our delegate is still running...\n";

// Check status with bash lisk.sh. Use PHP's ob_ function to create an output buffer
	ob_start();
  $check_status = passthru("cd $pathtoapp && bash lisk.sh status | cut -z -b1-3");
	$check_output = ob_get_contents();
	ob_end_clean();

// If status is not OK...
  if(strpos($check_output, $okayMsg) === false){
   		
	  // Echo something to our log file
   	echo "\t\t\tDelegate not running/healthy. Let me restart it for you...\n";
   	if($telegramEnable === true){
   		$Tmsg = "Delegate ".gethostname()." not running/healthy. I will restart it for you... :D ";
   		passthru("curl -s -d 'chat_id=$telegramId&text=$Tmsg' $telegramSendMessage >/dev/null");
   	}
   	
    echo "\t\t\tStopping all forever processes...\n";
   		passthru("cd $pathtoapp && bash lisk.sh stop >/dev/null");
   	echo "\t\t\tStarting Lisk  proces...\n";
   		passthru("cd $pathtoapp && bash lisk.sh start >/dev/null");
   // MODIFIED BY GREGORST
  }else{
  	echo "\t\t\tDelegate is still running...\n";
  }
