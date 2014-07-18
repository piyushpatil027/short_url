<?php

class Short_Url {

    private $objPiyushApi;

    public function __construct() {
        $this->objPiyushApi = new PiyushAPIClass(GOOGLE_API_KEY);
    }

    public function setShortUrl($longUrl) {
        return $this->objPiyushApi->piyushGetShortUrl($longUrl);
    }

    public function getLongUrl($shortUrl) {
        return $this->objPiyushApi->piyushGetLongUrl($shortUrl);
    }

}
