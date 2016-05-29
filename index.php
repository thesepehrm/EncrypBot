<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('222942975:AAGV3w63SwXLZMoFa6rKnkYVrP5cICcKTzA');
$url = ''; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));

try {

    if($update->message->text == '/email')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "You can send email to : sepehr@mohammadi.io"
     	]);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands :\n /email -> Get email address of the owner \n /latest -> Get latest posts of the blog 
    		/help -> Shows list of available commands"
    		]);

    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$str = $update->message->text;
    	if(strpos($str,'/enc') {
    		$str=substr($str,5,strlen($str)-4);
    	}
    	
		$str_length = strlen($str);
		for ($i = 0; $i < $str_length; $i++) {
			$chcode=ord($str[$i]);
			
			if ($chcode > 96 && $chcode < 123) {
				$chcode = (($chcode-84)%26 + 97);
			}
			else if ($chcode > 64 && $chcode < 91) {
				$chcode = (($chcode-52)%26 + 65);
			}
			else if ($chcode > 48 && $chcode < 58) {
				$chcode = (($chcode-43)%10 + 48);
    		}
			$str[$i] = chr($chcode);
		}
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => $str
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
