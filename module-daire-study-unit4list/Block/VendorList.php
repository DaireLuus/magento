<?php

namespace Lumav\DaireStudyUnit4list\Block;

use Lumav\DaireStudyUnit4list\Helper\RequestHelper;
use Lumav\DaireStudyUnit4list\Model\Vendor;
use Lumav\DaireStudyUnit4list\Model\VendorRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;

class VendorList extends Template
{
    protected $registry;
    protected $vendorRepository;
    protected $requestHelper;
    protected $vendorSorter;

    public function __construct(
        Context $context,
        array $data = [],
        Registry $registry,
        VendorRepository $vendorRepository,
        RequestHelper $requestHelper,
        VendorSorter $vendorSorter
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vendorRepository = $vendorRepository;
        $this->requestHelper = $requestHelper;
        $this->vendorSorter = $vendorSorter;
    }

    public function getVendorsByProductId($productId)
    {
        $vendors = $this->vendorRepository->getVendorsByProdId([$productId]);
        return $vendors;
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product')->getId();
    }

    private function fetchFilterValues($reqParams)
    {
        return array_filter($reqParams,
            function ($a) {
                return $a !== Vendor::VENDOR_LIST_SORTING_PARAM && $a !== Vendor::VENDOR_LIST_SORTING_DIRECTION_PARAM;
            }, ARRAY_FILTER_USE_KEY
        );
    }

    public function getVendorListByParams()
    {
        $sortingParams = $this->vendorSorter->getSortingParams();
        $allParams = $this->requestHelper->getAllParams();
        $filterParams = $this->fetchFilterValues($allParams);

        return $this->vendorRepository->getVendorListByParams($sortingParams, $filterParams);
    }

    public function getVendorDetailsUrl($vendor_id)
    {
        return $this->getUrl('*/index/view/id/' . $vendor_id);
    }
}

