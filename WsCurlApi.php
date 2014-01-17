<?php

namespace WsCurlApi;

/**
 * WsCurlApi class
 *
 * @package    WS api
 * @author     Vytautas Beliunas <vytautas@double.lt>
 * @version    1.0
 */
class WsCurlApi {

    /**
     * WS administrator created username
     *
     * @var string $username
     */
    protected $username;

    /**
     * WS administrator created secret unique api key
     *
     * @var string $apiKey
     */
    protected $apiKey;

    /**
     * WS system root url
     *
     * @var string $apiUrl
     */
    protected $apiUrl;

    /**
     * Format to get result
     *
     * @var string $format
     */
    protected $format;

    /**
     * Format for curl request
     *
     * @var string $format
     */
    protected $method;

    public function __construct()
    {
        //det dafault values
        $this->format = 'json'; 
        $this->method = 'GET';
    }

    /**
     * Call curl url
     *
     * @param string $url - url from documentation http://ws.kotrynagroup.com/web/api/doc
     * @param array $postData
     * @return mixed
     */
    public function call($url, $postData = array())
    {
        $fullUrl = $this->apiUrl . $url;

        // set format automatically from url
        $this->setFormatFromUrl($url);

        $ch = curl_init($fullUrl);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->prepareCurlHeaders());

        if (!empty($postData)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData) );
        }

        $result = curl_exec($ch);

        return $result;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * Extract format.
     * Default json
     *
     * @param $url
     */
    public function setFormatFromUrl($url)
    {
        $this->format = 'json';

        $urlParts = parse_url($url);

        if (isset($urlParts['path'])) {
            $urlPathParts = explode('.', $urlParts['path']);
            if(sizeof($urlPathParts) > 1) {
                $format = end($urlPathParts);

                $this->format = $format;
            }
        }
    }

    /**
     * Prepare curl header content
     *
     * @return array
     */
    protected function prepareCurlHeaders()
    {
        return array(
            'Accept: application/' . $this->format,
            'Content-Type: application/' . $this->format,
            'x-wsse: Username="' . $this->username . '", ApiKey="' . $this->apiKey . '"'
        );
    }
}
