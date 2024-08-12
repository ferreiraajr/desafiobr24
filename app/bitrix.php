<?php

function webhook($endpoint, $data)
{

    $webhook = env('BITRIX_WEBHOOK');
    $curl = curl_init($webhook . $endpoint);

    curl_setopt_array($curl, array(
        CURLOPT_HEADER => 0,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true
    ));

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, 1);
}
?>
