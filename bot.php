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
					$text = $text . 'ตอง : 0867746112' . "\n";
				}
				if ((stripos($textR, "หมี") !== false) || (stripos($textR, "บอล") !== false)) {
					$text = $text . 'บอลหมี : 0972344867' . "\n";
				}
				if (stripos($textR, "เอก") !== false) {
					$text = $text . 'พี่เอก : 0855561410' . "\n";
				}
				if (stripos($textR, "อิ่ม") !== false) {
					$text = $text . 'พี่อิ่ม : 0897439709' . "\n";
				}
				if (stripos($textR, "นัท") !== false) {
					$text = $text . 'พี่นัท : 0863741644' . "\n";
				}
				if (stripos($textR, "เก่ง") !== false) {
					$text = $text . 'พี่เก่ง : 0867818754' . "\n";
				}
				if (stripos($textR, "แม็ก") !== false) {
					$text = $text . 'พี่แม็ก : 0868179481' . "\n";
				}
				if (stripos($textR, "น็อต") !== false) {
					$text = $text . 'พี่น็อต : 0812874722' . "\n";
				}
				if (stripos($textR, "ตาล") !== false) {
					$text = $text . 'พี่ตาลเล็ก : 0864119958' . "\n";
				}
				if (stripos($textR, "นัท") !== false) {
					$text = $text . 'นัทสูง : 0634016665' . "\n";
				}
				if (stripos($textR, "ตั้ม") !== false) {
					$text = $text . 'พี่ตั้ม : 0869942364' . "\n";
				}
				if (stripos($textR, "ตี") !== false) {
					$text = $text . 'พี่ตี : 0896972514' . "\n";
				}
				if (stripos($textR, "ตาล") !== false) {
					$text = $text . 'พี่ตาลใหญ่ : 0896674667' . "\n";
				}
				if (stripos($textR, "พี่วง") !== false) {
					$text = $text . 'พี่วงศ์ : 0815842454' . "\n";
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
				$text = $text . "MSG Des : " . textStart($aaa,"Message","</td>",110,$GLOBALS["SvPost"]). "\n";
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