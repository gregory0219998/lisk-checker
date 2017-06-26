# Lisk-checker
Current version: 2.0


ORIGINAL SCRIPT https://github.com/lepetitjan/shift-checker
MODIFIED BY GREGORST

## Prerequisites
Be sure that your php.ini allows passthru(). It's default that it does though, so just check if this script is not working.
```
sudo apt install php php-cli php-mbstring php-sqlite3
```
* lisk-snapshot.sh: https://github.com/gregory0219998/lisk-snapshot

This script checks the status of your Lisk Delegate by using PHP.<br>
Feel free to rewrite in Python or Bash. 
 
This script will also check whether your node has forked or not.<br>
When forked, it will stop Lisk, restore to previous snapshot, and start Lisk again.
  
This script will also check your consensus and switch forging to your backup node.<br>
When both nodes have a bad consensus, it will restart Shift and let you know by sending a Telegram message.

<b>IMPORTANT TO MENTION</b>
If you want to use the consensus controller, you need to add your secret(s) to config.php and remove them from your Lisk config.json, also use domain with ssl with valid certificate. 
Also, you have to give access to the forging API calls for both nodes. Like this (1.2.3.4 is the extra IP):
```
    "forging": {
        "force": false,
        "secret": [],
        "access": {
            "whiteList": [
                "127.0.0.1","1.2.3.4",
            ]
        }
    },
```


There are some echo lines in this file.<br>
When you redirect output to a log file in your crontab, these lines will show up. <br>
See section Example crontab for more information.

Be sure to run this script after:
* You have installed lisk-snapshot
* You have created a snapshot with lisk-snapshot



## Installation
You can clone this into every directory of your choosing. I usually just clone it into my home folder.
```
git clone https://github.com/gregory0219998/lisk-checker
```
* Change settings inside config.php to match your needs
* Edit your crontab with the example below

## Example crontab
```
* * * * * php ~/lisk-checker/checkdelegate.php >> ~/lisk-checker/logs/checkdelegate.log 2>&1
```

## Telegram bot
Shift-Checker comes with Telegram functionality which will allow shfit-checker to send you a message if anything requires your attention. It's very easy to set up: 
* Open Telegram and start a conversation with: <b>userinfobot</b>
* Put your ID inside variable $telegramId. 
```
$telegramId = "12345678";
```
* Start a conversation with: <b>botfather</b>
* Say: /newbot
* Tell botfather your bot's name
* Tell botfather your bot's username
* Botfather will say "Congratulations!" and give you a token
* Put your token inside variable $telegramApiKey. 
```
$telegramApiKey 	= "1122334455:AAEhBOweik6ad9r_QXMENQjcrGbqCr4K-bs";
```
* Edit the telegram toggle (true/false)
* Start a conversation with your bot (username) to enable communication between you two

## Original creator Contacts 
* Twitter: [@lepetitjan](https://twitter.com/lepetitjan) 
* ShiftNrg E-mail: [jan@shiftnrg.org](mailto:jan@shiftnrg.org) 



## Contributors
Seatrips (create snapshot when status is okay)
* Twitter: [@seatrips<br>](https://twitter.com/seatrips)
Gregorst (script converted to lisk)

Mrgr (Shift snapshots)
* Shiftnrg Slack: https://shiftnrg.slack.com/team/mrgr
* Github: https://github.com/mrgrshift
