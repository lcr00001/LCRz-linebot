<?php
$access_token = 'Kdp+YAGfXz1cL5KUn8WVHnIsZPGGKbA/AybSpJKE6IZcB6hx18xr7/l5DpQR5/bls8gkzgSs/CqQsNWRtyFmEE3lWC943I3MFQ04ns/jXdzI6WsRjLMSMSkcHuEKdYKG7KYlgfmgI2zq7SIYnzMWJwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$textR = $event['message']['text'];
			if (stripos($textR, "เบอร์") !== false) {
				if (stripos($textR, "ตอง") !== false) {
					$text = 'ตอง : 0867746112';
					echo 'ตอง : 0867746112';
				}
				if ((stripos($textR, "หมี") !== false) || (stripos($textR, "บอล") !== false)) {
					$text = 'บอลหมี : 0972344867';
					echo 'บอลหมี : 0972344867';
				}
			}
			if (stripos($textR, "Spoil") !== false) {
				$ch2 = curl_init('http://thaionepiece.com/board/viewforum.php?f=6');
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_BINARYTRANSFER, true);
				$aaa = curl_exec($ch2);
				//$pos = strpos($aaa,"topictitle");
				$text = textStart($aaa,"topictitle","</a>",12,1);	
			}
			

			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}

function textStart($textr,$textf,$textt,$fl, $st){
					$pos = strpos($textr,$textf,$st);
					$pos2 = strpos($textr,$textt,$pos+1);
					$txt = substr($textr,$pos+$fl,$pos2 - ($pos+$fl));	
					return $txt;
				}