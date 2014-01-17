<?php
require 'config.php';
require 'WsCurlApi.php';

use WsCurlApi\WsCurlApi;

// Objekto inicializavimas
$wsApi = new WsCurlApi();
$wsApi->setUsername($config['username']);
$wsApi->setApiKey($config['apiKey']);
$wsApi->setApiUrl($config['apiUrl']);

// Metodas gauti visus likucius xml formatu
//$result = $wsApi->call('api/getStocks.xml');

// metodas gauti visus likucius json formatu
//$result = $wsApi->call('api/getStocks.json');

// metodas gauti vieno produkto likuti
//$result = $wsApi->call('api/getStock.json?axaptaId=1010101-0042');

// metodas sukurti nauja uzsakyma
$postData =  array(
    "order"=> array(
        'retailerOrderId' => 20,
        'comments' => 'Test WS API order',
        'products' => array(
            array(
                'axaptaId' => '1010101-0042',
                'quantity' => 2,
            ),
        )
    ),
);

$wsApi->setMethod('POST');
$result = $wsApi->call('api/order/new', $postData);