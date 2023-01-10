<?php
namespace Lumav\DaireStudyUnit4warranty\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Warranty extends AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('1'), 'value' => '1'],
                ['label' => __('2'), 'value' => '2'],
                ['label' => __('3'), 'value' => '3'],
                ['label' => __('4'), 'value' => '4'],
                ['label' => __('5'), 'value' => '5'],
                ['label' => __('6'), 'value' => '6'],
                
            ];
        }
        return $this->_options;
    }
}
