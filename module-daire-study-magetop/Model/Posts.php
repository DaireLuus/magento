<?php
namespace Lumav\DaireStudyMagetop\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Posts extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Lumav\DaireStudyMagetop\Model\ResourceModel\Posts');
    }
}