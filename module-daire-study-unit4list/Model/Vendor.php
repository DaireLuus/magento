<?php

namespace Lumav\DaireStudyUnit4list\Model;

class Vendor extends \Magento\Framework\Model\AbstractModel
{


    const ID = 'vendor_id';
    const NAME = 'name';

    const VENDOR_LIST_SORTING_PARAM = 'vendor_list_order';
    const VENDOR_LIST_SORTING_DIRECTION_PARAM = 'vendor_list_order_dir';

    /** @var VendorSortOrder $sortOrder */
    protected $vendorSortOrder = null;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        VendorSortOrder $vendorSortOrder
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->vendorSortOrder = $vendorSortOrder;
    }

    protected function _construct()
    {
        $this->_init(\Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor::class);
    }

    public function getId()
    {
        return $this->getData(Vendor::ID);
    }

    public function getName()
    {
        return $this->getData(Vendor::NAME);
    }

    /**
     * @return \Lumav\DaireStudyUnit4list\Model\VendorSortOrder
     */
    public function getVendorSortOrder(): \Lumav\DaireStudyUnit4list\Model\VendorSortOrder
    {
        return $this->vendorSortOrder;
    }



}
