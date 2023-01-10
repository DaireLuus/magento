<?php
namespace Lumav\DaireStudyUnit4warranty\Model\Attribute\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Warranty extends AbstractBackend
{
    /**
     * Validate
     * @param Product $object
     * @throws LocalizedException
     * @return bool
     */
   
    public function beforeSave($object)
    {
        
        $data = intval($object->getData('warranty'));

        if ($data == 1) {
            $object->setData('warranty', "$data year");
        } else {
            $object->setData('warranty', "$data years");
        }
        
        return parent::beforeSave($object); 
    }
}