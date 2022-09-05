<?php

namespace Containers\Attribute\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Dimensions extends AbstractSource
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Length'),   'value' => 'Length'],
                ['label' => __('Width'),  'value' => 'Width'],
            ];
        }
        return $this->_options;
    }
}
