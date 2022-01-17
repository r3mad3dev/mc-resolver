<?php
// Created by Puddy
// 2019
// I seen resolvers online and never knew how they worked but this is my own copy.
// it can be improved alot but it works fine.

// USAGE
// http://127.0.0.1/McResolver.php?user=Puddy
// yourdomain.com/McResolver.php?user={username}
// McResolver.php?user={username}
 
// Mojang API CLASS
// I did not create the (mojang-api.class.php) class
// You can find it and the creator here https://github.com/MineTheCube/MojangAPI

// Confused?
// This is a minecraft IP Resolver..
// Type the user name and it will search through a database of textfiles like username:ip
// You can find these databases online but you can also use this source for other things.

if ($_GET["user"]) {
	$user = $_GET["user"];
	// Start of testing for input errors such as special chars and length.
	require 'mojang-api.class.php';
	if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $user))
	{
		echo "Username can not contain them special chars.";
		
	} else if (strlen($user) < 3) {
		echo "Name is less then 3..";
		
	} else if (strlen($user) > 16) {
		echo "Username contains more then 16 chars.";
		
	} else // After running all test so the script dont bust.
		{
		$dbnum = 0;
		$dir = 'databaselists/'; // Needs to be change depending on database directory
		$files = array("DB1.txt","DB2.txt"); // this means it'll seach DB1 and DB2 for the username. if its a big database it needs to be split up or it will crash.
		$Numberofdatabases = 2; // theres 2 databases in this case.
		$userimgsize = 70; // 70px - 70px
		echo '<img src="https://minotar.net/bust/'.$user.'/'.$userimgsize.'.png"/>';
		echo "<br> <b>Found IP's</b> <br>";
		foreach ($files as $lines){
			$contents = file_get_contents($dir . $lines);
			$pattern = preg_quote($user, '/');
			$pattern = "/^.*$pattern.*\$/m";
		
		if(preg_match_all($pattern, $contents, $matches)){
			echo '<span style="color:black;">'.implode($matches[0])."</span><br>";
			}
			
			else{
				
				++$dbnum; // dbnum means how many databases has been searched and to keep up with if theres nothing found.
				
				}
			}
		if($dbnum == $Numberofdatabases){
			
			echo "<p><b>No matches found :(</b><br></p>";
			echo 'Go to https://namemc.com/search?q='.$user;
			echo "<br>and find there older usernames and search for it here.</p>";
		}
		else{
			
			echo '<br> <b> Other lookups </b> <br>';
			$uuid = MojangAPI::getUuid($user);
			echo '<span style="color:black;">UUID : '.$uuid.'</span>';

			}
		} 
	}
	