<?php

$curl = curl_init();

$url1 = "http://192.168.0.107/api/v2/tenants/1/apply_changes";
curl_setopt_array($curl, array(
    CURLOPT_URL => $url1,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "UPDATE",
    CURLOPT_HTTPHEADER => array(
        'app-key: e1162ab9adef65fc0f54f11b7a1caf7b',
        "tenant: 1"
    )
));
$response = curl_exec($curl);
var_dump($response);
