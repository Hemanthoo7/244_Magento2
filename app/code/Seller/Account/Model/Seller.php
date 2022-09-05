<?php
namespace Seller\Account\Model;
use Magento\Framework\Model\AbstractModel;
use Seller\Account\Model\ResourceModel\Seller as SellerResourceModel;
class Seller  extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(SellerResourceModel::class);
    }
}
