<?php

namespace Lumav\DaireStudyUnit4list\Block;

use Lumav\DaireStudyUnit4list\Helper\RequestHelper;
use Lumav\DaireStudyUnit4list\Model\Vendor;
use Lumav\DaireStudyUnit4list\Model\Vendor as VendorModel;
use Lumav\DaireStudyUnit4list\Model\VendorRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Request\Http;

class VendorSorter extends Template
{
    protected $vendorRepository;
    protected $requestHttp;
    protected $requestHelper;
    protected $vendorModel;

    public function __construct(
        Context $context,
        array $data = [],
        VendorRepository $vendorRepository,
        Http $requestHttp,
        RequestHelper $requestHelper,
        VendorModel $vendorModel
    ) {
        parent::__construct($context, $data);
        $this->vendorRepository = $vendorRepository;
        $this->requestHttp = $requestHttp;
        $this->requestHelper = $requestHelper;
        $this->vendorModel = $vendorModel;
    }

    public function getSortingKeys()
    {
        $vendorCollection = $this->vendorRepository->getAllVendors();
        $sortKeys = [];
        /** @var \Lumav\DaireStudyUnit4list\Model\Vendor $vendor */
        foreach ($vendorCollection as $vendor) {
            $vendorData = $vendor->getData();
            foreach ($vendorData as $key => $val) {
                $sortKeys[] = $key;
            }
            break;
        }
        return $sortKeys;
    }

    public function getCurrentOrder()
    {
        $order = $this->requestHttp->getParam(VendorModel::VENDOR_LIST_SORTING_PARAM);
        if ($order) {
            return $order;
        } else {
            $defaultOrder = $this->vendorModel->getVendorSortOrder()->getSortingField();
            return $defaultOrder;
        }
    }

    public function getCurrentOrderDirection()
    {
        $orderDirection = $this->requestHttp->getParam(VendorModel::VENDOR_LIST_SORTING_DIRECTION_PARAM);
        if ($orderDirection) {
            return $orderDirection;
        } else {
            $defaultDirection = $this->vendorModel->getVendorSortOrder()->getSortingDirection();
            return $defaultDirection;
        }
    }

    public function getSortingParams(): array
    {
        $sortingKey = $this->requestHelper->getUrlParamByKey(Vendor::VENDOR_LIST_SORTING_PARAM);
        $sortingDirection = $this->requestHelper->getUrlParamByKey(Vendor::VENDOR_LIST_SORTING_DIRECTION_PARAM);

        $sortingParams = [];
        if (strlen($sortingKey) > 0 && strlen($sortingDirection) > 0) {
            $sortingParams[$sortingKey] = $sortingDirection;
        } else {
            $sortingParams[$this->getCurrentOrder()] = $this->getCurrentOrderDirection();
        }

        return $sortingParams;
    }
}
