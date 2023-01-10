<?php
namespace Lumav\DaireStudyUnit4warranty\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Warranty extends AbstractFrontend
{
    public function getValue(DataObject $object): string
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<b>$value</b>";
    }
}
