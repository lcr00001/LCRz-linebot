<?php
$access_token = 'Kdp+YAGfXz1cL5KUn8WVHnIsZPGGKbA/AybSpJKE6IZcB6hx18xr7/l5DpQR5/bls8gkzgSs/CqQsNWRtyFmEE3lWC943I3MFQ04ns/jXdzI6WsRjLMSMSkcHuEKdYKG7KYlgfmgI2zq7SIYnzMWJwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;