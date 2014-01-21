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

$postData =  array(
    'axaptaId' => '1010101-0042',
);
// metodas gauti vieno produkto likuti. Curl metodas turi buti GET
//$result = $wsApi->call('api/getStock.json', $postData);

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
//$result = $wsApi->call('api/order/new', $postData);

// metodas gauti visa assortimenta, Pasiekamas tik vidiniams retaileriams
$postData =  array(
    'division' => '101',
    'timeLine' => '-100days'
);

$wsApi->setMethod('GET');

header ("Content-Type:text/xml");

$result = $wsApi->call('api/getOurRetailerProducts.xml', $postData);

echo $result;