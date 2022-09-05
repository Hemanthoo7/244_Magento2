<?php

namespace Containers\Attribute\Model\Attribute\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Dimensions extends AbstractBackend
{
/**
 * @param Product $object
 * @throws LocalizedException
 * @return bool
 */
public function validate($object)
{
    $value= $object ->getData($this->getAttribute()->getAttributeCode());
    if(($object->getAttributeSetId() == 10) && ($value == 'length')){
        throw new LocalizedException(__('Length cannot be'));
    }
}












