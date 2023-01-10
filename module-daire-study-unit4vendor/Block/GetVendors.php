<?php

namespace Lumav\DaireStudyUnit4vendor\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Lumav\DaireStudyUnit4vendor\Model\ResourceModel\Vendors;
use Magento\Framework\Registry;



class GetVendors extends Template
{
    private $vendor;
    private $registry;

    public function __construct(Context $context, Vendors $vendor, Registry $registry)
    {
        
        $this->vendor = $vendor;
        $this->registry = $registry;
        parent::__construct($context);
    }


    public function getVendors()
    {
        $productId = $this->getCurrentProduct();
        $vendors = $this->vendor->getVendorsByProdId($productId);
        return $vendors;
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product')->getId();
    }
}