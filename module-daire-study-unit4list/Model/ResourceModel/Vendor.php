<?php

namespace Lumav\DaireStudyUnit4list\Model\ResourceModel;

use Lumav\DaireStudyUnit4list\Model\Vendor as VendorModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Vendor extends AbstractDb
{
    const TABLE_NAME = 'training4_vendor';
    const VENDOR_PRODUCT_JOIN_TABLE_NAME = 'training4_vendor2product';

    public function __construct(Context $context, $connectionName = null)
    {
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init(Vendor::TABLE_NAME, VendorModel::ID);
    }

    public function getProductIds($vendorId)
    {
        $select = $this->getConnection()->select()->from(
            ['vp' => Vendor::VENDOR_PRODUCT_JOIN_TABLE_NAME],
            ['vp.product_id']
        )->where(
            'vp.vendor_id = ?',
            (int)$vendorId
        );

        return $this->getConnection()->fetchCol($select);
    }

    public function getVendorIdsByProdIds(array $productIds)
    {
        $result = [];
        try {
            $select = $this->getConnection()->select()->from(
                ['vp' => Vendor::VENDOR_PRODUCT_JOIN_TABLE_NAME],
                ['v.' . VendorModel::ID]
            )->joinInner(
                ['v' => Vendor::TABLE_NAME],
                'vp.vendor_id = v.' . VendorModel::ID
            )->where(
                'vp.product_id IN (?)',
                $productIds
            );
            $vendors = $this->getConnection()->fetchCol($select);
            $result = $vendors;

        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $result;
    }

    public function insertProduct($vendorId, $productId)
    {
        $data = [
            'vendor_id' => $vendorId,
            'product_id' => $productId
            
        ];
        $this->getConnection()->insertMultiple(Vendor::VENDOR_PRODUCT_JOIN_TABLE_NAME, $data);
    }


}
