<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

// Create a client to request
$client = new Client(['base_uri' => 'https://coderbyte.com/api/']);
$response = $client->request('GET', 'challenges/json/age-counting');

// Get content data then parse the json
$data = $response->getBody()->getContents();
$json_data = json_decode($data, true);
$items = explode(', ', $json_data['data']);

$i = 0;

foreach ($items as $item) {
    if (strpos($item, 'age=') !== false) {
        $age = explode('=', $item)[1];
        if ($age >= 50) {
            $i = $i + 1;
        }
    }
}

echo $i; // 128
