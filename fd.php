<?php

$url = "https://knackmap.freshdesk.com/api/v2/tickets";

//The JSON data.
$jsonData["email_addresses"] = array(
    'email' => 'jv.privado@yahoo.com',
    'field' => 'EMAIL1'
);
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "hello@knackmap.com:Knackmap123");



//Attach our encoded JSON string to the POST fields.
//curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$result = curl_exec($ch);

?>