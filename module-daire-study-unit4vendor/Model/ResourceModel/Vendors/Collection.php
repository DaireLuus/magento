<?php

namespace Lumav\DaireStudyUnit4vendor\Model\ResourceModel\Vendors;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Lumav\DaireStudyUnit4vendor\Model\Vendors', 'Lumav\DaireStudyUnit4vendor\Model\ResourceModel\Vendors');
    }

       
}