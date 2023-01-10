<?php

namespace Lumav\DaireStudyUnit4vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Vendors extends AbstractDb
{
    public function _construct()
    {
        
        $this->_init('training4_vendor', 'vendor_id');
    }

    public function getVendorsByProdId($productId)
    {
        $result = [];
        try {
            $select = $this->getConnection()->select()->from(
                ['v' => 'training4_vendor'],
                ['v.name']
            )->joinInner(
                ['v2p' => 'training4_vendor2product'],
                'v.vendor_id = v2p.vendor_id',
            )->where(
                'v2p.product_id = ' . $productId
            );
            $result = $this->getConnection()->fetchCol($select);

        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $result;
    }
}