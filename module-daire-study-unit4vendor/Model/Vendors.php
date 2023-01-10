<?php

namespace Lumav\DaireStudyUnit4vendor\Model;

use Magento\Framework\Model\AbstractModel;
 
class Vendors extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Lumav\DaireStudyUnit4vendor\Model\ResourceModel\Vendors');
    }
}