<?php

namespace Lumav\DaireStudyFreegeo\Block;

use Magento\Framework\View\Element\Template;

/**
 * @category  Lumav
 * @package   Lumav_FreeGeoIp
 * @copyright Copyright (c) 2020 Lumav OÜ (http://www.lumav.com)
 */
class GetFreeGeo extends Template
{

    public function getGeoLocation() {
        $ip = $this->getIpAddress();
        $api_key = 'at_DldkSOXYeA5571KXdE2BaJj71e8fE';
        $api_url = 'https://geo.ipify.org/api/v1';
        $url = "{$api_url}?apiKey={$api_key}&ipAddress={$ip}";
        $ret = file_get_contents($url);
        $ret = json_decode($ret, true);

        return $ret['location']['country'];
    }

    private function getIpAddress() {  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }  
        else {  
            $ip = $_SERVER['REMOTE_ADDR'];
        }  
        return $ip;  
    }  
}
