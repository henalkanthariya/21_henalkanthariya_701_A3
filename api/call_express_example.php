<?php
// Example: call an express API (http://localhost:3000/echo)
$ch = curl_init('http://localhost:3000/echo');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['msg'=>'Hello from PHP']);
$res = curl_exec($ch);
echo $res;
?>