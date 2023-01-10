<?php

namespace Lumav\DaireStudyUnit4list\Block;

use Lumav\DaireStudyUnit4list\Helper\RequestHelper;
use Lumav\DaireStudyUnit4list\Model\VendorRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class VendorDetails extends Template
{
    protected $vendorRepository;
    protected $requestHelper;

    public function __construct(
        Context $context,
        array $data = [],
        VendorRepository $vendorRepository,
        RequestHelper $requestHelper
    ) {
        parent::__construct($context, $data);
        $this->vendorRepository = $vendorRepository;
        $this->requestHelper = $requestHelper;
    }

    public function getVendorWProducts($vendorId)
    {

        return $this->vendorRepository->getVendorWProducts($vendorId);
    }

    public function getCurrentVendorId()
    {
        return $this->requestHelper->getUrlParamByKey('id');
    }
}
