<?php

namespace Lumav\DaireStudyUnit3exchange\Block;

use Magento\Framework\View\Element\Template;

class ExchangeRate extends Template
{
    public function getExchangeRate() {
        // set API Endpoint and API key 
        $endpoint = 'latest';
        $access_key = '8d4e0ded7dfa18bd3be829bc33a3fcd8';

        // Initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        // Access the exchange rate values, e.g. GBP:
        echo $exchangeRates['rates']['USD'];
        

        }
    
}