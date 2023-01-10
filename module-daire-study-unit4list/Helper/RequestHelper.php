<?php

namespace Lumav\DaireStudyUnit4list\Helper;

use Lumav\DaireStudyUnit4list\Model\Vendor;
use Magento\Framework\App\Request\Http;

class RequestHelper
{
    protected $httpRequest;

    public function __construct(Http $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function getUrlParamByKey($key)
    {
        $paramValue = $this->httpRequest->getParam($key);
        return $paramValue;
    }

    public function getAllParams()
    {
        return $this->httpRequest->getParams();
    }
}
