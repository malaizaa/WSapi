<?php

    $retailerName = 'testas';// WS sistemos administratoriaus priskirtas vardas
    $apiKey = '1fa69810cc94008aed4375e1d6fd613f';// WS sistemos administratoriaus priskirtas unikalus raktas

    // ##### 1 pvz. Metodas gauti visus likucius xml formatu

    $url = 'http://ws.kotrynagroup.com/web/api/getStocks.xml';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Accept: application/xml',
            'Content-Type: application/xml',
            'x-wsse: Username="' . $retailerName . '", ApiKey="' . $apiKey . '"'
        )
    );

    $result = curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // jei praejo be klaidu tai response status 200
    if ($httpcode == 200) {
        echo $result;

    } else {
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die();
    }

    // ##### 2 pvz. Metodas gauti vieno produkto likucius xml formatu

    $url = 'http://ws.kotrynagroup.com/web/api/getStock.json?axaptaId=1010101-0042';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'x-wsse: Username="' . $retailerName . '", ApiKey="' . $apiKey . '"'
        )
    );

    $result = curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // jei praejo be klaidu tai response status 200
    if ($httpcode == 200) {
        echo $result;
        die();
    } else {
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die();
    }

    // ##### 2 pvz. Metodas gauti visus likucius json formatu

    $url = 'http://ws.kotrynagroup.com/web/api/getStocks.json';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'x-wsse: Username="' . $retailerName . '", ApiKey="' . $apiKey . '"'
        )
    );

    $result = curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // jei praejo be klaidu tai response status 200
    if ($httpcode == 200) {
        echo $result;
        die();
    } else {
        // $result grazins klaidas
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die();
    }

    // ##### 3 pvz. Orderio pateikimas

    $url = 'http://ws.kotrynagroup.com/web/api/order/new';
    $ch = curl_init($url);

    // duomenys siunciami api
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
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData) );
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'x-wsse: Username="' . $retailerName . '", ApiKey="' . $apiKey . '"',
        )
    );

    $result = curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // jei praejo be klaidu tai response status 200
    if ($httpcode == 200) {
        echo $result;
        die();
    } else {
        // $result grazins klaidas
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die();
    }
