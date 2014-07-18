<?php

class PiyushAPIClass {

    private $piyush_apiKey;
    public $piyush_error;
    public $piyush_keyWarning = true;

    //@ consructor  
    public function __construct($key = NULL) {
        $this->piyush_apiKey = $key;
    }

    //@ piyush patil. get method shory url.
    public function piyushGetShortUrl($longUrl) {
        $postData = array('longUrl' => $longUrl);
        if (!is_null($this->piyush_apiKey)) {
            $postData['key'] = $this->piyush_apiKey;
        }
        $jsonData = json_encode($postData);
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($curlObj);
        curl_close($curlObj);
        $json = json_decode($response);
        if ($this->piyushHasErrors($json)) {
            return false;
        } else {
            return $json->id;
        }
    }

    //@ piyush patil. get method long url.
    public function piyushGetLongUrl($shortUrl) {
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?shortUrl=' . $shortUrl);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($curlObj);
        curl_close($curlObj);
        $json = json_decode($response);
        if ($this->piyushHasErrors($json)) {
            return false;
        } else {
            return $json->longUrl;
        }
    }

    private function piyushHasErrors($json) {
        if ($this->piyush_keyWarning) {
            if (is_null($this->piyush_apiKey)) {
                echo 'API key is not assign';
            }
        }
        if (is_object($json)) {
            if (isset($json->error)) {
                foreach ($json->error->errors as $error) {
                    $this->piyush_error.= $error->message . ':' . $error->location . '; ';
                }
                return true;
            }
        } else {
            $this->piyush_error = 'Json Error';
            return true;
        }
    }

}

?>