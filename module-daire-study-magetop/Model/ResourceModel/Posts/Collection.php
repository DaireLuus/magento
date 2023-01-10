<?php
namespace Lumav\DaireStudyMagetop\Model\ResourceModel\Posts;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Lumav\DaireStudyMagetop\Model\Posts',
            'Lumav\DaireStudyMagetop\Model\ResourceModel\Posts'
        );
    }
}