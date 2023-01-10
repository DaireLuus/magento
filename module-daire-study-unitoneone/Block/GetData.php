<?php

namespace Lumav\DaireStudyUnitoneone\Block;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;

class GetData
{
    const URL = "https://geo.ipify.org/";
    const KEY = "at_DldkSOXYeA5571KXdE2BaJj71e8fE";

    private $response;

    public function getData(){
        if(!$this->response){
            $this->response = $this->getResponse();
        }
        return $this->response;
    }

    private function getResponse(){
        $objctManager = \Magento\Framework\App\ObjectManager::getInstance();
        $remote = $objctManager->get('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');
        $customerIp = $remote->getRemoteAddress();

        $crl = curl_init();
        $timeout = 20;
        curl_setopt ($crl, CURLOPT_URL, self::URL . "api/v1?apiKey=" . self::KEY . "&ipAddress=" . $customerIp);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        
        return $ret;
    }

}
