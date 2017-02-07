<?php
$access_token = 'Kdp+YAGfXz1cL5KUn8WVHnIsZPGGKbA/AybSpJKE6IZcB6hx18xr7/l5DpQR5/bls8gkzgSs/CqQsNWRtyFmEE3lWC943I3MFQ04ns/jXdzI6WsRjLMSMSkcHuEKdYKG7KYlgfmgI2zq7SIYnzMWJwdB04t89/1O/w1cDnyilFU=';

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
			$textR = strtoupper($event['message']['text']);
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
			if (stripos($textR, "SPOIL") !== false) {
				$ch2 = curl_init('http://thaionepiece.com/board/viewforum.php?f=6');
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_BINARYTRANSFER, true);
				$aaa = curl_exec($ch2);
				$save = 1;

				for ($x = 1; $x <= 20; $x++){
					$textz = textStart($aaa,"topictitle","</a>",12,$save);
					$save = $GLOBALS["SvPost"];
					$text = $text.$textz ."\n";
				}
			}

			if (stripos($textR, "RPG:") !== false) {
				$ctyp = substr($textR, 4,3);
				$ccde = substr($textR, 7);
				$ch2 = curl_init('http://www.iseriesworld.net/?messages=rpg&prefix='.$ctyp.'&code='.$ccde);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_BINARYTRANSFER, true);
				$aaa = curl_exec($ch2);

				$text = "MSG ID : " . textStart($aaa,"Message ID","</h1>",106,1) . "\n";
				$text = $text . "MSG Des : " . textStart($aaa,"Message","</tr>",110,$GLOBALS["SvPost"]). "\n";
				$text = $text . "Cause : " . textStart($aaa,"Cause<","</td>",108,$GLOBALS["SvPost"]). "\n";
				$text = $text . "Recovery : " . textStart($aaa,"Recovery","</td>",111,$GLOBALS["SvPost"]). "\n";
				//echo $text;
			}

			if (stripos($textR, "CLP:") !== false) {
				$ctyp = substr($textR, 4,3);
				$ccde = substr($textR, 7);
				$ch2 = curl_init('http://www.iseriesworld.net/?messages=cl&prefix='.$ctyp.'&code='.$ccde);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_BINARYTRANSFER, true);
				$aaa = curl_exec($ch2);

				$text = "MSG ID : " . textStart($aaa,"Message ID","</h1>",106,1) . "\n";
				$text = $text . "MSG Des : " . textStart($aaa,"Message","</tr>",110,$GLOBALS["SvPost"]). "\n";
				$text = $text . "Cause : " . textStart($aaa,"Cause<","</td>",108,$GLOBALS["SvPost"]). "\n";
				$text = $text . "Recovery : " . textStart($aaa,"Recovery","</td>",111,$GLOBALS["SvPost"]). "\n";
				//echo $text;
			}

			if (stripos($textR, "HELP") !== false) {
				$text = "เบอร์ <ชื่อ>" . "\n";
				$text = $text ."RPG: <Code> (ex. RPG:CPF7030)" . "\n";
				$text = $text ."CLP: <Code> (ex. CLP:CPF7030)" . "\n";
				//echo $text;
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
					$pos2 = strpos($textr,$textt,$pos+$fl);
					$GLOBALS["SvPost"] = $pos2;
					$txt = substr($textr,$pos+$fl,$pos2 - ($pos+$fl));
					return $txt;
				}